<?php

namespace App\Http\Controllers;

use App\CarOwnerDetail;
use Illuminate\Http\Request;
use App\CarOwner;
use App\Payment;
use Mail;
use Auth;
use App\Audit;

class PaymentController extends Controller
{
    public function Payment()
    {
        $owners = CarOwner::all();
        return view('payments.payment',compact('owners'));
    }
    public function template()
    {
        return view('payments.payment-text');
    }
    public function Payments(){
        $payments = Payment::join('carowners','carowners.owner_id','=','payments.owner_id')
                            ->OrderBy('payment_date','DESC')->paginate(10);
        return view('payments.viewPayments',compact('payments'));
    }
    public function owner_status($onwer_id)
    {
        return  CarOwner::where('owner_id',$onwer_id);
    }
    public function owner_details($owner_id)
    {
        return CarOwnerDetail::join('models','models.model_id','=','ownercardetails.model_id')
                              ->join('cars','cars.car_id','=','models.car_id')
                               ->where('owner_id',$owner_id);

    }
    public function searchOwner($viewName, $owner_id)
    {

        $carowners = CarOwner::all();
        $ownerdetails = $this->owner_details($owner_id)->paginate(10);
        $owners = $this->owner_status($owner_id)->first();
        return view($viewName,compact('carowners','ownerdetails',
            'owners'))->with('owner_id',$owner_id);
    }
    public function result(Request $request)
    {
        try{
            $owner_id = $request->owner_id;
            if($owner_id)
                return $this->searchOwner('payments.makePayment',$owner_id);

        }catch (\QueryException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with(['error'=>"The Code Selected cannot be found!"]);
        }

    }
    public function owners($email)
    {
        return CarOwner::where('email',$email);

    }
    public function paymentsList(){
        return Payment::orderBy('payment_id', 'desc')->take(1)->get();
    }
    public function getOwner($email){
        return CarOwner::where('email',$email);
    }
    public function postPayment(Request $request){
        $this->validate($request,[
            'month'=>'required',
            'year'=>'required',
             'amount'=>'required'],
            ['month.required'=>'Please select Month',
                'year.required'=>'Please select Year',
                'amount.required'=>'Please input an amount']);
        try{
        $pay = new Payment();
        $pay->month = $request->month;
        $pay->year = $request->year;
        $pay->payment_date = date('Y-m-d');
        $pay->reg_amount = $request->reg_amount;
        $pay->fuel_amount = $request->fuel_amount;
        $pay->repairs_amount = $request->repairs_amount;
        $pay->amount = $request->amount;
        $totalexpense = $request->reg_amount + $request->fuel_amount + $request->repairs_amount;
        $pay->total_expense = $totalexpense;
        $pay->total_amount = $request->amount - $totalexpense;
        $pay->owner_id = $request->owner_id;
        $pay->user_id = $request->user_id;
         //dd($pay);
       $pay->save();
          return redirect('/payment')->with(['success' => 'Payment made successfully']);

//        }catch(\Swift_TransportException $e){
//            \Log::error($e->getMessage());
//            return redirect('/payment')->with(['error' => "Payment receipt not sent. Check if you have internet"]);
//        }

    }
//$owner = $this->getOwner($request->email)->first();
//    //dd($owner->email);
//$payment = $this->paymentsList();
//$this->sendEmail($owner, $payment);
    private function sendEmail($owner,$payment)
    {
        Mail::send('payments.payment-text',[
            'owner'=>$owner,
            'payment'=>$payment
        ],function($message) use ($owner,$payment){
            $message->to($owner->email);
            $message->from('enshika.enshika@gmail.com','Enshika Receipt');
           $message->subject("Hello $owner->first_name, your {$payment[0]->month} {$payment[0]->year}, Payment.");
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Payment sent to '.$owner->first_name." ".$owner->last_name, 'act_date' => date('Y-m-d'), 'act_time' => date('H:i:s')]);
          //  $message->subject("Hello $owner->first_name, your taxi charges receipt");
        });
    }

}
