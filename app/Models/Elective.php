<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elective extends Model
{
    use HasFactory;

    protected $fillable =[
        'student_id',
        'curriculum_id',
    ];
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum');
    }
}
