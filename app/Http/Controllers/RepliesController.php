<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CreatePostRequest;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }

    public function store($channelId, Thread $thread, CreatePostRequest $form)
    {         
        return $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ])->load('owner');    
        
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if(request()->expectsJson()){
            return response(['status' => 'Reply deleted']);
        }
        
        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        try {
            $this->validate(request(), ['body' => 'required|spamfree']);
            
            $reply->update(request(['body']));

        }  catch (\Exception $e) {
            return response(
                'Sorry, your reply could not be saved at this time.', 422
            );
        }      
        
    }
   
}
