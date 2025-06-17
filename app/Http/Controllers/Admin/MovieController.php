<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //class Str milik Laravel untuk membuat string acak (random).
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return view('admin.movies');
    }

    public function create()
    {
        return view('admin.movie-create');
    }

    public function store(Request $request) //submit form create movie
    {
        $data = $request->except('_token');// memunculkan data tanpa token dari csrf

        $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'large_thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'cast' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required',
            ]);

        $smallThumbnail = $request->small_thumbnail;
        $largeThumbnail = $request->large_thumbnail;

        $originalSmallThumbnailName = Str::random(10).$smallThumbnail->getClientOriginalName();
        $originalLargeThumbnailName = Str::random(10).$largeThumbnail->getClientOriginalName();

        // Simpan file thumbnail ke storage
        $smallThumbnail->storeAs('public/Thumbnail', $originalSmallThumbnailName);
        $largeThumbnail->storeAs('public/Thumbnail', $originalLargeThumbnailName);

        //original name thumbnail
        $data['small_thumbnail'] = $originalSmallThumbnailName;
        $data['large_thumbnail'] = $originalLargeThumbnailName;

        // Debug untuk cek hasil upload
        //dd($originalSmallThumbnailName, $originalLargeThumbnailName);

        Movie::create($data);

        return redirect()->route('admin.movie')->with('success', 'Movie created successfully!');
    }
}
