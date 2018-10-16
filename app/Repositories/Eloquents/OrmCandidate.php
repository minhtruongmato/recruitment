<?php
namespace App\Repositories\Eloquents;

use App\Candidate;

/**
 * 
 */
class OrmCandidate
{
	public function paginate($paginate)
	{
		return Candidate::where('is_deleted', 0)->orderBy('id', 'desc')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Candidate::with('career', 'field', 'location', 'position', 'language', 'time', 'education', 'wage')->whereExists(function ($query) use ($keyword){
            $query->where('is_deleted', 0)->where('title', 'like', '%'.$keyword.'%')->orWhere('name', 'like', '%'.$keyword.'%')->orderBy('id', 'desc');
        })->paginate($paginate);
	}

	public function find($id)
	{
		return Candidate::with('career', 'field', 'location', 'position', 'language', 'time', 'education', 'wage')->where('is_deleted', 0)->find($id);
	}

	public function findWithoutRelationships($id)
	{
		return Candidate::where('is_deleted', 0)->find($id);
	}

	public function save($data)
	{
		return Candidate::create($data);
	}

	public function update($id, $data)
	{
		return Candidate::where('id', $id)->update($data);
	}

	public function insertGetId($data)
	{
		return Candidate::insertGetId($data);
	}


}