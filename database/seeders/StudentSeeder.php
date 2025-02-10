<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\File; // Ensure this import is present

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Use the correct path for the JSON file
        // dd(database_path('json/student.json'));

        $json = File::get(database_path('seeders\json\student.json')); // Corrected path
        $students = collect(json_decode($json));

        $students->each(function ($student) {
            Student::create([
                'name' => $student->name,
                'email' => $student->email,
                'age' => $student->age,
                'city' => $student->city
            ]);
        });
    }
}
