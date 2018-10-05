@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{--@component('components.panel')--}}
                <div class="card panel-default">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted:
                                {{ $thread->title }}
                            </span>

                            @if (Auth::check())
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-link">Delete Thread</button>
                                </form>
                            @endif
                        </div>
                    
                    </div>

                    <div class="card-body">
                         {{ $thread->body }}
                    </div>
                </div><br>                

                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach
                <br>

                {{ $replies->links() }}
                
                <br>

                @if(auth()->check())
                
                    <form method="POST" action="{{ $thread->path().'/replies' }}">
                        {{ csrf_field() }}
                        <div class="forum-group">
                            {{--<label for="body">Body:</label>--}}
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to day?"></textarea>
                            <button type="submit" class="btn btn-default">Post</button>
                        </div>
                    </form>
                   
                @else
                    <p>Please<a href="{{ route('login') }}"> sign in</a> to participicate in this discussion.</p>
                @endif

            </div>
        
            <div class="col-md-4">
                <div class="card panel-default"> 
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by 
                            <a href="#"> {{ $thread->creator->name }}</a>, and currently 
                            has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }} . 
                        </p>
                         {{ $thread->body }}
                    </div>
                </div>
            </div>


        </div>         
    </div>
@endsection