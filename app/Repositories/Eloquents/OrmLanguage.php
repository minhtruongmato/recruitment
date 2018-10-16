<?php
namespace App\Repositories\Eloquents;

use App\Language;

/**
 * 
 */
class OrmLanguage
{
	public function find($id)
	{
		return Language::find($id);
	}

	public function paginate($paginate)
	{
		return Language::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}

	public function search_and_paginate($keyword ='', $paginate)
	{
		return Language::where('is_deleted', 0)
						->where('title', 'like', '%'.$keyword.'%')
						->orderBy('id')
						->paginate($paginate);
	}
	
	public function all()
	{
		return Language::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return Language::create($data);
	}

	public function update($id, $data)
	{
		return Language::where('id', $id)->update($data);
	}
}