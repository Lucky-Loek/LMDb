<?php

namespace App\Http\Controllers;

use App\Actions\CalculateScreeningTime;
use App\Screening;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CalculateScreeningTime $calculateScreeningTime)
    {
        $runtimeInSeconds = $calculateScreeningTime->execute(Screening::select(['runtime'])->get()->toArray());
        $screenings = Screening::limit(18)->get();

        return view('home', compact('screenings', 'runtimeInSeconds'));
    }
}
