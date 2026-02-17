<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index() {
        $videos = Video::latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function create() {
        return view('videos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'video' => 'required|mimes:mp4,mov,ogg|max:100000',
        ]);

        $path = $request->file('video')->store('videos', 'public');


        $request->user()->videos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $path,
        ]);

        return redirect()->route('videos.index');
    }
    
    public function show(Video $video) {
        return view('videos.show', compact('video'));
    }
}
