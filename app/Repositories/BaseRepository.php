<?php  

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
	protected $model;

	public function __construct (Model $model) 
	{
		$this->model = $model;
	}

	public function create(array $data) : Model
	{
		return $this->model::create($data);
	}

	public function find($id) : ?Model
	{
		return $this->model::find($id);
	}

	public function delete($id)
	{
		return $this->model::find($id)->delete();
	}

}