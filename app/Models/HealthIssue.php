<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthIssue extends Model
{
    protected $table = 'health_issues';
    use HasFactory;

    public function problem_type()
    {
        return $this->belongsTo(ProblemType::class);
        
    }

    public function problem_level()
    {
       return $this->belongsTo(ProblemLevel::class);
       
    }
}
