<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;

class UpdateProfileController extends Controller
{

    public function update(Request $request, $id) {
        $request->validate([
            'book_photo'=>'mimes:jpeg,png|max:2048',
            'photo'=>'mimes:jpeg,png|max:2048',
            'name'=>'required|string|max:255',
            'info'=>'string|max:256'
        ]);

        $user = User::findOrFail($id);

        $profile_photo = $request->file('photo');
        if($profile_photo) {
            $file_name = date('Ymdhis') . '_' . $profile_photo->getClientOriginalName();
            $cropped_data = json_decode($request->cropped_data, true);
            $image = Image::make($profile_photo)
            ->crop(
                $cropped_data['width'],
                $cropped_data['height'],
                $cropped_data['x'],
                $cropped_data['y'],
            );
            $file_path = storage_path('app/public/profile-photos') . '/' . $file_name;
            $image->save($file_path);
            $user->profile_photo_path = '/storage/profile-photos/' . $file_name;
        }

        $book_photo = $request->file('book_photo');
        if($book_photo) {
            $file_name = date('Ymdhis') . '_' . $book_photo->getClientOriginalName();
            $book_photo->storeAs('public/profile-photos', $file_name);
            $user->book_photo_path = '/storage/profile-photos/' . $file_name;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->info = $request->info;
        $user->save();

        return redirect()->route('profile.show')->with('success', '変更しました');
    }
}
