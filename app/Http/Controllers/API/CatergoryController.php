<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CatergoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
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
            'name' => 'required|string:50'
        ]);

        $category = Category::create($request->only(['name']));

        return $this->sendResponse($category, 'Data Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        try {
            //code...
            if (!$category) {
                return $this->sendResponse($category, 'Data Not Found');
            }
            return $this->sendResponse($category, 'Data Found');
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
            'name' => 'required|string:50'
        ]);
        $category = Category::find($request->id);
        if (!$category->update($request->toArray())) {
            return $this->sendError($category, null, 500);
        }

        return $this->sendResponse($category, 'Data Updated');
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
        $data = Category::find($request->only(['id']));
        if (!$data) {
            return $this->sendError('Data Not Found', $data, 404);
        }
        $data->delete();
        return $this->sendResponse($data, 'Data Deleted');
    }
}
