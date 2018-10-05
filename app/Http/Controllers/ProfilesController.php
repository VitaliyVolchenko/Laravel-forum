<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    
    public function show(User $user)
    {
        //$activities = $this->getActivity($user);

        // $activities = $user->activity()->latest()->with('subject')->take(50)->get()->groupBy(function($activity){
        //     return $activity->created_at->format('Y-m-d');
        // });
        
        return view('profiles.show',[
            'profileUser' => $user,
            //'threads' => $user->threads()->paginate(30)
            'activities' => $this->getActivity($user)
        ]);
    }

    protected function getActivity(User $user)
    {
        return $user->activity()->latest()->with('subject')->take(50)->get()->groupBy(function($activity){
            return $activity->created_at->format('Y-m-d');
        });        
    }


}
