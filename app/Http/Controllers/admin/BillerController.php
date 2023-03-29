<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Biller;
use Brian2694\Toastr\Facades\Toastr;

class BillerController extends Controller
{
    public function addBiller()
    {
        return view('admin.modules.people.biller.billerAdd');
    }
    public function billerSave(Request $request)
    {
      $request->validate([
         'name'=>'required',
         'phone'=>'required',
     ]);

      $biller=new Biller;
      $biller->phone=$request->phone;
      $biller->name=$request->name;
      $biller->email=$request->email;
      $biller->address=$request->address;
      $biller->city=$request->city;
      $biller->postal_code=$request->postal_code;
      $biller->invoice_footer=$request->invoice_footer;
      try{
         $biller->save();
         Toastr::success('New Biller Added Successfully');
         return redirect()->route('admin.people.listBiller');
     }catch(\Exception $e)
     {
        session()->flash('error-message',$e->getMessage());
        return redirect()->back();

    }
}
public function listBiller()
{
   $billers=Biller::all();
   return view('admin.modules.people.biller.billerList')->with(['billers'=>$billers]);
}
}
