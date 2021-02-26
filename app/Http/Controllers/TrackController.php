<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracks;
use App\Models\Channels;
use Auth;
use Redirect;

class TrackController extends Controller
{
    /**
     * 
     */
    public function index() {
                
        if(Auth::user()->hasRole('root')) {
            echo 'root';
        }

        if(Auth::user()->hasRole(['root', 'admin'])) {

            $tracks = Tracks::orderBy('id', 'DESC')
                    ->get();
        }  else {

            $tracks = Tracks::where('users_id', Auth::id())
                    ->orderBy('id', 'DESC')
                    ->get();
        }

        return view('track.index')->with('tracks', $tracks);
    }

    /**
     * 
     */
    public function add(Request $request) {

        $channels = Channels::where('users_id', Auth::id())
                        ->where('publish', 1)
                        ->get();

        return view('track.frmAdd')->with('channels', $channels);
    }

    /**
     * 
     */
    public function edit($id, Request $request) {

        $track = Tracks::find($id);

        if($request->isMethod('POST')) {
            $track->name = $request->name;
            $track->save();
            return Redirect::to('tracks');
        }

        return view('track.frmEdit')->with('track', $track);
    }

    /**
     * 
     */
    public function publish($id) {

        $track = Tracks::find($id);

        if($track->publish == 1) {

            $track->publish = -1;
            $track->save();
            $count = Tracks::where('channels_id', $track->channels_id)->where('publish',1)->count();
          
            if($count == 0) {
                $channel = Channels::find($track->channels_id);
                $channel->publish = -1;
                $channel->save();
            }

        } else {

            $track->publish = 1;
            $track->save();

            /* update channel */
            if($track->Channel->publish < 0) {
                $channel = Channels::find($track->channels_id);
                $channel->publish = 1;
                $channel->save();
            }

        }

        
        return Redirect::back();
    }
}
