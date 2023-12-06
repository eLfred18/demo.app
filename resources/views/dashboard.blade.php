<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
        <h2 class="font-semibold text-gray-800 leading-tight">
            {{ __('Support Tickets') }}
        </h2>
            <div>
                <a href="{{ route('ticket.create') }}" class="bg-gray-200 rounded-lg p-2" style="color:white">Create New</a> 
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
                <div class="p-6 text-gray-800">
                 
                
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ url('/ticket/create') }}">
                    {{ __('Create Ticket') }}
                </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
