<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Ledger;
use Auth;
class MonthlyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $categories = Category::where('userid',$userid)->get();
        $ledgers = Ledger::where('userid',$userid)->get();
        $data['category'] = $categories;
        $data['ledger'] = $ledgers;

       return view('interfaces.monthly',[
            'data' => $data,
        ]);
    }
}
