<?php
namespace App\Repositories\Eloquents;

use App\Position;

/**
 * 
 */
class OrmPosition
{
	public function find($id)
	{
		return Position::find($id);
	}

	public function paginate($paginate)
	{
		return Position::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Position::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}

	public function all()
	{
		return Position::where('is_deleted', 0)->get();
	}
	
	public function save($data)
	{
		return Position::create($data);
	}

	public function update($id, $data)
	{
		return Position::where('id', $id)->update($data);
	}
}