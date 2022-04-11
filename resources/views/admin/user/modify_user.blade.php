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

    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('admin.modify_user')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    
    userHasPermission();
    
    //check_event_exist();
    // check_event_owner();
    ?>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <form action="{{ url('modify_user_role') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group" style="text-align:center;">
                                <h2>{{ DB::table('event_main')->where('id', Request::route('id'))->value('name') }}</h2>
                            </div>

  
                            <div class="form-group">
                                <label for="groupName">Felhasználók</label>
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Név</th>
                                            <th scope="col">Osztály</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col">
                                               
                                             </th>
                                            <th scope="col"><input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Keresés..">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        
                                     <?php 
                                    
                                    

                                    $users = DB::table('users')->get();

                                    $count = 0;
                                            foreach ($users as $user) {
                                                
                                                $count++;
                                        $roleId = DB::table('model_has_roles')->where("model_id", $user->id)->value('role_id');
                                        $roleName = DB::table('roles')->where("id", $roleId)->value('name');
                                        $allRole = DB::table('roles')->get();

                               

                                                echo(' <tr>
                                            <th scope="row">'.$count.'<input type="text" class="form-control" name="user_id" value="'.$user->id.'"
                                hidden></th>
                                            <td>'.$user->name.'</td>
                                            <td>'.$user->year.'</td>
                                            <td>'.$user->email.'</td>
                                            <td>
                                                <a href="/delete/user/'.$user->id.'" type="button" class="btn btn-danger">Törlés</a>
                                            </td>
                                            <td>
                                                <select class="custom-select form-control-border" aria-label="Jogkör" name="role">
                                                    "<option selected="selected">'.$roleName.'</option>"
                                                    ');

                                                    foreach ($allRole as $role) {
                                                        if($role->name !=$roleName){
                                                            echo("<option>".$role->name."</option>");
                                                        }
                                                    }

                                           
                                                echo('
                                                </select>

                                            </td>


                                        </tr>
                                                 ');


                                            }    
                                            
                                            
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                            <br />
                    </form>


                    <a class="w-30 btn btn-lg btn-outline-primary" href="{{ url('/home') }}">Vissza</a>
                    
                    <button type="submit" class="w-30 btn btn-lg btn btn-primary">Mentés</button>


                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
        
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }
        </script>
@endsection
