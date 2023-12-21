<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table ='category_posts';
    protected $fillable =['category_id','post_id'];//this allows insert using array
    public $timestamps = false;

    //CategoryPosts to category
    //to get the name of the category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
