<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AreaController extends Controller
{
    public function add(Request $request){

        $add=new Area;

        $add->areaName=$request->input('areaName');
        $add->collectorId=$request->input('collectorId');

        $add->save();
        return redirect('areacrud');
    }


    public function read(){
        $read=Area::all();
        return view('areacrud', ['read' => $read]);
    }


    public function delete($id) {
        DB::table('areas')->where('id','=',$id)->delete();
        return redirect('areacrud');
    }




    public function update($id){
        $read=Area::all()->where('id',$id);
        return view('update_area', ['read' => $read]);
    }


    public function update_data_area(Request $request){
        DB::table('areas')->where('id','=',$request->input('id'))
            ->update(['areaName'=>$request->input('areaName')]);

        DB::table('areas')->where('id','=',$request->input('id'))
            ->update(['collectorId'=>$request->input('collectorId')]);

        $read=Area::all();
        return view('areacrud', ['read' => $read]);


    }





}
