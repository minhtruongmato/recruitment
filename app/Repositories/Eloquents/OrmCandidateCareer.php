<?php
namespace App\Repositories\Eloquents;

use App\CandidateCareer;

/**
 * 
 */
class OrmCandidateCareer
{
	public function find($id)
	{
		return CandidateCareer::find($id);
	}

	public function paginate($paginate)
	{
		return CandidateCareer::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}
	
	public function all()
	{
		return CandidateCareer::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return CandidateCareer::insert($data);
	}

	public function update($id, $data)
	{
		return CandidateCareer::where('id', $id)->update($data);
	}
}