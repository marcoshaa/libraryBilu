<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'price' => 'required|numeric',
            'arrival_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }
    
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->language = $request->language;
        $book->price = $request->price;
        $book->arrival_date = $request->arrival_date;
        $book->image_url = $path;
        $book.save();
    
        return response()->json(['success' => 'Livro cadastrado com sucesso!']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string|max:255',
            'arrival_date' => 'required|date',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->language = $request->language;
        $book->price = $request->price;
        $book->image_url = $request->image_url;
        $book->arrival_date = $request->arrival_date;
        $book->save();

        return response()->json(['message' => 'Book updated successfully.']);
    }

    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }
}
