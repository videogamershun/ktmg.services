@extends('layouts.app')

@section('content')
    <?php
    
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('users.events.user.demit')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    
    userHasPermission();
    
    ?>

    <br />

    <section class="content">

        <div class="card card-solid ">
            <div class="card-body pb-0 ">

                <div class="d-flex align-items-stretch flex-column">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Esemény - lemondás</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('demit_event') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="event_user"
                                        value="{{ Auth::user()->id }}" hidden>
                                    <input type="text" class="form-control" name="event_id"
                                        value="{{ Request::route('id') }}" hidden>
                                    <label>Esemény - időpont</label>
                                    <input class="form-control" style="text-align:center;" type="text" name="event"
                                        value="<?php
                                        $date = DB::table('event_main')
                                            ->where('id', Request::route('id'))
                                            ->value('event_when');
                                        echo date('Y-m-d', strtotime($date));
                                        ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Esemény - megnevezése</label>
                                    <input class="form-control" type="text" style="text-align:center;" name="owner"
                                        value="{{ DB::table('event_main')->where('id', Request::route('id'))->value('name') }}"
                                        disabled>

                                </div>
                            </div>
                            <!-- /.card-body -->


                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <div class="row">

                                        <button type="submit" class="w-30 btn btn-lg btn-outline-danger">LEMOND</button>
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
