<?php

namespace App\Http\Controllers;

use App\CarModel;
use Illuminate\Http\Request;
use App\Car;
use App\Audit;
use Auth;

class CarController extends Controller
{
    public function Cars()
    {
        return view('cars.cars');
    }
    public function createCar(Request $request)
    {
        $this->validate($request,[
            'car_name' => 'required|unique:cars'],
            ['car_name.required'=>'You need to enter a car type',
                'car_name.unique'=>"$request->car_name already exist!"]
        );
        if($request->ajax())
        {
            //Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'A new car added '. $request->car_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return response()->json(Car::create($request->all()));
        }else{
            return response()->json(['error' => 'Something went wrong!'], 422);
        }
    }
    public function showCarInformation()
    {
        $cars = $this->CarInformation();
        return view('cars.carsInfo',compact('cars'));

    }

    public function CarInformation()
    {
        return Car::OrderBy('car_name','ASC')->paginate(10);
    }
    public function editCar(Request $request)
    {
        if($request->ajax())
        {
            return response(Car::find($request->car_id));
        }
    }

    public function updateCar(Request $request)
    {
        if($request->ajax())
        {
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Update car with name '. $request->car_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return response(Car::updateOrCreate(['car_id'=>$request->car_id],$request->all()));
        }
    }
    public function deleteCar(Request $request)
    {
        if($request->ajax())
        {
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Deleted a car', 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            Car::destroy($request->car_id);
        }
    }
    //===========Models=======================================================

    public function Models()
    {
        $cars = Car::OrderBy('car_name','ASC')->get();
        return view('models.models',compact('cars'));
    }
    public function createModel(Request $request)
    {
        $this->validate($request,[
            'car_id' => 'required',
            'model_name'=>'required|unique:models'],
            ['car_id.required'=>'Please select a car type',
                'model_name.required'=>'Please enter the model name',
                'model_name.unique'=>"$request->model_name already exist!"]
        );
        if($request->ajax())
        {
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'A new model added '. $request->model_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return response(CarModel::create($request->all()));
        }
    }
    public function showModelInformation()
    {
        $models = $this->ModelInformation();
        return view('models.modelsInfo',compact('models'));

    }

    public function ModelInformation()
    {
        return CarModel::join('cars','cars.car_id','=','models.car_id')->orderBy('car_name','ASC')->get();
    }

    public function editModel(Request $request)
    {
        if($request->ajax())
        {
            return response(CarModel::find($request->model_id));
        }
    }

    public function updateModel(Request $request)
    {
        if($request->ajax())
        {
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Updated a model with name '. $request->model_name, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return response(CarModel::updateOrCreate(['model_id'=>$request->model_id],$request->all()));
        }
    }
    public function deleteModel(Request $request)
    {
        if($request->ajax())
        {
            CarModel::destroy($request->model_id);
            Audit::create(['user' => Auth::user()->first_name." ".Auth::user()->last_name, 'activity' => 'Deleted a model', 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
        }
    }
}
