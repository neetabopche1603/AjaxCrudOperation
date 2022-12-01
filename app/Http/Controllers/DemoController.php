<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DemoController extends Controller
{
    public function index(){
        $demo = Demo::get();
        return view('demo',compact('demo'));
    }

    public function store(Request $request){
        $demos = new Demo();
        $demos->name = $request->name;
        $demos->email = $request->email;
        $demos->password = Hash::make($request->password);
        $demos->save();
        return redirect()->back()->with('status','Data Add Successfully Done.....');
    }

    public function edit($id){
        $editDemo = Demo::find($id);
        return response()->json([
            'status' => 200,
            'demo' => $editDemo
        ]);
    }
}
