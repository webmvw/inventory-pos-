<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Auth;

class UnitController extends Controller
{
    public function view(){
    	$allUnits = Unit::latest()->get();
    	return view('admin.pages.unit.view-unit', compact('allUnits'));
    }

    public function add(){
    	return view('admin.pages.unit.add-unit');
    }

    public function store(Request $request){
    	$unit = new Unit;
    	$unit->name = $request->name;
    	$unit->created_by = Auth::user()->id;
    	$unit->save();
    	return redirect()->route('units.view')->with("success", "Unit Added Successfully!!");
    }


    public function edit($id){
    	$getUnit = Unit::find($id);
    	return view('admin.pages.unit.edit-unit', compact('getUnit'));
    }

    public function update(Request $request, $id){
    	$getUnit = Unit::find($id);
    	$getUnit->name = $request->name;
    	$getUnit->updated_by = Auth::user()->id;
    	$getUnit->save();
    	return redirect()->route('units.view')->with("info", "Unit updated Successfully!!");
    }

    public function delete($id){
    	$getUnit = Unit::find($id);
    	$getUnit->delete();
    	return redirect()->route('units.view')->with("info", "Unit deleted Successfully!!");
    }
}
