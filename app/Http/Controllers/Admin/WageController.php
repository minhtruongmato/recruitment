<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmWage;
use App\Http\Requests\WageRequest;
use Auth;
use Session;

class WageController extends Controller
{
    protected $ormWage;

    public function __construct(OrmWage $ormWage){
        $this->ormWage = $ormWage;
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
        $result =$this->ormWage->search_and_paginate($keyword, 10);
        $result->setPath('wage?keyword='.$keyword);
        return view('admin.wage.index', ['result' => $result, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WageRequest $request)
    {
        $uniqueSlug = $this->createSlug('wages', $request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'created_by' => Auth::user()->email,
        ];
        $insert = $this->ormWage->save($data);
        if ($insert) {
            Session::flash('success', sprintf(config('constants.MESSAGE_CREATE_SUCCESS'), 'mức lương'));
            return redirect()->intended('admin/wage');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_CREATE_ERROR'), 'mức lương'));
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
            return redirect()->route('wage.index');
        }
        $result = $this->ormWage->find($id);
        if (!$result) {
            return redirect()->route('wage.index');
        }
        return view('admin.wage.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $uniqueSlug = $this->createSlug('wages', $request->slug, $id);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'updated_by' => Auth::user()->email,
        ];
        $update = $this->ormWage->update($id, $data);
        if ($update) {
            Session::flash('success', sprintf(config('constants.MESSAGE_UPDATE_SUCCESS'), 'mức lương'));
            return redirect()->intended('admin/wage');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_UPDATE_ERROR'), 'mức lương'));
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
        $update = $this->ormWage->update($id, $data);
        if($update){
            return response()->json([
                'status' => 200,
                'isExist' => true,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_SUCCESS'), 'mức lương')
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_ERROR'), 'mức lương')
            ]);
        }
    }
}
