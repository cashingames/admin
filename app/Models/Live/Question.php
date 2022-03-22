<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $connection = 'mysqllive';

    protected $fillable = ['created_by','is_published'];

    protected $casts = [
        'is_published' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(Option::class)->inRandomOrder();
    }


}
