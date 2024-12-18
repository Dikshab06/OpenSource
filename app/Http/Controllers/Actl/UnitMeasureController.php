<?php

namespace App\Http\Controllers\Actl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitMeasure;

use Auth;
use Illuminate\Support\Carbon;

class UnitMeasureController extends Controller
{
    public function UnitMeasureAll(){
        $unitMeasures = UnitMeasure::latest()->get();
        return view('backend.unitMeasure.unitMeasure_all', compact('unitMeasures'));
    }

    public function UnitMeasureAdd(){
        return view('backend.unitMeasure.unitMeasure_add');
    }

    public function UnitMeasureStore(Request $request){
        UnitMeasure::insert([
            'unit' => $request->unit,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Unit Measure Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unitMeasure.all')->with($notification);
    }

    public function UnitMeasureEdit($id){
        $unitMeasure = UnitMeasure::findOrFail($id);
        return view('backend.unitMeasure.unitMeasure_edit', compact('unitMeasure'));
    }

    public function UnitMeasureUpdate(Request $request){
            
            $unitMeasure_id = $request->id;
    
            UnitMeasure::findOrFail($unitMeasure_id)->update([
                'unit' => $request->unit,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
    
            $notification = array(
                'message' => 'Unit Measure Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('unitMeasure.all')->with($notification);
    }

    public function UnitMeasureDelete($id){
        UnitMeasure::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Unit Measure Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

