<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\ContactRequest;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Post;
use App\Models\ClientPost;

use App\Models\Setting;

class MainController extends Controller
{
    public function mainPage(Request $request)
    {
        // Get the authenticated client ID
        $clientId = auth('client')->id();

        // Retrieve all posts with the 'clients' relationship, filtered by the current client ID
        $posts = Post::with(['clients' => function ($query) use ($clientId) {
            $query->where('client_id', $clientId);
        }])->get();

        // Add 'is_favourite' attribute for each post based on the 'client_posts' pivot table
        foreach ($posts as $post) {
            // Check if the post has a related client and retrieve 'is_favourite' from pivot, else default to false
            $post->is_favourite = $post->clients->isNotEmpty() && $post->clients->first()->pivot->is_favourite;

        }
        
        // Prepare other data (e.g., DonationRequests) as needed
        $query = DonationRequest::query();

        if ($request->has('blood_type_id') && $request->blood_type_id != null) {
            $query->where('blood_type_id', $request->blood_type_id);
        }

        if ($request->has('city_id') && $request->city_id != null) {
            $query->where('city_id', $request->city_id);
        }

        $records = $query->paginate(3);

        $bloodTypes = BloodType::all();
        $cities = City::all();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('front.partials.donation-requests-list', compact('records'))->render(),
            ]);
        }

        return view('front.home', compact('posts', 'records', 'bloodTypes', 'cities'));
    }


    public function about()
    {
        return view('front.about');
    }

    public function toggleFavourite(Request $request)
    {
        $user = $request->user();
        $toggle = $user->posts()->toggle($request->post_id); // Assuming client_posts relationship is defined
        return response()->json(['status' => 1, 'data' => $toggle]);

    }

    public function contact(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        $clientId = Auth::guard('client')->id();
        // Create the contact record with validated data
        $contact = Contact::create([
            'client_id' => $clientId, // Assign the authenticated client's ID
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        flash()->success('login successful');
        return redirect()->route('HomePage');
    }

    public function getCities(Request $request)
    {
        $governorateId = $request->input('governorate_id');
        $cities = City::where('governorate_id', $governorateId)->get();
        return response()->json(['data' => $cities]);
    }

    public function donationRequests(Request $request)
    {

        // Build the query with optional filters
        $query = DonationRequest::query();



        // Fetch the filters from the request
        $bloodTypeId = $request->input('blood_type_id');
        $cityId = $request->input('city_id');

        // Apply filters if provided
        if ($bloodTypeId) {
            $query->where('blood_type_id', $bloodTypeId);
        }
        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        // Get paginated results
        $records = $query->paginate(4);

        // Get blood types and cities for the dropdown options
        $bloodTypes = BloodType::all();
        $cities = City::all();

        // Return JSON response for AJAX, or render view for initial load
        if ($request->ajax()) {
            return response()->json([
                'html' => view('front.partials.donation-requests-list', compact('records'))->render()
            ]);
        }

        return view('front.donation-requests', compact('records', 'bloodTypes', 'cities'));
    }
    public function showArticle($id)
    {
        $posts = Post::all();
        $article = Post::findOrFail($id); // Fetch the article or fail
        return view('front.article-details', compact('article','posts')); // Return the view with article data
    }
    public function showArticles()

    {
        // Get the authenticated client ID
        $clientId = auth('client')->id();

        // Retrieve all posts with the 'clients' relationship, filtered by the current client ID
        $posts = Post::with(['clients' => function ($query) use ($clientId) {
            $query->where('client_id', $clientId);
        }])->get();

        // Add 'is_favourite' attribute for each post based on the 'client_posts' pivot table
        foreach ($posts as $post) {
            // Check if the post has a related client and retrieve 'is_favourite' from pivot, else default to false
            $post->is_favourite = $post->clients->isNotEmpty() && $post->clients->first()->pivot->is_favourite;

        }
        $article = Post::all(); // Fetch the article or fail
        return view('front.articles', compact('article','posts')); // Return the view with article data
    }
    public function myFavourites(Request $request)
    {
        $client = auth('client')->user();
        $posts = $client->posts()->with('category')->latest()->paginate(20);
        foreach ($posts as $post) {
            $post->is_favourite = $post->clients->isNotEmpty() && $post->clients->first()->pivot->is_favourite;
        }
        return view('front.myFavourites', compact('posts'));
    }
    public function donationDetails($id)
    {
        // Retrieve the donation request by ID
        $donor = DonationRequest::findOrFail($id);

        // Pass the data to the view
        return view('front.request-details', compact('donor'));
    }
}
