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

	public function index($id) 
	{
		return $this->service->getAlbumList($id);
	}

    public function store(Request $request)
    {
    	return $this->service->addAlbumAndUserToList($request);
    }
}
