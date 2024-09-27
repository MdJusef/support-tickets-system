<!-- resources/views/tickets/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Tickets') }}--}}
{{--        </h2>--}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->role === 'customer')
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Open New Ticket</a>
                    @endif

                    <br><br>
                    @foreach ($tickets as $ticket)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ticket->title }} ({{ $ticket->status }})</h5>
                                <p class="card-text">{{ $ticket->message }}</p>
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-secondary">View Ticket</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
