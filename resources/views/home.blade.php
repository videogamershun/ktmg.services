@extends('layouts.app')

@section('content')
    @if (session('status'))
        <script>
            swal("Siker!", "{{ session('status') }}!", "success");
        </script>
    @endif
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v13.0"
        nonce="YJePdOIP"></script>

        <?php
    
        function userHasPermission()
        {
            if (Auth::user()->hasPermissionTo('home.index')) {
            } else {
                header('Location: /');
                die();
            }
        }
        
        userHasPermission();
        
        ?>
    <br />
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php $count_event = DB::table('event_main')
                                ->get()
                                ->count();
                            
                            echo $count_event;
                            ?></h3>

                            <p>Esemény összesen</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/events" class="small-box-footer">Tovább <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                
                <!-- ./col -->
            </div>
            <!-- /.row -->

    </section>
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Social</h3>
          </div>
            <div class="card-body pb-0">
              
           
                <div class="row">


                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-0">
                                <br />
                                <div class="fb-page" data-href="https://www.facebook.com/osztalybajnoksagok"
                                    data-tabs="timeline" data-width="450" data-height="" data-small-header="true"
                                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote cite="https://www.facebook.com/osztalybajnoksagok"
                                        class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/osztalybajnoksagok">Osztálybajnokságok
                                            Táncsics</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-0">
                                <br />
                                <div class="fb-page" data-href="https://www.facebook.com/KTMGOfficial"
                                    data-tabs="timeline" data-width="450" data-height="" data-small-header="true"
                                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote cite="https://www.facebook.com/KTMGOfficial" class="fb-xfbml-parse-ignore">
                                        <a href="https://www.facebook.com/KTMGOfficial">Kaposvári Táncsics Mihály
                                            Gimnázium</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-0">
                                <br />
                                <div class="fb-page" data-href="https://www.facebook.com/tancsicsinformatika"
                                    data-tabs="timeline" data-width="450" data-height="" data-small-header="true"
                                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote cite="https://www.facebook.com/tancsicsinformatika"
                                        class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/tancsicsinformatika">Táncsics Informatika</a>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </section>
@endsection
