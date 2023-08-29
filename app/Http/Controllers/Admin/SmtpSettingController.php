<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smtp;

class SmtpSettingController extends Controller
{
    public function index(){
        $data = Smtp::first();
        return view('admin.setting.smtp.index', compact('data'));
    }

    public function store(Request $request, $id){
        $data = [
            "mailer" => $request->mailer,
            "host" => $request->host,
            "port" => $request->port,
            "username" => $request->username,
            "password" => $request->password,
        ];

        Smtp::where('id', $id)->update($data);
        $notification = array('message'=>'SMTP Setting Updated!.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
