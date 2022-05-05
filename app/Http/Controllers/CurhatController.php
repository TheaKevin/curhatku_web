<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\curhat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurhatController extends Controller
{
    public function TulisCurhat()
    {
        return view('TulisCurhat');
    }

    public function TulisCurhatPost(Request $request)
    {
        $request->validate([
            'curhat' => 'required|max:255'
        ], [
            'curhat.required' => 'Isi curhat tidak boleh kosong',
            'curhat.max' => 'Isi curhat maksimal 255 karakter'
        ]);

        if ($request->anonymous) {
            curhat::create([
                'curhat' => $request->curhat,
                'user_id' => Auth::user()->id,
                'anonymous' => true
            ]);
        } else {
            curhat::create([
                'curhat' => $request->curhat,
                'user_id' => Auth::user()->id,
                'anonymous' => false
            ]);
        }

        return view('TulisCurhat');
    }

    public function Curhat($id)
    {
        $curhat = curhat::find($id);

        $comment = comment::where('curhat_id', $id)->orderBy('created_at', 'asc')->get();

        return view('Curhat', ['curhat' => $curhat, 'comment' => $comment]);
    }

    public function Comment(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:255'
        ], [
            'comment.required' => 'Isi komentar tidak boleh kosong',
            'comment.max' => 'Isi komentar maksimal 255 karakter'
        ]);

        comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'curhat_id' => $request->curhat_id
        ]);

        return redirect()->route('Curhat', ['id' => $request->curhat_id]);
    }
}
