<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\OrmCandidate;
use App\Repositories\Eloquents\OrmCareer;
use App\Repositories\Eloquents\OrmField;
use App\Repositories\Eloquents\OrmLocation;
use App\Repositories\Eloquents\OrmPosition;
use App\Repositories\Eloquents\OrmTime;
use App\Repositories\Eloquents\OrmLanguage;
use App\Repositories\Eloquents\OrmWage;
use App\Repositories\Eloquents\OrmEducation;
use App\Repositories\Eloquents\OrmCandidatePosition;
use App\Http\Requests\CandidateRequest;
use Illuminate\Support\Facades\Storage;
use Auth;
use Session;
use App\CandidateLanguage;

class CandidateController extends Controller
{
    protected $ormCandidate;
    protected $ormCareer;
    protected $ormField;
    protected $ormLocation;
    protected $ormPosition;
    protected $ormTime;
    protected $ormLanguage;
    protected $ormWage;
    protected $ormEducation;

    public function __construct(
        OrmCandidate $ormCandidate,
        OrmCareer $ormCareer,
        OrmField $ormField,
        OrmLocation $ormLocation,
        OrmPosition $ormPosition,
        OrmTime $ormTime,
        OrmLanguage $ormLanguage,
        OrmWage $ormWage,
        OrmEducation $ormEducation
    ){
        $this->ormCandidate = $ormCandidate;
        $this->ormCareer = $ormCareer;
        $this->ormField = $ormField;
        $this->ormLocation = $ormLocation;
        $this->ormPosition = $ormPosition;
        $this->ormTime = $ormTime;
        $this->ormLanguage = $ormLanguage;
        $this->ormWage = $ormWage;
        $this->ormEducation = $ormEducation;
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
        $result =$this->ormCandidate->search_and_paginate($keyword, 2);
        $result->setPath('candidate?keyword='.$keyword);
        return view('admin.candidate.index', ['result' => $result, 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $career = $this->ormCareer->all();
        $field = $this->ormField->all();
        $location = $this->ormLocation->all();
        $position = $this->ormPosition->all();
        $time = $this->ormTime->all();
        $language = $this->ormLanguage->all();
        $wage = $this->ormWage->all();
        $education = $this->ormEducation->all();
        return view('admin.candidate.create', [
            'career' => $career,
            'field' => $field,
            'location' => $location,
            'position' => $position,
            'time' => $time,
            'language' => $language,
            'wage' => $wage,
            'education' => $education,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        if($request->image){
            $size = $request->image->getSize();
            if($size > 1572864){
                Session::flash('error', 'Ảnh không được vựt quá 1.5 Mb!!');
                return redirect()->intended(route('candidate.create'));
            }
        };
        $uniqueSlug = $this->createSlug('candidates', $request->slug);
        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'marital' => $request->marital,
            'time_id' => $request->time_id,
            'experience' => $request->experience,
            'educations_id' => $request->educations_id,
            'wages_id' => $request->wages_id,
            'skill' => $request->skill,
            'work_experience' => $request->work_experience,
            'content' => $request->content,
            'created_by' => Auth::user()->email
        ];
        if($request->image){
            $data['image'] = $request->file('image')->hashName();
            $request->image->move('storage/app/candidates/' . $uniqueSlug, $request->file('image')->hashName());
        };
        $insertId = $this->ormCandidate->insertGetId($data);
        if ($insertId) {
            $candidate = $this->ormCandidate->findWithoutRelationships($insertId);
            $career = $request->career;
            $position = $request->position;
            $location = $request->location;
            $field = $request->field;
            $language = $request->language;
            $level = $request->level;
            $languageLevel = [];
            foreach ($language as $key => $value) {
                $languageLevel[$value] = ['level' => $level[$key]];
            }
            $insertCareer = $candidate->career()->attach($career);
            $insertPosition = $candidate->position()->attach($position);
            $insertLocation = $candidate->location()->attach($location);
            $insertField = $candidate->field()->attach($field);
            $insertLanguage = $candidate->language()->attach($languageLevel);
            Session::flash('success', sprintf(config('constants.MESSAGE_CREATE_SUCCESS'), 'hồ sơ'));
            return redirect()->intended('admin/candidate');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_CREATE_ERROR'), 'hồ sơ'));
            Storage::delete('candidates/'. $uniqueSlug);
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
        if (!is_numeric($id)) {
            return redirect()->route('candidate.index');
        }
        $detail = $this->ormCandidate->find($id)->toArray();
        // echo '<pre>';
        // dd($detail);die;
        return view('admin.candidate.show', ['detail' => $detail]);
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
            return redirect()->route('candidate.index');
        }
        $detail = $this->ormCandidate->find($id)->toArray();
        
        if (!$detail) {
            return redirect()->route('candidate.index');
        }
        foreach ($detail['field'] as $key => $value) {
            $detail['field_id'][] = $value['id'];
        }
        foreach ($detail['career'] as $key => $value) {
            $detail['career_id'][] = $value['id'];
        }
        foreach ($detail['location'] as $key => $value) {
            $detail['location_id'][] = $value['id'];
        }
        foreach ($detail['position'] as $key => $value) {
            $detail['position_id'][] = $value['id'];
        }
        if ($detail['language']) {
            foreach ($detail['language'] as $key => $value) {
                $detail['language_id'][] = $value['id'];
            }
        }else{
            $detail['language_id'] = [];
        }
        $career = $this->ormCareer->all();
        $field = $this->ormField->all();
        $location = $this->ormLocation->all();
        $position = $this->ormPosition->all();
        $time = $this->ormTime->all();
        $language = $this->ormLanguage->all();
        $wage = $this->ormWage->all();
        $education = $this->ormEducation->all();
        return view('admin.candidate.edit', [
            'detail' => $detail,
            'career' => $career,
            'field' => $field,
            'location' => $location,
            'position' => $position,
            'time' => $time,
            'language' => $language,
            'wage' => $wage,
            'education' => $education,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateRequest $request, $id)
    {
        // echo 1;die;
        if($request->image){
            $size = $request->image->getSize();
            if($size > 1572864){
                Session::flash('error', 'Ảnh không được vựt quá 1.5 Mb!!');
                return redirect()->intended(route('candidate.edit', ['id' => $id]));
            }
        };

        $uniqueSlug = $this->createSlug('candidates', $request->slug, $id);
        $path = base_path() . '/' . 'storage/app/candidates';
        $detail = $this->ormCandidate->find($id)->toArray();
        if($request->slug != $detail['slug']){
            rename($path . '/' . $detail['slug'], $path . '/' . $uniqueSlug);
        }
        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'marital' => $request->marital,
            'time_id' => $request->time_id,
            'experience' => $request->experience,
            'educations_id' => $request->educations_id,
            'wages_id' => $request->wages_id,
            'skill' => $request->skill,
            'work_experience' => $request->work_experience,
            'content' => $request->content,
            'updated_by' => Auth::user()->email
        ];
        if($request->image){
            $data['image'] = $request->file('image')->hashName();
            $request->image->move('storage/app/candidates/' . $uniqueSlug, $request->file('image')->hashName());
        };
        $career = $request->career;
        $position = $request->position;
        $location = $request->location;
        $field = $request->field;
        $update = $this->ormCandidate->update($id, $data);
        if($update){
            $candidate = $this->ormCandidate->findWithoutRelationships($id);
            $career = $request->career;
            $position = $request->position;
            $location = $request->location;
            $field = $request->field;
            $language = $request->language;
            $level = $request->level;
            $languageLevel = [];
            foreach ($language as $key => $value) {
                $languageLevel[$value] = ['level' => $level[$key]];
            }
            $insertCareer = $candidate->career()->sync($career);
            $insertPosition = $candidate->position()->sync($position);
            $insertLocation = $candidate->location()->sync($location);
            $insertField = $candidate->field()->sync($field);
            $insertLanguage = $candidate->language()->sync($languageLevel);
            // foreach ($language as $key => $value) {
            //     CandidateLanguage::where('languages_id', $value)->update(['level' => $level[$key]]);
            // }
            Session::flash('success', sprintf(config('constants.MESSAGE_UPDATE_SUCCESS'), 'hồ sơ'));
            return redirect()->intended('admin/candidate');
        }else{
            Session::flash('error', sprintf(config('constants.MESSAGE_UPDATE_ERROR'), 'hồ sơ'));
            Storage::delete('candidates/'. $uniqueSlug);
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

    private function converNewArray($table, $insertId, $array = [])
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            $newArray[$key] = ['candidates_id' => $insertId, $table . '_id' => $value];
        }
        return $newArray;
    }
}
