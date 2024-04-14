<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            
            ]);
            $author = Author::create($request->all());
            return response()->json($author, 201);
        }

        public function index()
        {
            $authors = Author::all();
            return response()->json($authors);
        }
        public function show($id)
        {
            try {
                $author = Author::findOrFail($id);
                return response()->json($author, 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Author not found'], 404);
            }
        }
        public function update(Request $request, $id)
        {
            $author = Author::findOrFail($id);
    
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:authors,email,'.$author->id,
            ]);
    
            $author->update($request->all());
    
            return response()->json($author, 200);
        }
        public function destroy($id)
        {
            try {
                $author = Author::findOrFail($id);
                $author->delete();
                
                return response()->json(['message' => 'Author deleted successfully'], 200);
            } catch (ModelNotFoundException $e) {
                return response()->json(['message' => 'Author not found'], 404);
            }
        }
            
    

}
