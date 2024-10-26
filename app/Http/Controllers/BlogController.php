<?php

namespace App\Http\Controllers;

use App\Models\Guesthouse;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function display($guesthouseId)
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            $blogList = Review::with('user')->where('guesthouse_id', $guesthouseId)->get();

            $averageRating = $blogList->avg('rating');
            $guesthouse = Guesthouse::findOrFail($guesthouseId);


            $currentMonthReviews = Review::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();

            return view('blog.blogDisplay', compact('blogList', 'averageRating', 'currentMonthReviews', 'guesthouse'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function addReview(Request $request)
    {
        if (Auth::check()) {

            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'input-b1' => 'nullable|array',
                'input-b1.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Create a new review instance
            $review = new Review();
            $review->rating = $request->rating;
            $review->title = $request->title;
            $review->content = $request->content;
            $review->user_id = Auth::user()->id;
            $review->guesthouse_id = $request->guesthouse_id;


            // Handle file uploads if any
            if ($request->hasFile('input-b1')) {
                $images = [];
                foreach ($request->file('input-b1') as $image) {
                    // Store the image in the public/images directory
                    $path = $image->store('images', 'public');

                    // Generate the URL for the image
                    $imageUrl = Storage::url($path);
                    $images[] = $imageUrl; // Add the image URL to the array
                }
                $review->images = json_encode($images); // Save image URLs as JSON
            }

            $review->save(); // Save the review to the database

            return redirect()->back()->with('success', 'Review added successfully!');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function deleteReview($id)
    {
        if (Auth::check()) {

            // Find the review by ID
            $review = Review::find($id);

            // Check if the review exists
            if (!$review) {
                return redirect()->back()->with('error', 'Review not found.');
            }

            // Delete associated images from storage
            if ($review->images) {
                $images = json_decode($review->images);
                foreach ($images as $image) {
                    $path = str_replace('/storage', 'public', $image); // Convert URL to storage path
                    Storage::delete($path); // Delete image from storage
                }
            }

            // Delete the review
            $review->delete();

            return redirect()->back()->with('success', 'Review deleted successfully!');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


    public function updateReview(Request $request, $id)
    {
        if (Auth::check()) {

            // Validate the incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'rating' => 'required|integer|between:1,5',
            ]);

            // Find the review by ID
            $review = Review::findOrFail($id);

            // Update the review attributes
            $review->title = $validatedData['title'];
            $review->content = $validatedData['content'];
            $review->rating = $validatedData['rating'];

            // Save the changes
            $review->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Review updated successfully!');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    //admin
    public function adminReviews()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Fetch all reviews for the admin view
            $reviews = Review::with('user', 'guesthouse')->paginate(10); // Paginate the reviews
            return view('blog.blogAdmin', compact('reviews'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function toggleStatus(Review $review)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Toggle the status of the review
            $review->status = !$review->status;
            $review->save();

            return redirect()->route('blog.blogAdmin')->with('success', 'Review status updated successfully.');
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }
}
