<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
       return $products;
    }

    /**
     * Display a listing of the requested type of products
     * @param $type type of product  
     * @return \Illuminate\Http\Response
     */
    public function indexByType($type)
    {  
        return Product::orderBy('created_at','DESC')->where('type',$type)->get();
    }

    

    /**
     * Display a listing of the products added by a particular vendor with provided id.
      * @param  int  $id vendor id
     * @return \Illuminate\Http\Response
     */
    public function vendorproducts($uid)
    {
        $products = Product::orderBy('created_at','DESC')->where('user_id',$uid)->get();
       return $products; //"Products Controller reached with id: ".$uid;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return "Product Store Controller Called!";
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'mainname' => ['required', 'string', 'max:255'],
            'price' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            'pageslength' => ['required','integer'],
        ]);
        //return "Validation Product successfully  with title ".$request['title'];
        Product::create([
            'title' => $request['title'],
            'firstname' => $request['firstname'],
            'mainname' => $request['mainname'],
            'type' => $request['type'],
            'user_id' => $request['user_id'],
            'price' => $request['price'],
            'pageslength' => $request['pageslength'],
        ]); 
         return "New Product successfully Added with title ".$request['title'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id product id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id product id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  //Product $product)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//Product $product)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],// 'unique:users'],
           // 'role' => ['required', 'tinyint'],    //already gets validated result from option
           // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $product->title = $request['title'];
        $product->firstname = $request['firstname'];
        $product->save();
           // $user->passwor
        return "Product Updated with title: ".$request['title'];
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return "Successfully deleted Product with id".$id;
    }
}
