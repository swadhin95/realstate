<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\propertyTypes;

class PropertyTypesController extends Controller
{
    public function AllTypes(){
        $types = propertyTypes::Latest()->get();

        return view('backend.types.all_types', compact('types'));
    }//End Method


    public function AddTypes(){

        return view('backend.types.add_types');
    }//End Method

    public function StoreTypes(Request $request){
        
        $request->validate([
            'types_name' => 'required|unique:property_types|max:200',
            'types_icon' => 'required'
        ]);

        propertyTypes::insert([
            'types_name' => $request->types_name,
            'types_icon' =>$request->types_icon,
        ]);

        $notification = array(
            'message' => "Types Stored successfully!",
            'alert-type' => 'success'
        );

        return redirect()->route('all.types')->with($notification);
    }

    public function EditTypes($id){

        $types = propertyTypes::findOrFail($id);
        return view('backend.types.edit_types', compact('types'));
    }

    public function UpdateTypes($id ,  Request $request){
        
        propertyTypes::findOrFail($id)->update([
            'types_name' => $request->types_name,
            'types_icon' =>$request->types_icon,
        ]);

        $notification = array(
            'message' => "Types Updated successfully!",
            'alert-type' => 'success'
        );

        return redirect()->route('all.types')->with($notification);
    }

    public function DeleteTypes($id){

        propertyTypes::findOrFail($id)->delete();

        $notification = array(
            'message' => "Types Deleted successfully!",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
