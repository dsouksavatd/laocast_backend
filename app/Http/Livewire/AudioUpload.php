<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Channels;
use App\Models\Tracks;
use Auth;
use Request;
use Redirect;
use wapmorgan\Mp3Info\Mp3Info;

class AudioUpload extends Component
{

    use WithFileUploads;

    public $audio;
    public $channels_id;
    public $categories_id;
    public $name;

    /**
     * 
     */
    public function save(Request $request)
    {   
        $this->validate([
            'audio' => 'required|mimes:mp3,mp4|max:20240', // 1MB Max
            'name' => 'required',
            'channels_id' => 'required'
        ]);

        $category = Channels::find($this->channels_id);

        $audio = $this->audio->store('files');
        
        $track = new Tracks();
        $track->users_id = Auth::id();
        $track->track = 'https://audio.laocast.com/'.$audio;

        $audio = new Mp3Info(storage_path('app/'.$audio), true);
    
        $track->channels_id = $this->channels_id;
        $track->categories_id = $category->id;
        $track->name = $this->name;
        $track->duration = $audio->duration * 1000;
        $track->save();

        return Redirect::to('tracks');
    }

    /**
     * 
     */
    public function render()
    {
        $channels = Channels::where('users_id', Auth::id())->get();

        return view('livewire.audio-upload')->with('channels', $channels);
    }
}
