<?php
namespace App\Repositories\Eloquents;

use App\CandidateLocation;

/**
 * 
 */
class OrmCandidateLocation
{
	public function find($id)
	{
		return CandidateLocation::find($id);
	}

	public function paginate($paginate)
	{
		return CandidateLocation::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}
	
	public function all()
	{
		return CandidateLocation::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return CandidateLocation::insert($data);
	}

	public function update($id, $data)
	{
		return CandidateLocation::where('id', $id)->update($data);
	}
}