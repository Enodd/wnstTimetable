<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainpageController extends Controller
{
  public static function index()
  {
    return DB::table('mainpage')->get()->where('id', 2)->value('sHtml');
  }
}
