<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Video;

class CommentController extends Controller
{
    public function store(Request $request, Video $video) {
        $request->validate([
            'body' => 'required'
        ]);

        $video->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        return back();
    }
}
