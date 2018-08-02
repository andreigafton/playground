<?php

namespace App\Http\Controllers;

use App\GroupResult;
use Illuminate\Http\Request;

class GroupResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.results.index')->withEntities(GroupResult::all());
    }
}
