<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillabl=[
        'name'
    ];

    //to get categoryPost using category
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
}
