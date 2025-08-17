<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $cars = Car::get();
        return view('index', compact('cars'));
    }

    public function about_us()
    {
        return view('about_us');
    }

    public function services()
    {
        return view('services');
    }

    public function cars()
    {
        $cars = Car::with(['brand', 'model'])->get();
        return view('car', compact('cars'));
    }


    public function pages()
    {
        return view('pages');
    }

    public function blogs()
    {
        return view('blogs');
    }

    public function contact()
    {
        return view('contact');
    }

    public function car_detail()
    {
        return view('car_detail');
    }

    public function service_details()
    {
        return view('service_details');
    }

    public function post()
    {
        return view('post');
    }

    public function car_types()
    {
        return view('car_types');
    }

    public function team_single()
    {
        return view('team_single');
    }
}
