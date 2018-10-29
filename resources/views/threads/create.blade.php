@extends('layouts.app')

{{-- @section('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card panel-default">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="channel_id">Choose a Channel:</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Choose One...</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' :'' }}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" name="title" id="title=" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" type="body" class="form-control" rows="8" id="body=" required>{{ old('body') }}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LecZHcUAAAAAP6JmoJm0_hXPdie1TiVjOe4HxQt"></div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                            @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }} </li>
                                @endforeach
                            </ul>
                            @endif
                            
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
