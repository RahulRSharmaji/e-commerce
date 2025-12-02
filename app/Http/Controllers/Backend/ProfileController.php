<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProfileController extends Controller
{
    public function profile(Request $request){
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request){
        try {
            $request->validate([
                'name'=>'required|string|max:100',
                'email'=>'required|email|unique:users,email,'.Auth::id(),
                'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = Auth::user();
            if($request->hasFile('image')){
                if(File::exists(public_path($user->image))){
                    File::delete(public_path($user->image));
                }
                $image = $request->image;
                $imageName = rand().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'),$imageName);
                $path = "/uploads/".$imageName;
                $user->image = $path;
            }

            
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            toastr()->success('Profile completed successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request){
        try {
            $request->validate([
                'current_password' => ['required','current_password'],
                'password' => ['required','confirmed','min:8']
            ]);

            $request->user()->update([
                'password' => bcrypt($request->password)
            ]);

            toastr()->success('Password updated successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
