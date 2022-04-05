@extends('layouts.app')

@section('content')
@if (session('status'))
<script>
    swal("Siker!", "{{ session('status') }}!", "success");
</script>
@endif
    <br />
    <?php
    
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('admin.create_role')) {
        } else {
            header('Location: /home');
            die();
        }
    }

  //  userHasPermission();

    ?> 

    <section class="content">

        <div class="card card-solid ">
            <div class="card-body pb-0 ">

                <div class="d-flex align-items-stretch flex-column">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Jogosultság - létrehozás</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ url('create_new_role') }}" method="post">
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Csoport - megnevezése</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Diák">
                                </div>
                             
                                <div class="form-group">
                                  <label>Jogosultságok</label> <br/>
                                    <?php
                                    
                                    $permissions = DB::table('permissions')->get();
                                    
                                    $permcount = 0;
                                    foreach ($permissions as $permission) {

                                      $permcount++;
                                     
                                    
                                        echo('   
                                        <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="check_list[]"
                                                                                value="'.$permission->name.'">
                                                  <label class="form-check-label" for="inlineCheckbox1">'.$permission->name.'</label>
                                                </div>
                                         ');
                                         if($permcount==3){
                                       
                                            echo('<br/>');
                                            $permcount=0;
                                          }
                                    }
                                    
                                    ?>

                                </div>
                  


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Létrehozás</button>
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
@endsection
