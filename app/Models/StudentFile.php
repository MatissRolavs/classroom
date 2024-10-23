<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model
{
    use HasFactory;
    protected $fillable = ['task_id',"file", "path", "student_id"];
}
