<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use App\CarOwner;
use App\CarOwnerDetail;
use App\CarModel;
use Storage;
use File;
use Auth;
use App\Audit;

class OwnerController extends Controller
{
    public function Owner()
    {
        return view('owners.addOwner');
    }

    public function OwnersList()
    {
        $owners = CarOwner::all();
        return view('owners.listOwner',compact('owners'));
    }

    public function PostOwner(Request $request)
    {
        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png,bmp',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:carowners',
            'telephone' =>'required|unique:carowners'],
        ['first_name.required'=>'Please input First Name',
            'last_name.required'=>'Please input Last Name',
            'email.required'=>'Please input a valid email address',
            'email.unique'=>"$request->email already exist!",
            'telephone.required'=>'Please input a telephone number',
            'telephone.unique'=>"$request->telephone already exist!"]);

        $file = $request->image;
        if($request->file('image')){
            $file = $file->openFile()->fread($file->getSize());
        }
        $ow = new CarOwner();
        $first = $request->first_name;
        $last = $request->last_name;
        $firstX = $first[0];
        $lastX = $last[0];
        $ow->first_name = $request->first_name;
        $ow->last_name = $request->last_name;
        $ow->email = $request->email;
        $ow->address = $request->address;
        $ow->telephone = $request->telephone;
        $ow->bank = strtoupper($request->bank);
        $ow->account_number = $request->account_number;
        $ow->branch = strtoupper($request->branch);
        $ow->code = strtoupper('ENHCO-' .$firstX.$lastX).date('y');
        $ow->image =$file;

        //FileUpload::photo($request,'photo');
        // $st->photo=$filename;

        //dd($request->all());

        if ($ow->save()) {
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'A new owner added '. $request->first_name." ".$request->last_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return back()->with(['success' => "Car Owner Created Successfully"]);
        } else {
            return back()->with(['error' => 'Something went wrong']);
        }
    }
    public function editCarOwner($id)
    {
       $carowner = CarOwner::find($id);

       return view('Owners.editOwner',compact('carowner'));
    }
    public function viewCarOwner($id)
    {
        $carowner = CarOwner::find($id);

        return view('Owners.viewOwner',compact('carowner'));
    }
    public function updateCarOwner(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'image|mimes:jpg,jpeg,png,bmp',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:carowners,email,'.$id.',owner_id',
            'telephone' =>'required|unique:carowners,telephone,'.$id.',owner_id'
        ],
            ['first_name.required'=>'Please input First Name',
                'last_name.required'=>'Please input Last Name',
                'email.required'=>'Please input a valid email address',
                'email.unique'=>"$request->email already exist!",
                'telephone.required'=>'Please input a telephone number',
                'telephone.unique'=>"$request->telephone already exist!"]);

        $file = $request->image;
        if($request->file('image')){
            $file = $file->openFile()->fread($file->getSize());
        }
        $ow = CarOwner::find($id);
        $ow->first_name = $request->first_name;
        $ow->last_name = $request->last_name;
        $ow->email = $request->email;
        $ow->address = $request->address;
        $ow->telephone = $request->telephone;
        $ow->bank = strtoupper($request->bank);
        $ow->account_number = $request->account_number;
        $ow->branch = strtoupper($request->branch);
        $ow->image =$request->has('image') ? $file : $ow->image;
        $ow->save();
        Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Updated car owner '. $request->first_name." ".$request->last_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
        return redirect('/car-owners')->with('success', "Car owner has been updated successfully");
    }
    //===================================================================================================

    public function OwnerDetail()
    {
        $carowners = CarOwner::all();
        $cars = Car::all();
        return view('ownerDetails.addOwnerDetail',compact('carowners','cars'));
    }

    public function OwnersDetailList()
    {
        $ownersdetails = CarOwnerDetail::join('carowners','carowners.owner_id','=','ownercardetails.owner_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->orderBy('carowners.first_name','ASC')->get();
        return view('ownerDetails.ownerDetailsInfo',compact('ownersdetails'));
    }
    public function showModel(Request $request)
    {
        if($request->ajax())
        {
            return response(CarModel::where('car_id',$request->car_id)->get());
        }
    }

    public function PostOwnerDetail(Request $request)
    {
        $this->validate($request,[
            'car_image' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500|required',
             'owner_id'=>'required',
            'model_id'=>'required',
            'car_number'=>'required|unique:ownercardetails',
            'car_color'=>'required',
            'start_date'=>'required'],
            ['car_image.required'=>'Please upload a valid image for the car',
                'owner_id.required'=>'Select a valid owner',
                'model_id.required'=>'Please select the car model',
                'car_number.required'=>'Please input the car number',
                'car_number.unique'=>"$request->car_number already exist!",
                'car_color.required'=>'Please input the car color',
                'start_date.required'=>'Please select commencement date']
        );

        $file = $request->car_image;
        if($request->file('car_image')){
            $file = $file->openFile()->fread($file->getSize());
        }
        $ow = new CarOwnerDetail();
        $ow->owner_id = $request->owner_id;
        $ow->model_id = $request->model_id;
        $ow->car_number = $request->car_number;
        $ow->car_color = $request->car_color;
        $ow->car_image =$file;
        $ow->start_date = $request->start_date;

        //FileUpload::photo($request,'photo');
        // $st->photo=$filename;

        //dd($request->all());

        if ($ow->save()) {
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Car owner details added with car number '.$request->car_number, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return back()->with(['success' => "Car Owner Details Created Successfully"]);
        } else {
            return back()->with(['error' => 'Something went wrong']);
        }
    }
    public function editCarOwnerDetail($id)
    {
        $carowners = CarOwner::all();
        $cars = Car::all();
        $models = CarModel::all();
        $owner = CarOwnerDetail::join('carowners','carowners.owner_id','=','ownercardetails.owner_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->orderBy('carowners.first_name','ASC')->find($id);

        return view('ownerDetails.editCarDetail', compact('owner','carowners','cars','models'));
    }
    public function viewCarOwnerDetail($id)
    {
        $carowners = CarOwner::all();
        $cars = Car::all();
        $models = CarModel::all();
        $owner = CarOwnerDetail::join('carowners','carowners.owner_id','=','ownercardetails.owner_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->orderBy('carowners.first_name','ASC')->find($id);

        return view('ownerDetails.viewOwnerDetail', compact('owner','carowners','cars','models'));
    }

    public function updateCarOwnerDetail(Request $request, $id)
    {
        $ow = CarOwnerDetail::find($id);
            $this->validate($request,[
                'car_image' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500',
                'owner_id'=>'required',
                'model_id'=>'required',
                'car_number'=>'required|unique:ownercardetails,car_number,'.$id.',detail_id',
                'car_color'=>'required',
                'start_date'=>'required'],
                ['owner_id.required'=>'Select a valid owner',
                    'model_id.required'=>'Please select the car model',
                    'car_number.required'=>'Please input the car number',
                    'car_number.unique'=>"Car number $request->car_number already exist!",
                    'car_color.required'=>'Please input the car color',
                    'start_date.required'=>'Please select commencement date']
            );

            $file = $request->car_image;
            if($request->file('car_image')){
                $file = $file->openFile()->fread($file->getSize());
            }

            $ow->owner_id = $request->owner_id;
            $ow->model_id = $request->model_id;
            $ow->car_number = $request->car_number;
            $ow->car_color = $request->car_color;
            $ow->car_image = $request->has('car_image') ? $file : $ow->car_image;
            $ow->start_date = $request->start_date;

            //dd($request->all());
            $ow->save();
        Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Updated Car owner details with car number '.$request->car_number, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
        return redirect('/car-owners-details')->with('success', "Car owner details has been updated successfully");
    }
}
