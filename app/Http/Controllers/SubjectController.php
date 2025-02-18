<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; // Assuming you have a Subject model
use Validator;

class SubjectController extends Controller
{
    // Show all subjects (index)
    public function index()
    {
        $subjects = Subject::all();
        return view('SubjectPage', compact('subjects')); // Pass subjects to the view
    }

    // Show the form to create a new subject
    public function create()
    {
        return view('subjectpage'); // or you can create a separate view for creating subjects
    }

    // Store the new subject
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'subject' => 'required|string|max:255',
            'status' => 'required|in:active,inactive', // Must be one of the allowed values
        ]);

        // Create a new subject
        $subject = new Subject();
        $subject->subject = $request->subject;
        $subject->status = $request->status;
        // $subject->student_id = $request->student_id ?? 1;
        $subject->save();

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully!');
    }

    // Show the form to edit an existing subject
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('editSubject', compact('subject'));
    }

    // Update an existing subject
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->subject = $request->subject;
        $subject->status = $request->status;
        $subject->save();

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    // Delete a subject
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
}
