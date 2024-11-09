<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $records = Post::paginate(5);
        return view('posts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::pluck('name', 'id')->toArray();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'publish_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $image = Image::read($request->file('thumbnail'));

//        // Main Image Upload on Folder Code
        $imageName = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
//        $destinationPath = public_path('storage/uploads/originals/');
//        if (!file_exists($destinationPath)) {
//            mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
//        }
//        $image->save($destinationPath . $imageName);

        // Generate Thumbnail Image Upload on Folder Code
        $destinationPathThumbnail = public_path('storage/uploads/thumbnails/');
        if (!file_exists($destinationPathThumbnail)) {
            mkdir($destinationPathThumbnail, 0755, true); // Create the directory if it doesn't exist
        }
        $image->resize(373, 247);
        $image->save($destinationPathThumbnail . $imageName);

        // Create the post
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'thumbnail' => 'uploads/thumbnails/'. $imageName,
            'category_id' => $request->input('category_id'),
            'publish_date' => Carbon::parse($request->input('publish_date')),
        ]);

            flash()->success('Post created successfully!');

        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Post::findOrFail($id);
        $categories = Categorie::pluck('name', 'id')->toArray();
        return view('posts.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'publish_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the post by ID
        $record = Post::findOrFail($id);

        // Update the post's title, content, category, and publish date
        $record->title = $request->input('title');
        $record->content = $request->input('content');
        $record->category_id = $request->input('category_id');
        $record->publish_date = Carbon::parse($request->input('publish_date'));
        if ($record->thumbnail && Storage::disk('public')->exists($record->thumbnail)) {
            Storage::disk('public')->delete( $record->thumbnail);
            $record->delete();
        }

        // Handle thumbnail upload if present
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '-' . $thumbnail->getClientOriginalName();
            // Ensure the storage path exists
            $destinationPath = public_path('storage/uploads/thumbnails');//C:\xampp\htdocs\BloodBank\public\storage/uploads/thumbnails
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }
            // Main Image Upload
            $image = Image::read($request->file('thumbnail'));
            // Generate and save the thumbnail image
            $image->resize(373, 247);
            $image->save($destinationPath . '/' . $filename); // Save the resized image

            // Save the filename to the post
            $record->thumbnail = 'uploads/thumbnails/' . $filename;
        }
        // Save the updated post record
        $record->save();

        // Check if the post was updated successfully
        flash()->success('Post updated successfully!');

        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Post::findOrFail($id);

 //        Delete the thumbnail file if it exists
        if ($record->thumbnail && Storage::disk('public')->exists($record->thumbnail)) {
            Storage::disk('public')->delete( $record->thumbnail);
            $record->delete();
            // Flash a success message
            flash()->success('Post deleted successfully!');
        }
        // Redirect back to the posts index
        return redirect()->route('posts.index');
    }
    public function show(string $id)
    {
        //
    }
}
