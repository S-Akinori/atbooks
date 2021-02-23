<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const POST_NUM_PER_PAGE = 15;

    public function index($id) {
        if($id == null) {
            $id = Auth::user()->id;
        }
        $user = User::findOrFail($id);
        $books = Book::where('user_id', $id)->latest()->paginate(self::POST_NUM_PER_PAGE);
        $following_num = Following::where('following_id', $id)->count();
        $followed_num = Following::where('followed_id', $id)->count();
        $is_following = Following::where('following_id', Auth::user()->id)->where('followed_id', $id)->exists();

        return view('dashboard', [
            'user'=>$user, 
            'books'=>$books,
            'following_num'=>$following_num,
            'followed_num'=>$followed_num,
            'is_following'=>$is_following
        ]);
    }
}
