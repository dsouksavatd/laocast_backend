<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsors;

class SupportController extends Controller
{
    /**
     * 
     */
    public function index() {
        
        $tracks = Tracks::get();
        return view('tracks')->with('tracks', $tracks);
    }
}
