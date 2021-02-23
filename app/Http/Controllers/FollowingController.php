<?php

namespace App\Http\Controllers;

use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    const DATA_PER_PAGE = 15;

    public function followingIndex($id) {

        $followings = Following::where('following_id', $id)->get()->pluck('followed_id')->toArray();
        $users = User::whereIn('id', $followings)->paginate(self::DATA_PER_PAGE);

        return view('user-list', ['users'=>$users]);
    }

    public function followedIndex($id) {

        $followeds = Following::where('followed_id', $id)->get()->pluck('following_id')->toArray();
        $users = User::whereIn('id', $followeds)->paginate(self::DATA_PER_PAGE);

        return view('user-list', ['users'=>$users]);
    }



    public function store(Request $request, $id) {
        $following = new Following;
        $following->following_id = $request->following_id;
        $following->followed_id = $request->followed_id;
        $following->save();
        // $following->create([
        //     'following_id'=>$request->following_id,
        //     'followed_id'=>$request->followed_id,
        // ]);

        $action = 'add';

        return response()->json($action);
    }

    public function destroy(Request $request, $id) {
        Following::where('following_id', $request->following_id)->where('followed_id', $request->followed_id)->delete();

        $action = 'delete';

        return response()->json($action);
    }
}
