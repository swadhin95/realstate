<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\property;
use App\Models\propertyTypes;
use App\Models\amenities;
use App\Models\User;

class PropertyController extends Controller
{
    public function AllProperties(){
        $properties = property::latest()->get();
        return view('backend.properties.all_properties', compact('properties'));
    }

    public function AddProperty(){
        $propertytype = propertyTypes::latest()->get();
        $amenities = amenities::latest()->get();
        $activeAgent = User::where('role','agent')->where('status','active')->latest()->get();
        return view('backend.properties.add_property',compact('propertytype','amenities','activeAgent'));
    }
}
