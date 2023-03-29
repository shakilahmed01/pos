<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerGroup;
use App\Customer;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Image;
use App\SalesDueReturn;
use App\Payment;
use Auth;

class CustomerController extends Controller
{
   public function customerList()
   {
     $customerGroups=CustomerGroup::all();
     $customers=Customer::paginate(10);
     return view('admin.modules.people.customer.customerList')->with(['customers'=>$customers,'customerGroups'=>$customerGroups]);
  }
  public function customerAdd()
  {
   $customerGroups=CustomerGroup::all();
   return view('admin.modules.people.customer.customerAdd')->with(['customerGroups'=>$customerGroups]);
}

public function customerSave(Request $request)
{
   $request->validate([
      'mobile'=>'required|numeric|unique:customers',
   ]);
   $customer=new Customer;
   $customer->mobile=$request->mobile;
   $customer->name=$request->name;
   $customer->group=$request->group;
   $customer->email=$request->email;
   $customer->address=$request->address;
   $customer->company=$request->company;
   $customer->start_balance=$request->start_balance;
   try{
      $customer->save();
      Toastr::success('Customer added successfully','success');
      return redirect()->route('admin.customerList');
   }catch(\Exception $e){
      session()->flash('error-message',$e->getMessage());
      return redirect()->back();

   }

}
public function customerGroup()
{
  $customerGroups=CustomerGroup::paginate(10);
  return view('admin.modules.setting.customer.customerGroup')->with(['customerGroups'=>$customerGroups]);
}

public function customerGroupSave(Request $request)
{
  $request->validate([
    'name'=>'required',
 ]);
  $customerGroup=new CustomerGroup;
  $customerGroup->name=$request->name;
  $customerGroup->percentage=$request->percentage;

  try{
    $customerGroup->save();
    Toastr::success('New Customer Added Successfully.');
    return redirect()->route('admin.customerGroup');
 }catch(\Exception $e){
   session()->flash('error-message',$e->getMessage());
   return redirect()->back();

}
}

   //customer details 
public function customerDetails($id)
{
  $duePaymentHistory=DB::table('sales_due_returns')->where('customer_id',$id)->get();
   $customerInfo=DB::table('customers')->where('id',$id)->first();
   $shoppingHistory=DB::table('sales')
   ->join('billers','billers.id','=','sales.biller_id')
   ->select('sales.*','billers.name')
   ->where('sales.customer_id',$id)->get();
   $totalShopping=DB::table('sales')->where('customer_id',$id)->sum('grand_total');
   $totalDue=DB::table('sales')->where('customer_id',$id)->sum('due');

   $start_balance=DB::table('customers')->where('id',$id)->value('start_balance');
   $totalDue=$totalDue+$start_balance;
   $totalDueReturn=DB::table('sales_due_returns')->where('customer_id',$id)->sum('paid_amount');
   $currentDue=$totalDue-$totalDueReturn;
   return view('admin.modules.people.customer.customerDetails')->with(['customerInfo'=>$customerInfo,'shoppingHistory'=>$shoppingHistory,'totalShopping'=>$totalShopping,'totalDue'=>$totalDue,'currentDue'=>$currentDue,'totalDueReturn'=>$totalDueReturn,'duePaymentHistory'=>$duePaymentHistory]);
}

