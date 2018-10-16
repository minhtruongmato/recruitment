<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmLocation;
use App\Http\Requests\LocationRequest;
use Auth;
use Session;

class LocationController extends Controller
{
    protected $ormLocation;

    public function __construct(OrmLocation $ormLocation){
        $this->ormLocation = $ormLocation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = '';
        $keyword = $request->keyword;
        $result =$this->ormLocation->search_and_paginate($keyword, 10);
        $result->setPath('location?keyword='.$keyword);
        return view('admin.location.index', ['result' => $result, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $uniqueSlug = $this->createSlug('locations', $request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'created_by' => Auth::user()->email,
        ];
        $insert = $this->ormLocation->save($data);
        if ($insert) {
            Session::flash('success', sprintf(config('constants.MESSAGE_CREATE_SUCCESS'), 'nơi làm việc'));
            return redirect()->intended('admin/location');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_CREATE_ERROR'), 'nơi làm việc'));
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            return redirect()->route('location.index');
        }
        $result = $this->ormLocation->find($id);
        if (!$result) {
            return redirect()->route('location.index');
        }
        return view('admin.location.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        $uniqueSlug = $this->createSlug('locations', $request->slug, $id);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'updated_by' => Auth::user()->email,
        ];
        $update = $this->ormLocation->update($id, $data);
        if ($update) {
            Session::flash('success', sprintf(config('constants.MESSAGE_UPDATE_SUCCESS'), 'nơi làm việc'));
            return redirect()->intended('admin/location');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_UPDATE_ERROR'), 'nơi làm việc'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function remove($id)
    {
        $data = [
            'is_deleted' => 1,
            'updated_by' => Auth::user()->email,
        ];
        $update = $this->ormLocation->update($id, $data);
        if($update){
            return response()->json([
                'status' => 200,
                'isExist' => true,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_SUCCESS'), 'nơi làm việc')
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_ERROR'), 'nơi làm việc')
            ]);
        }
    }
}
