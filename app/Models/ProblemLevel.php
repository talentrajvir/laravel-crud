<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemLevel extends Model
{
    protected $table = 'problem_levels';
    protected $fillable = ['problem_level'];
    use HasFactory;
}
