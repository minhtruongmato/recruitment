<?php
namespace App\Repositories\Eloquents;

use App\Wage;

/**
 * 
 */
class OrmWage
{
	public function find($id)
	{
		return Wage::find($id);
	}

	public function paginate($paginate)
	{
		return Wage::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Wage::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}
	
	public function all()
	{
		return Wage::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return Wage::create($data);
	}

	public function update($id, $data)
	{
		return Wage::where('id', $id)->update($data);
	}
}