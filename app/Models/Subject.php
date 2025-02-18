<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    // Defining the 'subjects' table name if it differs from pluralized model name
    protected $table = 'subjects'; 

    // Mass assignment protection
    protected $fillable = ['subject', 'status']; // Add any fillable attributes

    // Relationship: Many-to-many with Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'subjects')
                    ->withPivot('enrollment_date', 'status')
                    ->withTimestamps();
    }
    
}
