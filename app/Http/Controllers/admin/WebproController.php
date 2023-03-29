<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Webcat;
use App\Webpro;
use Image;
class WebproController extends Controller
{
    public function index(){

	$webcats=Webcat::all();
	$webpros=Webpro::all();

    	return view('admin.website.product.manage',['webcats'=>$webcats,'webpros'=>$webpros]);
    }


    protected function imageUpload($request){
        $productImage = $request->file('image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'public/uploads/';
        $imageUrl = $directory.$imageName;
    
        Image::make($productImage)->resize(500,500)->save($imageUrl);

        return $imageUrl;
    }

    protected function imageUpload1($request){
        $productImage = $request->file('image1');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'public/uploads/';
        $imageUrl1 = $directory.$imageName;
    
        Image::make($productImage)->resize(500,500)->save($imageUrl1);

        return $imageUrl1;
    }
protected function imageUpload2($request){
        $productImage = $request->file('image2');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'public/uploads/';
        $imageUrl2 = $directory.$imageName;
    
        Image::make($productImage)->resize(500,500)->save($imageUrl2);

        return $imageUrl2;
    }


    public function store(Request $request)
    {

     

       $request->validate([
        'name'=>'required',
        'status'=>'required',
        ]);

        if($request->file('image')!==null){
        $image=$this->imageUpload($request);
      }else{
         $image=null;
      }

       if($request->file('image1')!==null){
        $image1=$this->imageUpload1($request);
      }else{
         $image1=null;
      }

       if($request->file('image2')!==null){
        $image2=$this->imageUpload2($request);
      }else{
         $image2=null;
      }

     
        
        $post=new Webpro;
        $post->name=$request->name;
        $post->description =$request->description;
        $post->c_id=$request->c_id;
        $post->brand=$request->brand;
        $post->price=$request->price;
        $post->condition=$request->condition;
        $post->status=$request->status;	
        $post->image=$image;
        $post->image1=$image1;
        $post->image2=$image2;
        $post->save();
       
        Toastr::success('Successully Added :)' ,'Success');
        return redirect()->route('admin.webpro');
    }
}
