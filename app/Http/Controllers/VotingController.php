<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VotingController extends Controller
{
    public function index(Request $request)
    {
        $positions = Position::with(['candidates' => function ($query) {
            $query->orderBy('votes', 'desc');
        }])->get();

        if ($request->routeIs('voting')) {
            return view('voting', compact('positions'));
        } else if ($request->routeIs('voteData')) {
            return view('voteData', compact('positions'));
        }
    }

    public function store(Request $request)
    {
        // Retrieve the selected candidates by position
        $selectedCandidates = $request->input('votes', []);
        
        // Log the selected candidates for debugging
        Log::info('Selected candidates: ', $selectedCandidates);

        if (empty($selectedCandidates)) {
            return redirect()->back()->with('error', 'No candidate selected.');
        }

        // Update votes for selected candidates
        foreach ($selectedCandidates as $positionId => $selectedCandidateStudentId) {
            $candidate = Candidate::where('student_id', $selectedCandidateStudentId)
                                  ->where('position_id', $positionId)
                                  ->first();

            if ($candidate) {
                $candidate->increment('votes');
                Log::info('Updated votes for candidate: ' . $selectedCandidateStudentId . ' in position: ' . $positionId);
            } else {
                Log::warning('Candidate not found for student_id: ' . $selectedCandidateStudentId . ' and position_id: ' . $positionId);
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your vote has been successfully submitted.');
    }

    public function getId(Request $request)
    {
        $studentId = $request->query('student_id'); // Retrieve student_id from the query string
    
        // Log the student_id for debugging
        Log::info('Student ID from getId: ' . $studentId);
    
        // Find the user by student_id and update the has_voted field
        $user = User::where('student_id', $studentId)->first();
    
        if ($user) {
            $user->has_voted = 1;
            $user->save();
    
            Log::info('User has_voted updated for student_id: ' . $studentId);
        } else {
            Log::error('User not found for student_id: ' . $studentId);
        }
    
        // Return a JSON response with the student_id
        return response()->json(['student_id' => $studentId]);
    }
    
    
    
    
}
