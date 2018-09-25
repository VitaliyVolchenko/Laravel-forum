@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--@component('components.panel')--}}
                <div class="card panel-default">
                    <div class="card-header">
                        <a href="#">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                         {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="POST" action="{{ $thread->path().'/replies' }}">
                        {{ csrf_field() }}
                        <div class="forum-group">
                            {{--<label for="body">Body:</label>--}}
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to day?"></textarea>
                            <button type="submit" class="btn btn-default">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <p>Please<a href="{{ route('login') }}"> sign in</a> to participicate in this discussion.</p>
        @endif
    </div>
@endsection