<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('index', compact('products'));
    }

    public function create()
    {

        return view('adminview.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request);
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/images/product/', $filename);
            $product->image = $filename;
        }
        $product->save();

        return redirect()->route('productList')->with('success', 'Product Listed Successfully');
    }

    public function special(Request $request)
    {

        $id = $request->product_id;

        if (Auth::user()->role_id == User::ROLE_ADMIN) {
            $product = Product::where('id', $id)->first();

            $product->special_price = $request->special_price;
            $product->update();

            return response()->json([
                // 'status'
                'message'=> 'Product Special Price Set']);
        } else {
            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Product::get();
        return view('adminview.product_list', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        if (Auth::user()->role_id == User::ROLE_ADMIN) {
            $product = Product::where('id', $id)->first();
            return view('adminview.edit', compact('product'));
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, $id)
    {
        // dd('hi');

        if (Auth::user()->role_id == User::ROLE_ADMIN) {
            $product = Product::where('id', $id)->first();
            $path = 'public/images/product/' . $product->image;


            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;

            if ($request->hasFile('image')) {
                $path = 'public/images/product/' . $product->image;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('public/images/product/', $filename);
                $product->image = $filename;
            }

            $product->save();
            return redirect()->route('productList')->with('success', 'Product Updated Successfully');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == User::ROLE_ADMIN) {
            $product = Product::where('id', $id)->first();
            if ($product) {
                $path = 'public/images/product/' . $product->image;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $product->delete();
                return redirect()->back()
                    ->with('success', 'Product List Deleted successfully.');
            }
        }
    }
}
