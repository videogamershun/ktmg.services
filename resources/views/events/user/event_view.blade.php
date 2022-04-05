@extends('layouts.app')

@section('content')
    <?php
    
    function check_event_exist()
    {
        $events = DB::table('event_main')
            ->where('id', Request::route('id'))
            ->value('id');
    
        if ($events == '') {
            header('Location: /home');
            die();
        } else {
            //do nothing;
        }
    }
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('users.event_view')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    check_event_exist();
    userHasPermission();
    ?>
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


                    <a class="w-30 btn btn-lg btn-outline-primary" href="{{ url('/home') }}">Vissza</a>

                    <?php
                    
                    $user_checkedin = DB::table('event_joined')
                        ->where('event_id', Request::route('id'))
                        ->where('user_id', Auth::user()->id)
                        ->get();
                    
                    if ($user_checkedin == '[]') {
                        echo '
                                                                                                                                                     <button type="submit" class="w-30 btn btn-lg btn-outline-primary">Jelentkezés</button> 
                                                                                                                                                    ';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
