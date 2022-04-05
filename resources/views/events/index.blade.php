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
        if (Auth::user()->hasPermissionTo('users.index')) {
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
                    //A férőhelyek megtekintése, elérhető-e a jelentkezés.
                    function how_much_space($max_members, $event_id)
                    {
                        $count_joined_ppl = DB::table('event_joined')
                            ->where('event_id', $event_id)
                            ->count();
                    
                        if ($count_joined_ppl == $max_members) {
                            return 0;
                        } else {
                            return 1;
                        }
                    }
                    function check_year($year_event)
                    {
                      $year_user = Auth::user()->year;
                     
                      if(strpos($year_event, ',') !== false){

                        $year_event = explode(',', $year_event);
                   
                        foreach ($year_event as $years) {
                            if (trim($years, '"') == $year_user) {
                                return 1;
                            } else {
                                return 0;
                            }
                        }
                      }else{
                
                            if (trim($year_event, '"') == $year_user) {
                                return 1;
                            } else {

                                return 0;
                            }
  
                      }  
                    }
                    
                    $countable = 0;
                    
                    $events = DB::table('event_main')->get();
                    foreach ($events as $event) {
                        if (check_year($event->event_for) == 0) {
                        } else {
                            if (how_much_space($event->max_members, $event->id) < 1 && strcmp(Auth::user()->name, $event->owner) != 0) {
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
                                                        <div class="text-justify text-muted border-bottom-0">
                                                       Sajnos erre az eseményre nincs lehetőséged jelentkezni mivel elfogytak a férőhelyek.
                                                      </div>
                                                      </div>
                                                   
                                                      </div>
                                                  </div>
                                                  
                                                  ';
                            } else {
                                $countable += 1;
                    
                                $ifOwnPost =
                                    '
                                                            
                                                            <a href="' .
                                    url('/event/' . $event->id) .
                                    '" class="btn btn-sm btn-primary">
                                                             Tovább
                                                          </a>
                                                            ';
                    
                                $count_joined_ppl = DB::table('event_joined')
                                    ->where('event_id', $event->id)
                                    ->count();
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
                                                      <div class="card-header text-muted border-bottom-0">
                                                       Elérhető létszám: ' .
                                    ($event->max_members - $count_joined_ppl) .
                                    '
                                                      </div>
                                                      <div class="card-footer">
                                                        <div class="text-right">
                                                         ' .
                                    $ifOwnPost .
                                    '
                                                        </div>
                                                      </div>
                                                   
                                                      </div>
                                                  </div>
                                                  
                                                  ';
                            }
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
