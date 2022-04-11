@extends('layouts.app')

@section('content')
    @if (session('status'))
        <script>
            swal("Siker!", "{{ session('status') }}!", "success");
        </script>
    @endif

    <?php
    
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('users.own_event')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    
    userHasPermission();
    
    ?>

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
                        $events = DB::table('event_joined')->get();
                        foreach ($events as $event) {
                            if ($event->event_id == $event_id) {
                                if ($event->user_id == Auth::user()->id) {
                                    return 1;
                                }
                            }
                        }
                    }
                    
                    //A férőhelyek megtekintése, elérhető-e a jelentkezés.
                    
                    $events = DB::table('event_main')->get();
                    $countable = 0;

                  

                    foreach ($events as $event) {
                        $userName = DB::table("users")->where("id", $event->owner)->value("name");
                        if (user_has_event($event->id)) {
                            $countable += 1;
                            echo('
                                                                      
                                                                      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                                                        <div class="card bg-light d-flex flex-fill">
                                                                          <div class="card-header text-muted border-bottom-0">
                                                                           ' .
                                $userName .
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
                                url('/event/' . $event->id) .
                                '" class="btn btn-sm btn-primary">
                                                                                 Tovább
                                                                              </a>');

                                                                              
                                                                                $eventTime = $event->event_when;
                                                                              $when = date('Y-m-d', strtotime($eventTime.' -2 day'));
                                                                                $toDay = date('Y-m-d');
                                                                                
                                                                                if($toDay>=$when){
                                                                                   //doNothing
                                                                                }else{
                                                                                    echo('

                                                                                    <a href="' .
                                                                                    url('/demit/' . $event->id) .
                                                                                    '" class="btn btn-sm btn-danger">
                                                                                    Lemondás
                                                                                    </a>');
                                                                                }
                                                                            echo('</div>
                                                                          </div>
                                                                       
                                                                          </div>
                                                                      </div>
                                                            
                                                                      
                                                                      ');
                                                                    }
                                                                    
                    }
                    if ($countable == 0) {
                        echo('
                                                            
                                                            <div class="container">
                                                                <div class="row justify-content-center">     
                                                                     <h1> Nem jelentkeztél egy eseményre sem!</h1>
                                                                </div>
                                                                <br/>
                                                            </div>
                                                           
                                                            
                                                            ');
                    }
                    ?>


                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
