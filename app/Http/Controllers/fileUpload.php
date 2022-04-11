<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use App\Http\Requests;
use App\Htpp\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class fileUpload extends Controller
{

    public function fileUpload()
    {
        return view('home');
    }

    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        $fileName =  'database.' . $request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success', 'You have successfully upload file.')
            ->with('file', $fileName);
    }
}
