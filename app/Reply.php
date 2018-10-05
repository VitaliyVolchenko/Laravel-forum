<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //use Favoriteable, RecordsActivity; 
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    public function  owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];
        if (! $this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    public function isFavorited()
    {
        
        //return $this->favorites()->where('user_id', auth()->id())->exists();
        return !! $this->favorites->where('user_id', auth()->id())->count();
        
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();

    }

}
