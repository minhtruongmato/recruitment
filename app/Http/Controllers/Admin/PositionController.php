<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmPosition;
use App\Http\Requests\PositionRequest;
use Auth;
use Session;

class PositionController extends Controller
{
	protected $ormPosition;

	public function __construct(OrmPosition $ormPosition){
		$this->ormPosition = $ormPosition;
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
        $result =$this->ormPosition->search_and_paginate($keyword, 10);
        $result->setPath('position?keyword='.$keyword);
        return view('admin.position.index', ['result' => $result, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $uniqueSlug = $this->createSlug('positions', $request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'created_by' => Auth::user()->email,
        ];
        $insert = $this->ormPosition->save($data);
        if ($insert) {
            Session::flash('success', sprintf(config('constants.MESSAGE_CREATE_SUCCESS'), 'chức vụ'));
            return redirect()->intended('admin/position');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_CREATE_ERROR'), 'chức vụ'));
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
            return redirect()->route('position.index');
        }
        $result = $this->ormPosition->find($id);
        if (!$result) {
            return redirect()->route('position.index');
        }
        return view('admin.position.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        $uniqueSlug = $this->createSlug('positions', $request->slug, $id);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'updated_by' => Auth::user()->email,
        ];
        $update = $this->ormPosition->update($id, $data);
        if ($update) {
            Session::flash('success', sprintf(config('constants.MESSAGE_UPDATE_SUCCESS'), 'chức vụ'));
            return redirect()->intended('admin/position');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_UPDATE_ERROR'), 'chức vụ'));
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
        $update = $this->ormPosition->update($id, $data);
        if($update){
            return response()->json([
                'status' => 200,
                'isExist' => true,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_SUCCESS'), 'chức vụ')
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_ERROR'), 'chức vụ')
            ]);
        }
    }
}
