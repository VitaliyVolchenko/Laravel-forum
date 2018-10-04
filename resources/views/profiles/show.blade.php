@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @foreach ($threads as $thread)
                <div class="card panel-default">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                    <a href="#">{{ $thread->creator->name }}</a> posted:
                                {{ $thread->title }}
                            </span>

                            <span>{{ $thread->created_at->diffForHumans() }}</span>
                        </div>
                    </div><br>

                    <div class="card-body">                        
                            {{ $thread->body }}                            
                    </div> 

                </div><br>
        @endforeach<br>

        {{ $threads->links() }}
    </div>
@endsection
