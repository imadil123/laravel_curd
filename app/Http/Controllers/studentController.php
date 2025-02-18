<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StudentRequest;
use App\Models\User;
use App\Models\student;

class StudentController extends Controller
{
    public function ShowStudent()
    {
        $data = array();
        $data['students'] = DB::table('students')->paginate(3);
        return view('students', $data);
    }

    // public function ShowSubject()
    // {
    //    return view('SubjectPage');
    // }

    // pagination
    public function fetchStudents(Request $request)
    {
        $students = DB::table('students')->paginate(3);
    
        if ($request->ajax()) {
            return view('partials.students-list', ['students' => $students])->render(); 
        }
    
        return redirect()->route('view.students');
    }
    
    // Search records
    public function searchStudents(Request $request)
    {
        $query = $request->input('query');

        // Search by name, email, or city
        $students = DB::table('students')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('city', 'LIKE', "%{$query}%")
            ->paginate(3);

        return view('students', ['students' => $students]);
    }



    public function singleUser($id)
    {
        $student = DB::table('students')
                   ->where('id', $id)->get();
        return view('view', ['data' => $student]);
    }

    public function addStudent(Request $req)
    {
          
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/',  
                'min:6'
            ],
            'age' => 'required|numeric|min:18',
            'gender' => 'required| string | max:10',
            'city' => 'required | string | max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000'
        ],[
             // Custom error messages
        'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
        
        ]);
        
        $file = $req->file('image');
        $filePath = $req->file('image')->store('upload_images', 'public');
        $subjects = $req->subjects;
        
        $student = DB::table('students')
        ->insert([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),       
            'age' => $req->age,
            'gender' => $req->gender,
            'city' => $req->city,
            'subjects' => json_encode($subjects),
            'fileName' => $filePath
        ]);
        
       
        if ($student) {
            return redirect()->route('view.students')->with('add', '<strong>New Record!</strong> Added Successfully...');;
        } else {
            return redirect()->route('view.students')->with('add', '<strong>Something Went Wrong!</strong> Date Note added...');;
            //echo "<h1>data not update</h1>";
        }


    }

       
    public function update(Request $request, $id)
    {
        // Fetch existing student data
        $student = DB::table('students')->where('id', $id)->first();

        if (!$student) {
            return redirect()->back()->with('update', '<strong>Error!</strong> Student not found...');
        }

        // Prepare updated data
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'city' => $request->city,
            'gender' => $request->gender,
            'subjects' => $request->subjects
        ];
        

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if (!empty($student->fileName)) {
                Storage::delete('public/' . $student->fileName);
            }

            // Store new file
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);

            // Update image in database
            $updateData['fileName'] = $fileName;
        }

        // Update student record
        $updated = DB::table('students')->where('id', $id)->update($updateData);

        if ($updated) {
            return redirect()->back()->with('update', '<strong>Your Data!</strong> Updated Successfully...');
        } else {
            return redirect()->back()->with('update', '<strong>Something Went Wrong!</strong> Data Not Update...');
        }
    }


    // public function updatePage(string $id)
    // {
    //     // $student = DB::table('students')->where('id',$id)->get();
    //     // return $student;

    //     $student = DB::table('students')->find($id);
    //     return view('updateUser', ['data' => $student]);


    // }

    // public function updateStudent(Request $req, $id)
    // {
    //     $updateData = [
    //         'name' => $req->name,
    //         'email' => $req->email,
    //         'age' => $req->age,
    //         'city' => $req->city
            
    //     ];
       
    //     // Fetch the existing student record
    //     $student = DB::table('students')->where('id', $id)->first();

    //     // Handle image update
    //     if ($req->hasFile('image')) {
    //         // Delete old image if exists
    //         if ($student && $student->fileName) {
    //             $oldImagePath = public_path('storage/' . $student->fileName);
    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }
    //         }
    //         // Store new image
    //         $filePath = $req->file('image')->store('upload_images', 'public');
    //         $updateData['fileName'] = $filePath;
    //     }


    //     // Check if password is provided, then hash and update it
    //     if ($req->filled('password')) {
    //         $updateData['password'] = bcrypt($req->password);
    //     }

    //     $student = DB::table('students')->where('id', $id)->update($updateData);

    //     if ($student) {
    //         return redirect()->route('view.students')->with('update', '<strong>Your Data!</strong> Updated Successfully...');
    //     } else {
    //         return redirect()->route('view.students')->with('update', '<strong>Something Went Wrong!</strong> Data Not Update...');
    //     }
    // }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('status', 'Student deleted successfully!');
    }



    public function deleteStudent(string $id)
    {
        // Get the student record
        $student = DB::table('students')->where('id', $id)->first();

        if ($student) {
            // Define the image path
            $imagePath = public_path('storage/' . $student->fileName);

            // Check if the file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Delete student record from the database
            DB::table('students')->where('id', $id)->delete();

            return redirect()->route('view.students')->with('status', '<strong>Your Data!</strong> have been deleted...');
        }

        return redirect()->route('view.students')->with('status', '<strong>Error:</strong> Student not found.');
    }
 


}
