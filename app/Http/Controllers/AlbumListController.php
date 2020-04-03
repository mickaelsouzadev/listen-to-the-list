<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AlbumUserService as Service;

class AlbumListController extends Controller
{
	private $service;

	public function __construct(Service $service)
	{
		$this->service = $service;
	}

    public function store()
    {
    	return $this->service->addAlbumAndUserToList(['id'=>'1232153', 'name'=>'Music for the Masses', 'artist_name'=>'Depeche Mode']);
    }
}
