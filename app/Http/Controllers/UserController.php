<?php

namespace App\Http\Controllers;

use App\Models\curhat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function Profile()
    {
        $curhat = curhat::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $totalCurhat = count($curhat);

        return view('Profile', ['curhat' => $curhat, 'totalCurhat' => $totalCurhat]);
    }

    public function EditProfile()
    {
        return view('EditProfile');
    }

    public function EditProfilePost(Request $request)
    {
        $this->validate($request, [
            'dob' => 'required|date',
            'status' => 'max:255'
        ], [
            'dob.required' => 'Tanggal lahir wajib diisi!',
            'dob.date' => 'Format tanggal lahir tidak sesuai!',
            'status.max' => 'Status tidak boleh lebih dari 255 character!'
        ]);

        $age = Carbon::parse($request->dob)->diff(Carbon::now())->y;

        if ($request->hasFile('profPic')) {
            if ($request->file('profPic')->isValid()) {

                // store image
                $path = Storage::put('public/asset', $request->file('profPic'));

                if ($request->anonymous) {
                    User::where('id', Auth::user()->id)->update([
                        'dob' => $request->dob,
                        'age' => $age,
                        'gender' => $request->gender,
                        'status' => $request->status,
                        'anonymous' => true,
                        'profPic' => $path
                    ]);
                } else {
                    User::where('id', Auth::user()->id)->update([
                        'dob' => $request->dob,
                        'age' => $age,
                        'status' => $request->status,
                        'anonymous' => false,
                        'profPic' => $path
                    ]);
                }
            }
        } else {
            if ($request->anonymous) {
                User::where('id', Auth::user()->id)->update([
                    'dob' => $request->dob,
                    'age' => $age,
                    'gender' => $request->gender,
                    'status' => $request->status,
                    'anonymous' => true
                ]);
            } else {
                User::where('id', Auth::user()->id)->update([
                    'dob' => $request->dob,
                    'age' => $age,
                    'status' => $request->status,
                    'anonymous' => false
                ]);
            }
        }

        return redirect()->route('Profile');
    }
}
