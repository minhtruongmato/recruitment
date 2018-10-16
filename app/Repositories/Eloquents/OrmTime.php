<?php
namespace App\Repositories\Eloquents;

use App\Time;

/**
 * 
 */
class OrmTime
{
	public function find($id)
	{
		return Time::find($id);
	}

	public function paginate($paginate)
	{
		return Time::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Time::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}

	public function all()
	{
		return Time::where('is_deleted', 0)->get();
	}
	
	public function save($data)
	{
		return Time::create($data);
	}

	public function update($id, $data)
	{
		return Time::where('id', $id)->update($data);
	}
}