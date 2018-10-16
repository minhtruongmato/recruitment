<?php
namespace App\Repositories\Eloquents;

use App\Field;

/**
 * 
 */
class OrmField
{
	public function find($id)
	{
		return Field::find($id);
	}

	public function paginate($paginate)
	{
		return Field::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Field::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}

	public function all()
	{
		return Field::where('is_deleted', 0)->get();
	}
	
	public function save($data)
	{
		return Field::create($data);
	}

	public function update($id, $data)
	{
		return Field::where('id', $id)->update($data);
	}
}