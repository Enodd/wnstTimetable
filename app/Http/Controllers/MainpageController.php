<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainpageController extends Controller {
  public function index() {
    $mainContent = DB::table('mainpage')->get()->where('id', 2)->value('sHtml');
    return $mainContent;
  }
}