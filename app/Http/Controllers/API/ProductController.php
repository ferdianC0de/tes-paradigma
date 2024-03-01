<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('getCategory')->get();
        $count = $data->count();
        $response = [
            'data' => $data,
            'count' => $count
        ];
        return $this->sendResponse($response, $count.' Data Found');

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
        $request->validate([
            'name' => 'required|string:50',
            'text' => 'string',
            'price' => 'required|integer',
            'stocks' => 'required|integer',
            'category_id' => 'required|string'

        ]);

        $product = Product::create($request->toArray());

        return $this->sendResponse($product, 'Data product Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        try {
            //code...
            if (!$product) {
                return $this->sendResponse($product, 'Data Not Found');
            }
            return $this->sendResponse($product, 'Data Found');
        } catch (\Exception $e) {
            return $this->sendError("Error", " ".$e, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'=> 'required',
            'name' => 'required|string:50',
            'descriptions' => 'string',
            'price' => 'required|integer',
            'stocks' => 'required|integer',
            'category_id' => 'required|string'

        ]);
        $product = Product::find($request->id);
        if (!$product->update($request->toArray())) {
            return $this->sendError($product, null, 500);
        }

        return $this->sendResponse($product, 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);
        $data = Product::find($request->only(['id']))->first();
        if (!$data) {
            return $this->sendError('Data Not Found', $data, 404);
        }
        $data->delete();
        return $this->sendResponse($data, 'Data Deleted');

    }
}
