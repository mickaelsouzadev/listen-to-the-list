<?php  

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Album;

class AlbumRepository extends BaseRepository
{

	public function __construct(Album $model)
	{
		parent::__construct($model);
	}

	public function create(array $data) : Model
	{
		return $this->model::firstOrCreate($data);
	}

}