<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::get();
        return view('welcome', compact('products'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        // $validator = Validator::make( $request->all(), [

        //     'product'=> 'required',
        //     'description'=>'required',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json([
        //         'status'=>400,
        //         'message'=>'Product Not Successfully.',
        //         'errors'=>$validator->messages()
        //     ]);
        // }
        // else
        // {
        //     $student = new Product();
        //     $student->product_name = $request->input('product');
        //     $student->desc = $request->input('description');
        //     $student->save();
        //     return response()->json([
        //         'status'=>200,
        //         'message'=>'Product Added Successfully.'
        //     ]);
        // }

        $student = new Product();
        $student->product_name = $request->input('product');
        $student->desc = $request->input('description');
        $student->save();
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'Product Added Successfully.'
        // ]);
        return redirect()->back()->with('status', "Product add Successfully");
    }

    public function edit($id)
    {
        $products = Product::find($id);
        return response()->json([
            'status' => 200,
            'product' => $products
        ]);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->product_name = $request->name;
        $product->desc = $request->desc;
        $success = $product->update();
        if ($success) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'faild']);
        }
    }

    public function deleteProduct(Request $request)
    {
        Product::find($request->id)->delete();
        return response()->json(['status' => 'success']);
    }
}
