<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ClientProductPrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Product view is dynamic for all roles i-e Admin/Clients for now.
        //clients will get to see their special prices against products on which Admin assigned him/her any price, else he/se will see base price
        return view('product.index', ['products' => Product::with(['specialPrice','photo'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|between:0,99.99',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $imageName = time().'.'.$request->image->extension();
        //There is a MyProducts/images directory in public folder where images will be saved.
        //As this was a small module so I keep it in our directory
        $image = $request->image->move(public_path('MyProducts/images'), $imageName);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        //I have created to polymorphic relation for photos so that users and products images could be saved in 1 table
        Photo::create([
            'filename' => $imageName,
            'imageable_id' => $product->id,
            'imageable_type' => 'App\Models\Product'
        ]);
        DB::commit();
        return back()
            ->with('success','Product Created Successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return back()
            ->with('error', $e->getMessage());
        }
    }

    public function getProducts(User $user){
        //Getting product list for specific client to admin so assign special prices for clients.
        //And to check if this particular client have special prices assigned on any product
        //And admin can update an already assigned special price on any product from this list as well
        $products = Product::with(['photo','ifSpecialPrice' => function ($query)  use ($user){
            $query->where('client_id', $user->id);
        }])->get();
        return view('product.set-price-for-clients', ['client' => $user, 'products' => $products]);
    }

    public function setPriceForClient(Request $request){
        //I have used DB Transactions and try catches.
        //In case of any issues our insertion will rollback and no false entry would be created
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'client_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'special_price' => 'required|numeric|gt:0',
            ]);
            if($validator->fails()){
                return response()->json(array(
                    'status' => 0,
                    'message' => $validator->getMessageBag()->toArray()
                ), 400);
            }
            //Validatin if spcial price is been assigning to client or some other role?
            //As special price could only be assigned to clients
            //This check is just because if someone can alter client id from frontend so that it must be validated here
            //If special price is assigning first time it will be created and if price was already assigned and a new special price is assigning, it will be updated
            if($this->checkUser($request->client_id)){
                ClientProductPrice::updateOrCreate([
                    'client_id' => $request->client_id,
                    'product_id' => $request->product_id],
                    ['price' => $request->special_price]);
            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Special Prices can be assigned to clients only'
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'Special Price assigned'
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage(),
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    //Just a private function to validate if client??
    private function checkUser($userId){
        return User::find($userId)->isClient() ? true : false;
    }
}
