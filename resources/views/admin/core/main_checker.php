<?php
    
    public function core_selector(Request $request){

    }

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
    function userHasPermission()
    {
        if (Auth::user()->hasPermissionTo('admin.event.delete')) {
        } else {
            header('Location: /home');
            die();
        }
    }
    check_event_exist();
    check_event_owner();
    userHasPermission();
?>