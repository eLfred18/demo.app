<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-black text-lg font-bold">{{ $ticket->title }}</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="text-black flex justify-between py-4">
                <p>{{ $ticket->description }}</p>
                <p>{{ $ticket->created_at }}</p>
                @if ($ticket->attachment)
                    <a href="{{ '/storage/' . $ticket->attachment }}" target="_blank">Attachment</a>
                @endif
            </div>

            <div class="flex justify-between">
                <div class="flex">
                <form action="{{ route('ticket.resolved', ['id' => $ticket->id]) }}" method="post">
    @csrf
    @method('post') <!-- Use 'post' method to override the default 'get' -->
    <x-primary-button class="ml-3 bg-gray-200">Mark as Resolved
                    </x-primary-button>
</form>
                </div>
                @if (auth()->user()->isAdmin)
                    <div class="flex">
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="resolved" />
                            <x-primary-button>Resolve</x-primary-button>
                        </form>
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="rejected" />
                            <x-primary-button class="ml-2">Reject</x-primary-button>
                        </form>
                    </div>
                @else
                    <p class="text-black">Status: {{ $ticket->status }} </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>


