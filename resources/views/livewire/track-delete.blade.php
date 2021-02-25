<div>

        <input type="hidden" value="" wire:model="tracks_id"/>
        <button     
            type="button"
            wire:click="delete"
            class="py-3 px-6 bg-red-500 text-white w-full sm:w-32 rounded-md mr-3" 
            wire:loading.attr="disabled"
            wire:loading.class="disabled:opacity-50">
            <span wire:loading.remove>Delete</span>
            <span wire:loading>Deleting...</span>
        </button>
   
</div>
