@extends('layouts.app')

@section('content')
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <form action="{{ url('check-in') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <input type="text" class="form-control" name="event_id" value="{{ Request::route('id') }}"
                                hidden>
                            <input type="text" class="form-control" name="user" value="{{ Auth::user()->id }}" hidden>
                            <div class="form-group" style="text-align:center;">
                                <h2>{{ DB::table('event_main')->where('id', Request::route('id'))->value('name') }}</h2>
                            </div>

                            <div class="form-group">
                                <label for="groupName">Leírás</label>
                                {!! DB::table('event_main')->where('id', Request::route('id'))->value('description') !!}
                            </div>
                            <br />
                    </form>


                    <a class="w-30 btn btn-lg btn-outline-primary" href="{{ url('/events') }}">Vissza</a>

                    <?php
                    
                    $user_checkedin = DB::table('event_joined')
                        ->where('event_id', Request::route('id'))
                        ->value('user_id');
                    
                    if (Auth::user()->id != $user_checkedin || $user_checkedin == null) {
                        echo('
                             <button type="submit" class="w-30 btn btn-lg btn-outline-primary">Jelentkezés</button> 
                            ');
                    } else {
                       
                    }
                    
                    ?>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
