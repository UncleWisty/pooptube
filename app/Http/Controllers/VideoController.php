<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Video $video) {
        // only owner can edit
        if (Auth::id() !== $video->user_id) {
            abort(403);
        }
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video) {
        if (Auth::id() !== $video->user_id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('videos.show', $video)->with('success', 'Video actualizado correctamente.');
    }

    public function destroy(Video $video) {
        if (Auth::id() !== $video->user_id) {
            abort(403);
        }

        // delete stored video file if exists
        if ($video->video_path && Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video eliminado.');
    }

    public function myVideos() {
        $user = Auth::user();

        // defensive: if the relationship method isn't available for some reason,
        // fallback to a direct query by user_id.
        if ($user && method_exists($user, 'videos')) {
            $videos = $user->videos()->latest()->get();
        } else {
            $videos = Video::where('user_id', Auth::id())->latest()->get();
        }

        return view('videos.my', compact('videos'));
    }
}
