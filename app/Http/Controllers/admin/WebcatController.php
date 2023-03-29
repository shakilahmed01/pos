<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Webcat;
use Image;
class WebcatController extends Controller
{
    public function index(){

	$webcats=Webcat::all();

    	return view('admin.website.category.manage',['webcats'=>$webcats]);
    }


  protected function imageUpload($request){
        $productImage = $request->file('image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'public/uploads/';
        $imageUrl = $directory.$imageName;
    
        Image::make($productImage)->resize(960,540)->save($imageUrl);

        return $imageUrl;
    }

     protected function saveProductInfo($request, $imageUrl){
        $client = new Webcat();
        $client->cname = $request->cname;
        $client->status = $request->status;
        $client->description = $request->description;
        $client->image = $imageUrl;
       if($client->save()){
       	Toastr::success('Successully Added :)' ,'Success');
            return redirect('admin/website/category')->with('message','Added Successfully');

        }
    }

     public function store(Request $request){
        $request->validate([

            
           
             'cname'=>'required',
            
           
        ]);
        //$this->validateproduct($request);
         $imageUrl = $this->imageUpload($request);
        $this->saveProductInfo($request, $imageUrl);

       return redirect('admin/website/category')->with('error','There have an error !!');

    }
}
