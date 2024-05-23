<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'language' => 'required|string|max:2',
            'price' => 'required|numeric',
            'year' => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path ="";
        }
    
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->language = $request->language;
        $book->price = $request->price;
        $book->published_year = $request->year;
        $book->image_url = $path;
        $book->save();
    
        return response()->json(['success' => 'Livro cadastrado com sucesso!']);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'language' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'arrival_date' => 'sometimes|required|date',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($book->image_url) {
                Storage::disk('public')->delete($book->image_url);
            }
            // Store new image
            $path = $request->file('image')->store('images', 'public');
            $book->image_url = $path;
        }

        $book->title = $request->title ?? $book->title;
        $book->author = $request->author ?? $book->author;
        $book->language = $request->language ?? $book->language;
        $book->price = $request->price ?? $book->price;
        $book->arrival_date = $request->arrival_date ?? $book->arrival_date;
        $book->save();

        return response()->json(['success' => 'Livro atualizado com sucesso!']);
    }

    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }
}
