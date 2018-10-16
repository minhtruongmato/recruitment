<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmTime;
use App\Http\Requests\TimeRequest;
use Auth;
use Session;

class TimeController extends Controller
{
    protected $ormTime;

    public function __construct(OrmTime $ormTime){
        $this->ormTime = $ormTime;
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
        $result =$this->ormTime->search_and_paginate($keyword, 10);
        $result->setPath('time?keyword='.$keyword);
        return view('admin.time.index', ['result' => $result, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeRequest $request)
    {
        $uniqueSlug = $this->createSlug('time', $request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'created_by' => Auth::user()->email,
        ];
        $insert = $this->ormTime->save($data);
        if ($insert) {
            Session::flash('success', sprintf(config('constants.MESSAGE_CREATE_SUCCESS'), 'giờ làm'));
            return redirect()->intended('admin/time');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_CREATE_ERROR'), 'giờ làm'));
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
            return redirect()->route('time.index');
        }
        $result = $this->ormTime->find($id);
        if (!$result) {
            return redirect()->route('time.index');
        }
        return view('admin.time.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TimeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimeRequest $request, $id)
    {
        $uniqueSlug = $this->createSlug('time', $request->slug, $id);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'updated_by' => Auth::user()->email,
        ];
        $update = $this->ormTime->update($id, $data);
        if ($update) {
            Session::flash('success', sprintf(config('constants.MESSAGE_UPDATE_SUCCESS'), 'giờ làm'));
            return redirect()->intended('admin/time');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_UPDATE_ERROR'), 'giờ làm'));
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
        $update = $this->ormTime->update($id, $data);
        if($update){
            return response()->json([
                'status' => 200,
                'isExist' => true,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_SUCCESS'), 'giờ làm')
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_ERROR'), 'giờ làm')
            ]);
        }
    }
}
