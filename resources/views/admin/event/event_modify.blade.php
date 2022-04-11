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
        
            if ($owner == Auth::user()->id) {
          //do Nothing
        } else {
            header("Location: /home");
            die();
        }
      
    }

    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('admin.event.modify')) {
        } else {
            header('Location: /home');
            die();
        }
    }

    userHasPermission();
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
                            <h3 class="card-title">Esemény - módósítás</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('modify_event') }}" method="post">
                            @csrf

                            <div class="card-body">
                                <input type="text" class="form-control" name="event_id" value="{{ Request::route('id') }}"
                                hidden>
                                <div class="form-group">
                                    <label>Esemény - megnevezése</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ DB::table('event_main')->where('id', Request::route('id'))->value('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>Mikor:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" name="event_date" value="<?php
                                            $date = DB::table('event_main')
                                                ->where('id', Request::route('id'))
                                                ->value('event_when');
                                            echo date('Y-m-d', strtotime($date));
                                            ?>"
                                            class="form-control datetimepicker-input">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label>Maximum létszám</label>
                                    <input type="number" class="form-control" name="max_members"
                                    value="{{ DB::table('event_main')->where('id', Request::route('id'))->value('max_members') }}" placeholder="Maximum létszám: 20">
                                </div>
                                
                                <div class="form-group">

                                    <div class="centered">
                                        <div class="editor-container">
                                            <textarea class="form-group" id="editor" name="content" >
                                            {!! DB::table('event_main')->where('id', Request::route('id'))->value('description') !!}
                                        </textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Módósítás</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        </div>



    </section>
    <script>
        $('#selector').select2({
            width: '100%',
            placeholder: "Válassz osztályt",
            allowClear: true,
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
