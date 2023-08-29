<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index(){
        $data = Setting::first();
        return view('admin.setting.setting.index', compact('data'));
    }

    public function store(Request $request, $id){

        if($request->logo){
            if( File::exists($request->old_logo) ){
                unlink($request->old_logo);
            }
            $logo = $request->logo;
            $logo_name = uniqid() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save(public_path('files/setting/'). $logo_name);            
        }else{
            $logo_name = $request->old_logo;
        }

        if($request->favicon){
            if( File::exists($request->old_favicon) ){
                unlink($request->old_favicon);
            }
            $favicon = $request->favicon;
            $favicon_name = uniqid() . '.' . $favicon->getClientOriginalExtension();
            Image::make($logo)->resize(32, 32)->save(public_path('files/setting/'). $favicon_name);   
        }else{
            $favicon_name = $request->old_favicon;
        }
        $data = [
            'currency'      => $request->currency,
            'phone_one'     => $request->phone_one,
            'phone_two'     => $request->phone_two,
            'main_email'    => $request->main_email,
            'support_email' => $request->support_email,
            'logo'          => 'files/setting/' . $logo_name,
            'favicon'       => 'files/setting/' . $favicon_name,
            'address'       => $request->address,
            'facebook'      => $request->facebook,
            'twitter'       => $request->twitter,
            'instagram'     => $request->instagram,
            'linkedin'      => $request->linkedin,
            'youtube'       => $request->youtube,
        ];
        

        Setting::where('id', $id)->update($data);
        $notification = array('message'=>'Setting Updated successfully.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
