<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\FundCategory;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index() {
        $query = Fund::query();

        if(request()->has('search')){
            $search = request()->input('search');
            $query->where('name','like',"$search%")->orWhere('ISIN','like',"%$search%")->orWhere('WKN','like',"%$search%");
            $funds=$query->paginate(10);
            $fundCategory = FundCategory::all();
        }
        else{
            $funds = Fund::all();
            $funds = Fund::paginate(10);
            $fundCategory = FundCategory::all();
        }
        return view('welcome', compact('funds','fundCategory'));
    }
}
