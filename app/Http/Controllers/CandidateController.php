<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('position')->get();
        $positions = Position::all();
        return view('candidates', compact('candidates', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,student_id',
            'position_id' => 'required|exists:positions,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validate image
        ]);

        // Check if candidate already exists
        $existingCandidate = Candidate::where('student_id', $request->input('student_id'))
                                       ->where('position_id', $request->input('position_id'))
                                       ->first();

        if ($existingCandidate) {
            return redirect()->route('candidates.index')->with('message', 'Candidate already exists for this position.');
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imagePath = $image->store('uploadedImages', 'public');
        }

        // Create new candidate
        Candidate::create([
            'student_id' => $request->input('student_id'),
            'position_id' => $request->input('position_id'),
            'votes' => 0,
            'image' => $imagePath, // Save image path
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
    }

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('candidates.index')
                         ->with('success', 'Candidate deleted successfully!');
    }
}
