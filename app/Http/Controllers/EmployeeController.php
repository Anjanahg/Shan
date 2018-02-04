<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\collector;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EmployeeController extends Controller
{

   public function add(Request $request){

        $add=new collector;

        $add->fullname=$request->input('fullname');
        $add->collectorname=$request->input('collectorname');
        $add->telephone=$request->input('telephone');
        $add->areaId=$request->input('areaId');
       $add->password=$request->input('password');
        $add->save();
        return redirect('empcrud');
    }



    public function read(){
        $read=collector::all();
        return view('empcrud', ['read' => $read]);
    }


   public function delete($id) {
        DB::table('collectors')->where('id','=',$id)->delete();
        return redirect('empcrud');
    }




        public function update($id){
            $read=collector::all()->where('id',$id);
            return view('update', ['read' => $read]);
        }


        public function update_data(Request $request){
            DB::table('collectors')->where('id','=',$request->input('id'))
                ->update(['fullname'=>$request->input('fullname')]);

            DB::table('collectors')->where('id','=',$request->input('id'))
                ->update(['collectorname'=>$request->input('collectorname')]);

            DB::table('collectors')->where('id','=',$request->input('id'))
                ->update(['telephone'=>$request->input('telephone')]);


            DB::table('collectors')->where('id','=',$request->input('id'))
                ->update(['areaId'=>$request->input('areaId')]);


            DB::table('collectors')->where('id','=',$request->input('id'))
                ->update(['password'=>$request->input('password')]);

            $read=collector::all();
            return view('empcrud', ['read' => $read]);


        }

}
