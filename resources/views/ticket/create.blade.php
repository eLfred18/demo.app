<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 leading-tight">
        {{ __('Create new support ticket') }}
        </h2>
    </x-slot>
    
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-600">
                
                <form method="POST" action="{{route('ticket.store')}}" enctype="multipart/form-data" >
                    <div class="w-full sm:max-w-xl  px-6 py-4 bg-white overflow-hidden ">
          
                    @csrf
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="receive" :value="__('To')" />
                    <x-text-input id="receive" class="block mt-1 w-full"  type="text" name="receive" autofocus />
                    <x-input-error :messages="$errors->get('receive')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Subject')" />
                    <x-text-input id="title" class="block mt-1 w-full"  type="text" name="title" autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Message')" />
                    <x-textarea  id="description" class="block mt-1 w-full" type="text" name="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="attachment" :value="__('Attachment (if any)')" />
                    <x-file-input name="attachment" id="attachment" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-text-input id="ticket_id" class="block mt-1 w-full"  type="text" name="ticket_id" value="" hidden/>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3 bg-gray-200">
                        Create
                    </x-primary-button>
                </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>