<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tracks') }}
         
        </h2>
    </x-slot>
   
	<form method="POST">
		@csrf
		<div class="max-w-2xl bg-white py-6 m-auto w-full mt-6 rounded-md">
			<div class="text-2xl mb-6 ml-12">Edit</div>
			
			<div class="grid grid-cols-2 gap-4 max-w-xl m-auto mb-4">
				<input type="text" placeholder="Name" value="{{ $track->name }}" class="rounded" name="name"/>
				<select type="text" placeholder="Name" value="" class="rounded-md " name="channels_id" required>
					@foreach($channels as $channel)
						<option value="{{ $channel->id }}" @if($channel->id==$track->channels_id) selected="selected" @endif>{{ $channel->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="grid grid-cols-2 gap-0 max-w-xl m-auto mb-4 border-t-2 pt-4">
				<div>
					@livewire('track-delete', ['tracks_id' => $track->id])
				</div>
				<div align="right">
					<a class="py-3 px-6 bg-gray-200 text-grey w-full sm:w-32 rounded-md mr-3" href="{{ URL::previous() }}">
						Back
					</a>
					<button class="py-3 px-6 bg-yellow-400 text-black w-full sm:w-32 rounded-md">
						Save
					</button>
				</div>
				
			</div>

		</div>
	</form>

</x-app-layout>
