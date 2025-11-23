<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-lg shadow">

                    <h2 class="text-2xl font-bold mb-4">{{ $ticket->subject }}</h2>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $ticket->description }}</p>

                    @if($ticket->getMedia('attachments')->count() > 0)
                        <div class="mt-8 border-t pt-4">
                            <h3 class="text-lg font-medium mb-2">Files:</h3>
                            <ul class="space-y-2">
                                @foreach($ticket->getMedia('attachments') as $media)
                                    <li class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        <a href="{{ route('download.media', [$media]) }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ $media->file_name }} ({{ $media->human_readable_size }})
                                        </a>
                                        <a href="{{ route('download.media', [$media]) }}" download class="text-xs bg-gray-200 px-2 py-1 rounded">Download</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">

                @if($ticket->status == 'closed')
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status</h3>
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Closed at</span>
                            <div>{{ $ticket->closed_at->format('d.m.Y H:i') }}</div>
                        </div>
                    </div>
                @else
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="block text-sm font-medium text-gray-700 mb-1">Change status</label>
                        <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mb-4">
                            <option value="open" @selected($ticket->status == 'open')>Open</option>
                            <option value="in_progress" @selected($ticket->status == 'in_progress')>In progress</option>
                            <option value="closed" @selected($ticket->status == 'closed')>Closed</option>
                        </select>


                        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Update status
                        </button>
                    </form>
                </div>
                @endif

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Customer</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Name</span>
                            <div class="font-medium">{{ $ticket->customer->name }}</div>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Email</span>
                            <div class="text-blue-600">{{ $ticket->customer->email }}</div>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Phone</span>
                            <div>{{ $ticket->customer->phone }}</div>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 uppercase">Created at</span>
                            <div>{{ $ticket->created_at->format('d.m.Y H:i') }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
