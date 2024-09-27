<!-- resources/views/tickets/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>{{ $ticket->title }}</h3>
                    <p>{{ $ticket->message }}</p>

                    @if ($ticket->status === 'open' && auth()->user()->role === 'admin')
                        <form action="{{ route('tickets.answer', $ticket) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="response" class="form-label">Respond to Ticket</label>
                                <textarea class="form-control" id="response" name="response" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary">Send Response</button>
                        </form>
                        <form action="{{ route('tickets.close', $ticket) }}" method="POST" style="margin-top: 20px;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Close Ticket</button>
                        </form>
                    @else
                        <p>Status: {{ $ticket->status }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
