<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model

{
    protected $table ='curriculums';
    
    use HasFactory;
    public function homeworks(){
        return $this->hasMany(Homework::class);
    }
    public function attendeces(){
        return $this->hasMany(Attendece::class);
    }

}
