<?php

namespace App\Http\Controllers;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class DealerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            ]);
            return Dealer::create($request->all());
        }

    
    public function index()
    {
        $dealers = Dealer::all();
        return response()->json($dealers);
    }
    public function show($id)
    {
        $dealers = Dealer::find($id);
        return response()->json($dealers);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            ]);
        try {
            $dealer = Dealer::findOrFail($id);
            $dealer->update($request->all());

            // Custom success response
            return response()->json([
                'message' => 'Dealer updated successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            // Return error response if dealer with the specified ID is not found
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    }

        
    public function destroy($id)
    {
        $dealer = Dealer::findOrFail($id);
        $dealer->delete();

         // Custom success response
        return response()->json([
            'message' => 'Deleted successfully',
            'data' => $dealer
        ], 200);
    }


}
