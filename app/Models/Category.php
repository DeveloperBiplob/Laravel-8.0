<?php

namespace App\Models;

use App\Events\CategoryDeleteEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'slug', 'status', 'image'
    ];

    //mutators-->
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accesor-->
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    protected $dispatchesEvents = [
        'deleted' => CategoryDeleteEvent::class,
        // 'created' => CategoryCreateEvent::class,
        // 'updated' => CategoryUpdateEvent::class,
    ];


    // Cache with boot function-------

    protected static function booted()
    {
        static::updated(function () {
            Cache()->forget('caches');
        
            Cache()->rememberForever('caches', function () {
                return Category::get();
            });

        });
    }
}
