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
    function check_event_owner()
    {
        $owner = DB::table('event_main')
            ->where('id', Request::route('id'))
            ->value('owner');
    
        if ($owner == Auth::user()->name) {
            //do Nothing
        } else {
            header('Location: /home');
            die();
        }
    }
    check_event_exist();
    check_event_owner();
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
                                <label for="groupName">Jelentkezések</label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Név</th>
                                            <th scope="col">Osztály</th>
                                            <th scope="col">E-mail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $data = DB::table('event_joined')
                                            ->where('event_id', Request::route('id'))
                                            ->get();
                                        $count = 0;
                                        foreach ($data as $people) {
                                            $count++;
                                            $ppl = DB::table('users')
                                                ->where('id', $people->user_id)
                                                ->get();
                                        
                                            foreach ($ppl as $ppl_one) {
                                                echo('        
                                            <tr>
                                              <th scope="row">'.$count.'</th>
                                              <td>'.$ppl_one->name.'</td>
                                              <td>'.$ppl_one->year.'</td>
                                              <td>'.$ppl_one->email.'</td>
                                            </tr>');
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <br />
                    </form>


                    <a class="w-30 btn btn-lg btn-outline-primary" href="{{ url('/admin_own') }}">Vissza</a>

                 
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
