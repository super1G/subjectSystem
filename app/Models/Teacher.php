<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'birthday',
        'description',
    ];
    public function curriculum(){
        return $this->hasMany('App\Models\Curriculum','teacher_id','id');
    }
    
}
