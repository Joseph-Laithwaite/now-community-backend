<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;

class BrandController extends Controller
{
    
    public function index(){
    	return Brand::with('independent')->get();
    }

    public function show(string $brand_slug){
        return Brand::where('name',$brand_slug)->get();
    }
}
