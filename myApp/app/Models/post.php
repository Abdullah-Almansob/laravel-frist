<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{

    use HasFactory;
    protected $fillable = ['title', 'description','image_path','user_id']; 

    public function user(){
        return $this->belongsTo(related:User::class);
        //relationshp between post model and user model
    }
}