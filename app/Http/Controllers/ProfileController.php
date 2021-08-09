<?php

namespace App\Http\Controllers;

use App\Traits\ImageUpload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ImageUpload;
    public function index() {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }

    public function update(int $id, Request $request) {
//        dd($request->all());
        $user = User::findOrFail($id);
        $request->validate([
           'name' => 'required',
           'email' => 'required',
        ]);

        $data = $request->all();
        unset($data['_token']);
        unset($data['password']);
        unset($data['image']);
        if ($request->password != null) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $password = Hash::make($request->password);
            $data['password'] = $password;
        }

        if ($request->has('image')) {
            $request->validate([
                'image' => 'file|mimes:jpg,jpeg,png|max:4096'
            ]);
            $image = $this->uploadImage($request->file('image'), 'uploaded/profile', 60);
            $data['image'] = $image;
        }
        $user->update($data);
        return redirect()->route('profile.index')->with('success', 'profile data has been updated successfully');
    }
}
