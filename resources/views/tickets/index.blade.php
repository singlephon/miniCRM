<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between bg-white p-6 rounded-lg shadow mb-6">
                <form method="GET" action="{{ route('tickets.index') }}" class="flex flex-wrap gap-4 items-end">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Email or phone number"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Все</option>
                            <option value="open" @selected(request('status') == 'open')>Open</option>
                            <option value="in_progress" @selected(request('status') == 'in_progress')>In progress</option>
                            <option value="closed" @selected(request('status') == 'closed')>Closed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" value="{{ request('date') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <button type="submit" class="bg-none border-0 cursor-pointer">
                        Submit
                    </button>

                    <a href="{{ route('tickets.index') }}" class="text-gray-500 hover:text-gray-700">Reset</a>
                </form>

                <a href="{{ route('logout') }}">Logout</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">#{{ $ticket->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $ticket->subject }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $ticket->customer->name }}</div>
                                <div class="text-sm text-gray-500">{{ $ticket->customer->email }}</div>
                                <div class="text-sm text-gray-700">{{ $ticket->customer->phone }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $ticket->status === 'closed' ? 'bg-green-100 text-green-800' :
                                      ($ticket->status === 'open' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $ticket->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{ route('tickets.show', $ticket) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Open</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
