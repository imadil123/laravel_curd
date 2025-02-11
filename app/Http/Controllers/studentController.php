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
        $students = DB::table('students')->paginate(5);
        return view('students', ['data' => $students]);
    }


    public function singleUser($id)
    {
        $student = DB::table('students')
                   ->where('id', $id)->first();
        // Convert subjects string back into an array
        if ($student) {
            $student->subjects = explode(',', $student->subjects);
        }           

        return view('view', ['data' => $student]);
    }

    public function addStudent(Request $req)
    {
          
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6',
            'age' => 'required|numeric|min:18',
            'gender' => 'required| string | max:10',
            'city' => 'required | string | max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'subjects' => 'required|array', // Ensure subjects is an array

        ]);
        
        $file = $req->file('image');
        $filePath = $req->file('image')->store('upload_images', 'public');

          // Convert subjects array into a string
          $subjects = implode(',', $req->subjects);

        
        $student = DB::table('students')
        ->insert([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),       
            'age' => $req->age,
            'gender' => $req->gender,
            'city' => $req->city,
            'fileName' => $filePath,
            'subjects' => json_encode($req->subjects), // Convert array to JSON

        ]);
        
       
        if ($student) {
            return redirect()->route('view.students')->with('add', '<strong>New Record!</strong> Added Successfully...');;
        } else {
            return redirect()->route('view.students')->with('add', '<strong>Something Went Wrong!</strong> Date Note added...');;
            //echo "<h1>data not update</h1>";
        }


    }


    public function updatePage(string $id)
    {
        // $student = DB::table('students')->where('id',$id)->get();
        // return $student;

        $student = DB::table('students')->find($id);
        return view('updateUser', ['data' => $student]);


    }

    public function updateStudent(Request $req, $id)
    {
        $updateData = [
            'name' => $req->name,
            'email' => $req->email,
            'age' => $req->age,
            'city' => $req->city,
            'subjects' => json_encode($req->subjects), // Convert array to JSON
            
        ];
       
        // Fetch the existing student record
        $student = DB::table('students')->where('id', $id)->first();

        // Handle image update
        if ($req->hasFile('image')) {
            // Delete old image if exists
            if ($student && $student->fileName) {
                $oldImagePath = public_path('storage/' . $student->fileName);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Store new image
            $filePath = $req->file('image')->store('upload_images', 'public');
            $updateData['fileName'] = $filePath;
        }


        // Check if password is provided, then hash and update it
        if ($req->filled('password')) {
            $updateData['password'] = bcrypt($req->password);
        }

        $student = DB::table('students')->where('id', $id)->update($updateData);

        if ($student) {
            return redirect()->route('view.students')->with('update', '<strong>Your Data!</strong> Updated Successfully...');
        } else {
            return redirect()->route('view.students')->with('update', '<strong>Something Went Wrong!</strong> Data Not Update...');
        }
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
