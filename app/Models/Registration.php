<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function getActiveAttribute(){
        return $this->status ? "completed":"notCompeleted";
    }
    public function course(){
        return $this->belongsTo(Course::class,"course_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
