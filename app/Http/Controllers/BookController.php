<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    const POST_NUM_PER_PAGE = 15;

    public function index() {
        $books = Book::latest()->paginate(self::POST_NUM_PER_PAGE);
        return view('books.index', ['books'=>$books]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'summary'=>'required',
            'book_photo'=>'mimes:jpeg,png|max:4096'
        ]);

        $book = new Book();

        $file = $request->file('book_photo');
        $file_name = date('Ymdhis') . '_' . $file->getClientOriginalName();
        $file->storeAs('public/img', $file_name);
        $file_path = '/storage/img/' . $file_name;

        $book_link = 'https://www.amazon.co.jp/s?k=' . $request->title;

        $book->create([
            'user_id' => Auth::user()->id,
            'book_photo_path' => $file_path,
            'book_link'=>$book_link,
            'title' => $request->title,
            'content'=> $request->content,
            'summary'=>$request->summary,
            'tag'=>$request->tag
        ]);

        return redirect()->route('book.index');

    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', ['book' => $book]);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'summary'=>'required',
            'book_photo'=>'mimes:jpeg,png|max:4096'
        ]);

        $book = Book::findOrFail($id);

        if($request->file('book_photo') != null) {
            $file = $request->file('book_photo');
            $file_name = date('Ymdhis') . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img', $file_name);
            $file_path = '/storage/img/' . $file_name;
            $book->book_photo_path = $file_path;
        }

        $book_link = 'https://www.amazon.co.jp/s?k=' . $request->title;

        $book->book_link = $book_link;
        $book->title = $request->title;
        $book->content = $request->content;
        $book->summary = $request->summary;
        $book->tag = $request->tag;

        $book->save();

        return redirect()->route('book.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('home.index', Auth::user()->id);
    }
}
