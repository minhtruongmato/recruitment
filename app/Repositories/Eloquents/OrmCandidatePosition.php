<?php
namespace App\Repositories\Eloquents;

use App\CandidatePosition;

/**
 * 
 */
class OrmCandidatePosition
{
	public function find($id)
	{
		return CandidatePosition::find($id);
	}

	public function paginate($paginate)
	{
		return CandidatePosition::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return CandidatePosition::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}
	
	public function all()
	{
		return CandidatePosition::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return CandidatePosition::insert($data);
	}

	public function update($id, $data)
	{
		return CandidatePosition::where('id', $id)->update($data);
	}
}