<div>
    <script src="{{ asset('js/app.js') }}"></script>
<form wire:submit.prevent="save">

    <div class="max-w-2xl bg-white py-6 m-auto w-full mt-6 rounded-md">
        <div class="text-2xl mb-6 ml-12">Add new</div>

        <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
            <input type="text" placeholder="Name" value="" class="rounded-md " wire:model="name" required/>
            <select type="text" placeholder="Name" value="" class="rounded-md " wire:model="channels_id" required>
                <option value="">- Channels -</option>
                @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
            </select>

            <input type="file" wire:model="audio">
            @error('audio') <span class="error">{{ $message }}</span> @enderror
            <div wire:loading wire:target="audio"><img src="{{ URL::to('ajax-loader.gif') }}"/></div>
        </div>
        <div class="grid grid-cols-1 gap-4 max-w-xl m-auto mt-4">
            <p class="text-gray-500">Please select mp3 file with maximum file size at : 20MB</p>
        </div>
        
        <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">
            
            <div class="col-span-2 text-right mt-6 border-t-2 py-4">
                <a class="py-3 px-6 bg-gray-200 text-grey w-full sm:w-32 rounded-md mr-3" href="{{ URL::previous() }}">
                    Back
                </a>
                <button class="py-3 px-6 bg-yellow-400 text-black w-full sm:w-32 rounded-md"
                    wire:loading.class="disabled:opacity-50"
                    wire:loading.attr="disabled">
                    Save
                </button>
            </div>
        </div>

    </div>
</form>
</div>
