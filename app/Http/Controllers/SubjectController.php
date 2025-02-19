<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; 
use Illuminate\Support\Facades\DB;

use Validator;

class SubjectController extends Controller
{
    // Show all subjects (index)
    public function index()
    {
        $data = array();
        $data['subject'] = DB::table('subjects')->paginate(5);
        return view('SubjectPage', $data);
    }

    public function fetchSubject(Request $request)
    {
        $subjects = DB::table('subjects')->paginate(5); // Correct variable

        if ($request->ajax()) {
            return view('partials.subject-list', ['subject' => $subjects])->render();
        }

        return redirect()->route('subjects.index');
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
        $request->validate([
            'subject' => 'required|string|max:255',
            'status' => 'required|in:active,inactive', // Validate status field
        ]);
    
        $subject = Subject::findOrFail($id);
        $subject->subject = $request->subject;
        $subject->status = $request->status;
        $subject->save(); // Save updated data
    
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }
    
    // Delete a subject
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->back()->with('status', 'Subject deleted successfully!');

    }
}
