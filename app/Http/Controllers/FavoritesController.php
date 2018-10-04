<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;

class FavoritesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new favorite in the database.
     *
     * @param  Reply $reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Reply $reply)
    {
         $reply->favorite();

         return back();

        //return $reply->favorites()->create(['user_id' => auth()->id() ]);    

        // Favorite::create([
        //         'user_id' => auth()->id(),
        //         'favorited_id' => $reply->id,
        //         'favorited_type' => get_class($reply)
        // ]);

        //  \DB::table('favorites')->insert([
        //     'user_id' => auth()->id(),
        //     'favorited_id' => $reply->id,
        //     'favorited_type' => get_class($reply)
        // ]);

    }
}