<?php
namespace App\Repositories\Eloquents;

use App\Location;

/**
 * 
 */
class OrmLocation
{
	public function find($id)
	{
		return Location::find($id);
	}

	public function paginate($paginate)
	{
		return Location::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Location::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}

	public function all()
	{
		return Location::where('is_deleted', 0)->get();
	}
	
	public function save($data)
	{
		return Location::create($data);
	}

	public function update($id, $data)
	{
		return Location::where('id', $id)->update($data);
	}
}