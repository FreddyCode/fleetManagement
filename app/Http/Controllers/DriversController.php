<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\CarOwnerDetail;
use App\Driver;
use App\Audit;
use Auth;


class DriversController extends Controller
{
    public function addDriver()
    {
        $ownersdetails = CarOwnerDetail::join('carowners','carowners.owner_id','=','ownercardetails.owner_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->get();
        return view('drivers.addDriver',compact('ownersdetails'));
    }

    public function driversInfo()
    {
        $drivers = Driver::join('ownercardetails','ownercardetails.detail_id','=','drivers.detail_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->paginate(10);
        return view('drivers.driversinfo',compact('drivers'));
    }

    public function postDriver(Request $request)
    {
        try {
            $this->validate($request,[
                'image' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500',
                'insurance' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500|required',
                'license' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500|required',
                'identity' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500|required',
                'first_name'=>'required',
                'last_name'=>'required',
                'telephone'=>'required|unique:drivers',
                'email'=>'unique:drivers'
            ]);

            $profile = $request->image;
            if($request->file('image')){
                $profile = $profile->openFile()->fread($profile->getSize());
            }
            //=================================================
            $insurance = $request->insurance;
            if($request->file('insurance')){
                $insurance = $insurance->openFile()->fread($insurance->getSize());
            }
            //====================================================
            $license = $request->license;
            if($request->file('license')){
                $license = $license->openFile()->fread($license->getSize());
            }
            //=====================================================
            $identity = $request->identity;
            if($request->file('identity')){
                $identity = $identity->openFile()->fread($identity->getSize());
            }
            $driver = new Driver();
        $driver->first_name = $request->first_name;
        $driver->last_name = $request->last_name;
        $driver->email = $request->email;
        $driver->telephone = $request->telephone;
        $driver->detail_id = $request->detail_id;
        $driver->image = $profile;
        $driver->insurance = $insurance;
        $driver->license = $license;
        $driver->identity = $identity;
        if($driver->save()){
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'added a new driver with name ' . $request->first_name." ".$request->last_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return back()->with(['success' => "Driver with details Created Successfully"]);
        }
        }catch (QueryException $e)
        {
            Log::error($e->getMessage());
            return redirect()->back()->with(['error'=>"Something went wrong. Check your details carefully"]);
        }
    }

    public function editDriver($id)
    {
        $driver = Driver::find($id);
        $ownersdetails = CarOwnerDetail::join('carowners','carowners.owner_id','=','ownercardetails.owner_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->get();
        return view('drivers.editDriver', compact('driver','ownersdetails'));
    }
    public function viewDriver($id)
    {
        $driver = Driver::find($id);
        $ownersdetails = CarOwnerDetail::join('carowners','carowners.owner_id','=','ownercardetails.owner_id')
            ->join('models','models.model_id','=','ownercardetails.model_id')
            ->join('cars','cars.car_id','=','models.car_id')->get();
        return view('drivers.viewDriver', compact('driver','ownersdetails'));
    }
    public function updateDriver(Request $request, $id)
    {
            $this->validate($request,[
                'image' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500',
                'insurance' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500',
                'license' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500',
                'identity' => 'image|mimes:jpg,jpeg,png,bmp|dimensions:min_width=100,max_width=1500',
                'first_name'=>'required',
                'last_name'=>'required',
                'telephone'=>'required|unique:drivers,telephone,'. $id,
                'email'=>'unique:drivers,email,'. $id
            ]);
           $driver = Driver::find($id);

            $profile = $request->image;
            if($request->file('image')){
                $profile = $profile->openFile()->fread($profile->getSize());
            }
            //=================================================
            $insurance = $request->insurance;
            if($request->file('insurance')){
                $insurance = $insurance->openFile()->fread($insurance->getSize());
            }

            //====================================================
            $license = $request->license;
            if($request->file('license')){
                $license = $license->openFile()->fread($license->getSize());
            }
            //=====================================================
            $identity = $request->identity;
            if($request->file('identity')){
                $identity = $identity->openFile()->fread($identity->getSize());
            }

            $driver->first_name = $request->first_name;
            $driver->last_name = $request->last_name;
            $driver->email = $request->email;
            $driver->telephone = $request->telephone;
            $driver->detail_id = $request->detail_id;
            $driver->image = $request->has('image') ? $profile : $driver->image;
            $driver->insurance =  $request->has('insurance') ? $insurance : $driver->insurance;
            $driver->license = $request->has('license') ? $license : $driver->license;
            $driver->identity = $request->has('identity') ? $identity : $driver->identity;
            $driver->save();
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Updated driver with name ' . $request->first_name." ".$request->last_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return redirect('/drivers-list')->with('success', "Driver $request->first_name has been updated successfully");
    }

}
