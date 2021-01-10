<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'birthday',
        'description',
    ];
    public function elective(){
        return $this->hasMany('App\Models\Elective','student_id','id');
    }
}
