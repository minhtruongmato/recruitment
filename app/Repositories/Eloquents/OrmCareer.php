<?php
namespace App\Repositories\Eloquents;

use App\Career;

/**
 * 
 */
class OrmCareer
{
	public function find($id)
	{
		return Career::find($id);
	}

	public function paginate($paginate)
	{
		return Career::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Career::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}
	
	public function all()
	{
		return Career::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return Career::create($data);
	}

	public function update($id, $data)
	{
		return Career::where('id', $id)->update($data);
	}
}