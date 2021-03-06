<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;

class ApiController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api');
  }
  use  ApiResponser ;
}
