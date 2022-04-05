<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Htpp\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class event_manager extends Controller
{
    public function insert(Request $request)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $eventId =substr(str_shuffle(str_repeat($pool, 5)), 0, 10);
        
        $owner = $request->input('owner');
        $name = $request->input('name');
        $event_date = $request->input('event_date');
        $max_members = $request->input('max_members');
        $yearsBeforecut =  json_encode($request->input('years'));
        $years =  substr($yearsBeforecut, 1, -1);
        $content = $request->input('content');

        $data = array("id" => $eventId, "name" => $name, "owner" => $owner, "description" => $content, "event_when" => $event_date
       , "max_members" => $max_members, "event_for" => $years);

        DB::table('event_main')->insert($data);

        return redirect("/home")->with('status', "Sikeresen elküldted a(z) üzentet részére!");
    }
    public function delete(Request $request)
    {
       
        $event = $request->input('event');
        DB::table('event_main')->where('id', $event)->delete();

        return redirect("/events")->with('status', "Sikeresen törölted a(z) eseményt");
    }
    public function demit(Request $request)
    {
       
        $event = $request->input('event_id');
        $user = $request->input('event_user');
      

          
      DB::table('event_joined')->where('event_id', $event)->where('user_id', $user)->delete();

        return redirect("/home")->with('status', "Sikeresen lemondtad a(z) eseményt");
    }
    public function modify(Request $request)
    {
        $event_id = $request->input('event_id');
        $event_name = $request->input('name');
        $event_date = $request->input('event_date');
        $max_members = $request->input('max_members');
        $content = $request->input('content');

        $data = array('name' => $event_name, "event_when" => $event_date, "max_members"=>$max_members, "description"=>$content);
        DB::table('event_main')->where('id', $event_id)->update($data);


        return redirect("/events")->with('status', "Sikeresen modosítottad az esemény részleteit!");
    }
    public function check_in(Request $request)
    {
       
       
        
        $event_id = $request->input('event_id');
        $user = $request->input('user');

        $data = array("user_id" => $user, "event_id" => $event_id);

        DB::table('event_joined')->insert($data);

        return redirect("/events")->with('status', "Sikeresen jelentkeztél az eseményre");
  
    }

}
