<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false; // Add this line to disable automatic timestamps
    // protected $fillable = ['image']; // Add this line to allow mass assignment
    protected $fillable = ['name', 'email', 'age', 'city', 'gender', 'image']; // Add this line to allow mass assignment


    protected function Name(): Attribute {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value)
        );

    }

}