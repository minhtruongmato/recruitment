<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmField;
use App\Http\Requests\FieldRequest;
use Auth;
use Session;

class FieldController extends Controller
{
    protected $ormField;

    public function __construct(OrmField $ormField){
        $this->ormField = $ormField;
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
        $result =$this->ormField->search_and_paginate($keyword, 10);
        $result->setPath('field?keyword='.$keyword);
        return view('admin.field.index', ['result' => $result, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.field.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldRequest $request)
    {
        $uniqueSlug = $this->createSlug('fields', $request->slug);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'created_by' => Auth::user()->email,
        ];
        $insert = $this->ormField->save($data);
        if ($insert) {
            Session::flash('success', sprintf(config('constants.MESSAGE_CREATE_SUCCESS'), 'lĩnh vực'));
            return redirect()->intended('admin/field');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_CREATE_ERROR'), 'lĩnh vực'));
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
            return redirect()->route('field.index');
        }
        $result = $this->ormField->find($id);
        if (!$result) {
            return redirect()->route('field.index');
        }
        return view('admin.field.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FieldRequest $request, $id)
    {
        $uniqueSlug = $this->createSlug('fields', $request->slug, $id);
        $data = [
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'updated_by' => Auth::user()->email,
        ];
        $update = $this->ormField->update($id, $data);
        if ($update) {
            Session::flash('success', sprintf(config('constants.MESSAGE_UPDATE_SUCCESS'), 'lĩnh vực'));
            return redirect()->intended('admin/field');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_UPDATE_ERROR'), 'lĩnh vực'));
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
        $update = $this->ormField->update($id, $data);
        if($update){
            return response()->json([
                'status' => 200,
                'isExist' => true,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_SUCCESS'), 'lĩnh vực')
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'isExist' => false,
                'message' => sprintf(config('constants.MESSAGE_REMOVE_ERROR'), 'lĩnh vực')
            ]);
        }
    }
}
