<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConductorsController extends Controller
{
  public function index()
  {
    $conductors = DB::table('conductors')->get();
    return $conductors;
  }
}
