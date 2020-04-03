<?php  

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface 
{

	public function create(array $data) : Model;

	public function find($id) : ?Model;

	public function delete($id);

}
