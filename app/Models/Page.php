<?php

namespace App\Models;

use Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = ['id',];
    protected $with = ['category', 'user', 'coment.replies'];

    public function getRouteKeyName()    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function coment(){
        return $this->hasMany(Coment::class)->whereNull('parent_id');   
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