   //ajax search customer by mobile id
public function searchCustomer(Request $request)
{

   $key=$request->key;

   $customers=DB::table('customers')
   ->where('id','like','%'.$request->key.'%')
   ->orWhere('name','like','%'.$request->key.'%')
   ->orWhere('mobile','like','%'.$request->key.'%')
   ->get();
   if(!$customers->isEmpty()){
      foreach($customers as $customer)
      {
       echo "<a href='customer-details/".$customer->id."' class='list-group-item list-group-item-action mx-0 py-2'>".$customer->name."(".$customer->mobile.")</a>";
    }
 }else{
  echo "<a href='#' class='list-group-item list-group-item-action mx-0 py-2'>No customer found</a>";
}

}
   //edit customer information
public function customerInfo(Request $request)
{
   $customerInfos=DB::table('customers')->where('id',$request->customerId)->first();
   return view('admin.modules.people.customer.editCustomer')->with(['customerInfos'=>$customerInfos]);
}
protected function imageUpload($request){
 $productImage = $request->file('image');
 $imageName = $productImage->getClientOriginalName();
 $directory = 'public/uploads/customer_image/';
 $imageUrl = $directory.$imageName;

 Image::make($productImage)->resize( 80,80)->save($imageUrl);

 return $imageUrl;
}
   //update customer 
public function updateCustomer(Request $request)
{
   $request->validate([
    'id'=>'required',

 ]);
   if($request->file('image')!==null){
    $image=$this->imageUpload($request);
 }else{
   $image=DB::table('customers')->where('id',$request->id)->value('image');
}
try{
   DB::table('customers')->where('id',$request->id)
   ->update([
      'name'=>$request->name,
      'email'=>$request->email,
      'mobile'=>$request->mobile,
      'address'=>$request->address,
      'image'=>$image,
      'company'=>$request->company,
   ]);
   Toastr::success('Customer Basic Info Updated Successfully.');
   return redirect()->route('admin.customer.customerDetails',$request->id);
}catch(\Exception $e){
   session()->flash('error-message',$e->getMessage());
   return redirect()->back();

}
}

   //return Sales Due
public function returnSalesDue(Request $request)
{
   $request->validate([
      'customer_id'=>'required',
      'current_due'=>'required|numeric',
      'amount'=>'required|numeric', 
      'customer_id'=>'required|numeric',
      'paid_date'=>'required',
   ]);
  $amount=$request->amount;
  $dues=DB::table('sales')->where('customer_id',$request->customer_id)->where('sales.due','>','sales.due_return')->get();
    foreach($dues as $due){
       $du=$due->due;
       $due_return=$due->due_return;
      if($amount<1){
         break;
      }elseif($amount<$du) {
        if($due_return<$du){
        $paid=$amount;
        // $remainDue=$du-$amount;
        $amount=$amount-$du;
        $update_due_return=$due_return+$paid;
        DB::table('sales')->where('id',$due->id)->where('customer_id',$request->customer_id)->update(['due_return'=>$update_due_return]);
      }
      }
      else{
     if($due_return<$du){
      $id=$due->id;
      $amount=$amount-$du;
      $paid=$du;
      $update_due_return=$due_return+$paid;
      // $remainDue=$du-$paid;
      DB::table('sales')->where('id',$due->id)->where('customer_id',$request->customer_id)->update(['due_return'=>$update_due_return]);
    }
      }
       
    }
//ok
   $balance=$request->current_due-$request->amount;
   $dueReturn=new SalesDueReturn;
   $dueReturn->customer_id=$request->customer_id;
   $dueReturn->paid_amount=$request->amount;
   $dueReturn->current_due=$request->current_due;
   $dueReturn->balance=$balance;
   $dueReturn->payment_method=$request->payment_method;
   $dueReturn->payment_note=$request->paymentNote;
   $dueReturn->paid_date=$request->paid_date;

   $pay=Payment::all();
   $pay=count($pay)+1;
   $paycode='PAY-'.date('Y-m-d').'/'.$pay;

   $payment=New Payment;
   $payment->reference=$paycode;
   $payment->salereference='DUE-RETURN/'.$request->customer_id;
   $payment->type='Received';
   $payment->amount=$request->amount;
   $payment->paidBy=$request->payment_method;
   $payment->pDate=$request->paid_date;
   $payment->transectionBy=Auth::user()->id;

   try{
      $dueReturn->save();
      $payment->save();
      Toastr::success('Due return added successfully.');
      return redirect()->route('admin.customer.customerDetails',$request->customer_id);
   }catch(\Exception $e){
      session()->flash('error-message',$e->getMessage());
      return redirect()->back();

   }
   
}

