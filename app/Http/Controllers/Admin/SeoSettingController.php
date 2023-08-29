<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;

class SeoSettingController extends Controller
{
    public function index(){
        $data = Seo::first();
        return view('admin.setting.seo.index', compact('data'));
    }

    public function store(Request $request, $id){
        $data = [
            "meta_title" => $request->meta_title,
            "meta_author" => $request->meta_author,
            "meta_tag" => $request->meta_tag,
            "meta_description" => $request->meta_description,
            "meta_keyword" => $request->meta_keyword,
            "google_verification" => $request->google_verification,
            "meta_analytics" => $request->meta_analytics,
            "alexa_verification" => $request->alexa_verification,
            "google_adsense" => $request->google_adsense,
        ];

        Seo::where('id', $id)->update($data);
        $notification = array('message'=>'SEO Setting Updated!.', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
