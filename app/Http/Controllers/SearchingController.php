<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class SearchingController extends Controller
{
    const DATA_PER_PAGE = 15;

    public function index(Request $request) {
        if($request->search_type == 'ユーザー') {
            $users = User::where('name', 'like', "%$request->key%")->paginate(self::DATA_PER_PAGE);
            return view('user-list', [
                'users'=>$users
            ]);
        } else if($request->search_type == '本') {
            $books = Book::where('title', 'like', "%$request->key%")->paginate(self::DATA_PER_PAGE);
            return view('book-list', [
                'books'=>$books
            ]);
        } else if($request->search_type == 'タグ') {
            $books = Book::where('tag', 'like', "%$request->key%")->paginate(self::DATA_PER_PAGE);
            return view('book-list', [
                'books'=>$books
            ]);
        }

    }

}
