<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channels;
use App\Models\Categories;
use Auth;
use Redirect;
use Storage;

class ChannelController extends Controller
{
    /**
     * 
     */
    public function index() {
        
        
        if(Auth::user()->hasRole(['root', 'admin'])) {

            $channels = Channels::orderBy('subscribers', 'DESC')->get();

        }  else {
       
            $channels = Channels::where('users_id', Auth::id())
                ->orderBy('subscribers', 'DESC')
                ->get();
        }

        return view('channel.index')
            ->with('channels', $channels);
    }

    /**
     * 
     */
    public function add(Request $request) {

        $categories = Categories::get();
        
        if($request->isMethod('POST')) {
            
            $request->validate([
                'image' => 'required|mimes:jpg,png,gif|max:2048',
            ]);
            $path = Storage::putFile('covers', $request->image);
            $channel = new Channels();
            $channel->categories_id = $request->categories_id;
            $channel->name = $request->name;
            $channel->image = $path;
            $channel->users_id = Auth::id();
            $channel->save();

            return Redirect::to('channels');
        }

        return view('channel.frmAdd')->with('categories', $categories);
    }

    /**
     * 
     */
    public function edit($id, Request $request) {

        $channel = Channels::find($id);
        $categories = Categories::get();
        
        if($request->isMethod('POST')) {

            if($request->image) {
                $request->validate([
                    'image' => 'required|mimes:jpg,png,gif|max:2048',
                ]);
                $path = Storage::putFile('covers', $request->image);
                $channel->image = $path;
            }
           
            $channel->name = $request->name;
            $channel->save();

            return Redirect::to('channels');
        }

        return view('channel.frmEdit')
                ->with('categories', $categories)
                ->with('channel', $channel);
    }

}
