<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-between w-full sm:max-w-xl">
            <h1 class="text-black text-lg font-bold">Support Tickets</h1>
            <div>
                <a href="{{ route('ticket.create') }}" class="text-gray-200 bg-white rounded-lg p-2">Create New</a> 
            </div>
        </div>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @forelse ($tickets as $ticket)
        <!-- Display ticket information for non-resolved tickets -->
         <div class="text-black flex justify-between py-4">
                    <a href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->title }}</a>
                    
                    <p>{{ $ticket->created_at->diffForHumans() }}</p>

                        <div class="flex">
                    <a href="{{ route('ticket.edit', $ticket->id) }}">
                        <x-secondary-button class="flex bg-gray-200"><i class="fa fa-pencil"></i></x-primary-button>
                    </a>

                    <form class="ml-2" action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button class="flex bg-gray-200"><i class="fa fa-trash-o"></i></x-primary-button>
                    </form>
                </div>
                </div>
            @empty
                <p class="text-black">You don't have any support ticket yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
