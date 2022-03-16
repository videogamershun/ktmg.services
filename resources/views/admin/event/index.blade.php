@extends('layouts.app')

@section('content')
    @if (session('status'))
        <script>
            swal("Siker!", "{{ session('status') }}!", "success");
        </script>
    @endif
    <br />
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">

                    <?php
                    
                    // Ezzel hozom létre a rövid szöveget.
                    function create_shortText($formattedSt)
                    {
                        if (strlen($formattedSt) < 150) {
                            return '<p class="card-text mb-auto">' . $formattedSt . '</p>';
                        } else {
                            for ($i = 0; $i < 150; $i++) {
                                if ($i == 149) {
                                    if ($formattedSt[$i] == ' ') {
                                        return '<p class="card-text mb-auto">' . substr($formattedSt, 0, 149) . '... </p>';
                                    } else {
                                        for ($k = 150; $k > 0; $k--) {
                                            if ($formattedSt[$k] == ' ') {
                                                return '<p class="card-text mb-auto">' . substr($formattedSt, 0, $k) . '... </p>';
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    function user_has_event($event_id)
                    {
                        $events = DB::table('event_main')->get();
                        foreach ($events as $event) {
                            if ($event->id == $event_id) {
                                if ($event->owner == Auth::user()->name) {
                                    return 1;
                                }
                            }
                        }
                    }
                    
                    //A férőhelyek megtekintése, elérhető-e a jelentkezés.
                    
                    $events = DB::table('event_main')->get();
                    $countable = 0;
                    foreach ($events as $event) {
                        if (user_has_event($event->id)) {
                            $countable += 1;
                            echo '
                                                  
                                                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                    <div class="card bg-light d-flex flex-fill">
                                                      <div class="card-header text-muted border-bottom-0">
                                                       ' .
                                $event->owner .
                                '
                                                      </div>
                                                      <div class="card-body pt-0">
                                                        <div class="row">
                                                          <div class="col-12">
                                                            <h2 class="lead"><b>' .
                                $event->name .
                                '</b></h2>
                                                            <p class="text-muted text-sm"><b>Az eseményről: </b> ' .
                                create_shortText(strip_tags($event->description)) .
                                '</p>
                                                           
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="card-footer">
                                    
                                                        <div class="text-right">
                                                            <a href="' .
                                url('/event/request/' . $event->id) .
                                '" class="btn btn-sm btn-success">
                                                             Lekérdezés
                                                          </a>
                                                          <a href="' .
                                url('/event/modify/' . $event->id) .
                                '" class="btn btn-sm btn-primary">
                                                             Módosítás
                                                          </a>
                                                          <a href="' .
                                url('/event/delete/' . $event->id) .
                                '" class="btn btn-sm btn-danger">
                                                             Törlés
                                                          </a>
                                                        </div>
                                                      </div>
                                                   
                                                      </div>
                                                  </div>
                                        
                                                  
                                                  ';
                        }
                    }
                    if ($countable == 0) {
                        echo '
                                        
                                        <div class="container">
                                            <div class="row justify-content-center">     
                                                 <h1> Nem rendelkezel egy eseménnyel sem!</h1>
                                            </div>
                                            <br/>
                                        </div>
                                       
                                        
                                        ';
                    }
                    ?>


                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
