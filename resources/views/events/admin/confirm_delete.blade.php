@extends('layouts.app')

@section('content')
<?php
    
    function check_event_exist()
    {
        $events = DB::table('event_main')
            ->where('id', Request::route('id'))
            ->value('id');
        
            
            if ($events =="") {
          
            header("Location: /home");
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
            header("Location: /home");
            die();
        }
      
    }
    check_event_exist();
    check_event_owner();
    ?>
    <br />

    <section class="content">

        <div class="card card-solid ">
            <div class="card-body pb-0 ">

                <div class="d-flex align-items-stretch flex-column">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Esemény - törlés</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('delete_event') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Esemény - egyedi azonosítója</label>
                                    <input class="form-control" style="text-align:center;" type="text" name="event"
                                        value="{{ Request::route('id') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Esemény - megnevezése</label>
                                    <input class="form-control" type="text" style="text-align:center;" name="owner"
                                        value="{{ Auth::user()->name }}" disabled>

                                </div>
                            </div>
                            <!-- /.card-body -->


                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <div class="row">

                                        <button type="submit" class="w-30 btn btn-lg btn-outline-danger">TÖRLÉS</button>
                                        <a class="w-30 btn btn-lg btn-outline-primary" href="{{ url('/home') }}">MÉGSE</a>
                                    </div>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>



    </section>


@endsection
