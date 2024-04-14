<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class BookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $book = Book::create([
            'author_id' => $request->author_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return response()->json($book, 201);
    }
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }
    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            return response()->json($book, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->update($request->all());

        return response()->json($book, 200);
    }
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            
            return response()->json(['message' => 'Book deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }
    



        
}
