<?php

namespace App\Http\Controllers;
use App\CarOwner;
use App\Car;
use App\CarModel;
use App\Audit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $total_owners = CarOwner::all()->count();
        $total_models = CarModel::all()->count();
        $total_cars = Car::all()->count();
        $audit = Audit::where('act_date',date('Y-m-d'))->get();
        return view('dashboard',compact('total_owners','total_cars','total_models','audit'));
    }
}
