<?php
namespace App\Repositories\Eloquents;

use App\Education;

/**
 * 
 */
class OrmEducation
{
	public function find($id)
	{
		return Education::find($id);
	}

	public function paginate($paginate)
	{
		return Education::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Education::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}
	
	public function all()
	{
		return Education::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return Education::create($data);
	}

	public function update($id, $data)
	{
		return Education::where('id', $id)->update($data);
	}
}