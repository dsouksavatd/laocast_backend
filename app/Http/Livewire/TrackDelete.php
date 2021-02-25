<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tracks;
use Auth;
use Redirect;

class TrackDelete extends Component
{
    public $tracks_id;

    /**
     * 
     */
    public function delete()
    {   
        $track = Tracks::where('users_id', Auth::id())
                        ->where('id', $this->tracks_id)
                        ->first();
        $track->delete();

        return Redirect::to('tracks');
    }

    /**
     * 
     */
    public function render()
    {
        return view('livewire.track-delete');
    }
}
