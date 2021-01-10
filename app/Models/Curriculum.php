<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'teacher_id',
        'teaching_assistant',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
