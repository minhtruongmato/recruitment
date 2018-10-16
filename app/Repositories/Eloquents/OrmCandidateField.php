<?php
namespace App\Repositories\Eloquents;

use App\CandidateField;

/**
 * 
 */
class OrmCandidateField
{
	public function find($id)
	{
		return CandidateField::find($id);
	}

	public function paginate($paginate)
	{
		return CandidateField::where('is_deleted', 0)->orderBy('id')->paginate($paginate);
	}
	
	public function all()
	{
		return CandidateField::where('is_deleted', 0)->get();
	}

	public function save($data)
	{
		return CandidateField::insert($data);
	}

	public function update($id, $data)
	{
		return CandidateField::where('id', $id)->update($data);
	}
}