<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class taskController extends Controller
{
   public function index() {
    return view('task.index');
   }
   public function create() {
    return view('task.create');
   }
}
