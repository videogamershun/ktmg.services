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
    
        if ($owner == Auth::user()->id) {
            //do Nothing
        } else {
            header('Location: /home');
            die();
        }
    }
    
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('event.request_people')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    
    check_event_exist();
    check_event_owner();
    userHasPermission();
    ?>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <form>
                        @csrf
                        <div class="card-body">
                            <input type="text" class="form-control" name="event_id" value="{{ Request::route('id') }}"
                                hidden>
                            <input type="text" class="form-control" name="user" value="{{ Auth::user()->id }}" hidden>
                            <div class="form-group" style="text-align:center;">
                                <h2>{{ DB::table('event_main')->where('id', Request::route('id'))->value('name') }}</h2>
                            </div>

                            <div class="form-group">
                            
                                <div class="form-group" style="text-align:center;">

                                    <section class="content">
                                        <div class="container-fluid">
                                            <!-- Small boxes (Stat box) -->
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3><?php $count_event = DB::table('event_main')
                                                                ->where("id",Request::route('id'))
                                                                ->value("max_members");
                                                            
                                                            echo $count_event;
                                                            ?></h3>
                                
                                                            <p>férőhely</p>
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3><?php $count_event = DB::table('event_joined')
                                                                ->where("event_id",Request::route('id') )
                                                                ->get()
                                                                ->count();
                                                            
                                                            echo $count_event;
                                                            ?></h3>
                                
                                                            <p>jelentkezés</p>
                                                        </div>
                                                         </div>
                                                </div>
                                                
                                              
                                            </div>
                                            <!-- /.row -->
                                
                                    </section>
                                </div>
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
                                                echo '        
                                                                                    <tr>
                                                                                      <th scope="row">' .
                                                    $count .
                                                    '</th>
                                                                                      <td>' .
                                                    $ppl_one->name .
                                                    '</td>
                                                                                      <td>' .
                                                    $ppl_one->year .
                                                    '</td>
                                                                                      <td>' .
                                                    $ppl_one->email .
                                                    '</td>
                                                                                    </tr>';
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