   //customer group details
public function customerGroupDetails(Request $request)
{
  $group=DB::table('customer_groups')->where('id',$request->id)->first();
  return view('admin.modules.setting.customer.groupDetails')->with(['group'=>$group]);
}
   //edit customer group
public function customerGroupEdit(Request $request)
{
  $group=DB::table('customer_groups')->where('id',$request->id)->first();
  return view('admin.modules.setting.customer.editGroup')->with(['group'=>$group]);
}

   //update customer group
public function customerGroupUpdate(Request $request)
{
   DB::table('customer_groups')->where('id',$request->id)->update(['name'=>$request->name,'percentage'=>$request->percentage]);
   Toastr::success('Group updated successfully');
   return 1;
}
   //delete customer group
public function deleteCustomerGroup(Request $request)
{
   DB::table('customer_groups')->where('id',$request->id)->delete();
   Toastr::success('Customer group deleted');
   return redirect()->route('admin.customerGroup');
}
//customerTotalDue
public function customerTotalDue(Request $request)
{
  $id=$request->customer_id;
  $due=DB::table('sales')->where('customer_id',$id)->sum('due');
  $startBalance=DB::table('customers')->where('id',$id)->value('start_balance');
  $totalDueReturn=DB::table('sales_due_returns')->where('customer_id',$id)->sum('paid_amount');
  $totalDue=($due+$startBalance)-$totalDueReturn;

  return $totalDue;
}
//duePayment
public function duePayment(Request $request)
{
    if($request->total_due<1){
  Toastr::error('This customer has no due');
  return redirect()->back();
 }
 
  $request->validate([
    'customer_id'=>'required|numeric',
    'amount'=>'required|numeric',
    'paid_date'=>'required',
    
  ]);
  $amount=$request->amount;
  $dues=DB::table('sales')->where('customer_id',$request->customer_id)->where('sales.due','>','sales.due_return')->get();
    foreach($dues as $due){
       $du=$due->due;
       $due_return=$due->due_return;
      if($amount<1){
         break;
      }elseif($amount<$du) {
        if($due_return<$du){
        $paid=$amount;
        // $remainDue=$du-$amount;
        $amount=$amount-$du;
        $update_due_return=$due_return+$paid;
        DB::table('sales')->where('id',$due->id)->where('customer_id',$request->customer_id)->update(['due_return'=>$update_due_return]);
      }
      }
      else{
     if($due_return<$du){
      $id=$due->id;
      $amount=$amount-$du;
      $paid=$du;
      $update_due_return=$due_return+$paid;
      // $remainDue=$du-$paid;
      DB::table('sales')->where('id',$due->id)->where('customer_id',$request->customer_id)->update(['due_return'=>$update_due_return]);
    }
      }
       
    }
//ok
 $balance=$request->total_due-$request->amount;
   $dueReturn=new SalesDueReturn;
   $dueReturn->customer_id=$request->customer_id;
   $dueReturn->paid_amount=$request->amount;
   $dueReturn->current_due=$request->total_due;
   $dueReturn->balance=$balance;
   $dueReturn->payment_method=$request->payment_method;
   $dueReturn->payment_note=$request->paymentNote;
   $dueReturn->paid_date=$request->paid_date;

   $pay=Payment::all();
   $pay=count($pay)+1;
   $paycode='PAY-'.date('Y-m-d').'/'.$pay;

   $payment=New Payment;
   $payment->reference=$paycode;
   $payment->salereference='DUE-RETURN/'.$request->customer_id;
   $payment->type='Received';
   $payment->amount=$request->amount;
   $payment->paidBy=$request->payment_method;
   $payment->pDate=$request->paid_date;
   $payment->transectionBy=Auth::user()->id;
   try{
      $dueReturn->save();
      $payment->save();
      Toastr::success('Payment added successfully.');
      return redirect()->route('admin.dashboard');
   }catch(\Exception $e){
      session()->flash('error-message',$e->getMessage());
      return redirect()->back();

   }
}
}
