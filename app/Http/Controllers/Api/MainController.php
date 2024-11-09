<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\CreateDonationRequest;
use App\Http\Requests\CreatePostsRequest;
use App\Models\BloodType;
use App\Models\Categorie;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController
{

    public function DonationRequestCreat(CreateDonationRequest $request): JsonResponse
    {
//        dd(Governorate::query()->with(['clients','x'])->findOrFail(1));
        $validatedData = $request->validated();
        $donationRequest = DonationRequest::create($validatedData);

//        $clients_id = Client::whereHas('governorates', function ($query) use ($donationRequest) {
//            $query->where('governorate_id', $donationRequest->city->governorate_id);
//        })
//            ->whereHas('bloodTypes', function ($query) use ($donationRequest) {
//                $query->where('blood_type_id', $donationRequest->blood_type_id);
//            })
//            ->pluck('id')
//            ->toArray();
        $clients_ids = $donationRequest->city->governorate->client_governorates()
            ->where('blood_type_id', $donationRequest->blood_type_id)
            ->pluck('clients.id')
            ->toArray();
        //  dd($clients_ids);
        if (count($clients_ids)) {
            $notification = $donationRequest->notifications()->create([
                'title' => 'Donation Request Nearby',
                'content' => 'A donor is needed for blood type ' . optional($donationRequest->bloodType)->name,
            ]);
            $notification->clients()->attach($clients_ids);
        }

        return response()->json([
            'message' => 'Donation request created successfully!',
            'donation_request' => $donationRequest,
            'clients_id' => $clients_ids
        ], 201);
    }


    public function donationRequests(Request $request): JsonResponse
    {

        $donations = DonationRequest::when($request->input('governorate_id'), function ($query) use ($request) {
            $query->whereHas('city', function ($cityQuery) use ($request) {
                $cityQuery->where('governorate_id', $request->governorate_id);
            });
        })
            ->when($request->input('city_id'), function ($query) use ($request) {
                $query->where('city_id', $request->city_id);
            })
            ->when($request->input('blood_type_id'), function ($query) use ($request) {
                $query->where('blood_type_id', $request->blood_type_id);
            })
            ->with(['city.governorate', 'client', 'bloodType'])
            ->latest()
            ->paginate(5);

        if ($donations->isEmpty()) {
            return response()->json([
                'message' => 'No donation requests found',
                'data' => [],
            ], 404);
        }
        // Return the response as JSON
        return response()->json([
            'message' => 'success',
            'data' => $donations,
        ]);
    }


    public function createPosts(CreatePostsRequest $request): JsonResponse
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255', // In case you want to store image paths
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new post
        $post = Post::create($validatedData);

        return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
    }

    public function searchPosts(Request $request): JsonResponse
    {
        $filters = $request->all();

        // Apply the filter method using the scopeFilter from FilterTrait
        $posts = Post::filter($filters)->paginate(10);

        return response()->json([
            'message' => 'Filtered posts fetched successfully!',
            'data' => $posts,
        ], 200);
    }

    public function bloodTypes(): JsonResponse
    {
        $bloodTypes = BloodType::select('id', 'name')->get();
        return response()->json(['success' => $bloodTypes]);
    }

    public function categories(): JsonResponse
    {
        $categories = Categorie::select('id', 'name')->get();
        return response()->json(['success' => $categories]);
    }

    public function cities(Request $request): JsonResponse
    {
        $cities = City::select('id', 'name', 'governorate_id')
            ->with(['governorate:id,name']) // Eager load governorate and select only 'id' and 'name'
            ->when($request->input('governorate_id'), function ($query) use ($request) {
                $query->where('governorate_id', $request->governorate_id);
            })
            ->paginate(5);

        return response()->json([
            'message' => 'success',
            'data' => $cities
        ]);
    }

    public function governorates(): JsonResponse
    {
        // Retrieve all governorates with their cities
        $governorates = Governorate::with('cities')->get();
        // Return the response as JSON
        return response()->json([
            'message' => 'success',
            'data' => $governorates
        ]);
    }

    public function contact(ContactRequest $request): \Illuminate\Http\JsonResponse
    {
        $contact = Contact::create($request->validated());
        return response()->json([
            'message' => 'Contact created successfully',
            'data' => $contact
        ], 201);
    }

    public function postFavourite(Request $request):\Illuminate\Http\JsonResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        // Toggle the favorite status for the given post ID
        $toggle = $request->user()->posts()->toggle($validatedData['post_id']);

        // Return a JSON response indicating success and showing the result of the toggle operation
        return response()->json([
            'message' => 'Success',
            'data' => $toggle, // Returns an array showing 'attached' and 'detached' states
        ], 200);
    }
    public function myFavourites(Request $request): \Illuminate\Http\JsonResponse
    {
        // Get the user's favorite posts, including related categories
        $posts = $request->user()->posts()
            ->with('category')
            ->latest()
            ->paginate(20);
        // Return a JSON response with the list of favorite posts
        return response()->json([
            'message' => 'Loaded successfully',
            'data' => $posts,
        ], 200);
    }


}
