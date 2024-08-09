<?php

namespace App\Http\Controllers;

use App\Models\Position; // Assuming you have a Position model
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('positions', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'position_name' => 'required|string|max:255|unique:positions,name',
        ]);
    
        Position::create([
            'name' => $request->input('position_name'),
        ]);
    
        return redirect()->route('positions.index')->with('success', 'Position added successfully!');
    }
    

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Position deleted successfully!');
    }
}
