<?php

namespace App\Http\Controllers;

use App\Mail\TicketClosed;
use App\Mail\TicketCreated;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{

    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $tickets = Ticket::orderBy('created_at', 'asc')->get();
        } else {
            $tickets = auth()->user()->tickets()->orderBy('created_at', 'asc')->get();
        }
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }


    public function store(Request $request)
    {
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $adminEmail = "mdjusef143@gmail.com";

        if (empty($adminEmail)) {
            return redirect()->route('tickets.index')->with('error', 'Admin email is not configured.');
        }

        Mail::to($adminEmail)->send(new TicketCreated($ticket->title, $ticket->description));

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(string $id)
    {
        $ticket = Ticket::where('id', $id)->first();

        return view('tickets.show', compact('ticket'));
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {

    }

    // Admin responds to a ticket
    public function ticketAnswer(Request $request, Ticket $ticket)
    {
        $request->validate(['message' => 'required|string']);

        $ticket->update(['response' => $request->description]);

        // Notify the customer about the response
       Mail::to($ticket->user->email)->send(new TicketClosed($ticket));

        return back()->with('status', 'Response sent successfully!');
    }

    // Admin closes a ticket
    public function close(String $id)
    {
        $ticket = Ticket::where('id', $id)->first();
        $ticket->update(['status' => 'closed']);

        // Notify the customer about ticket closure
       Mail::to($ticket->user->email)->send(new TicketClosed($ticket));

        return back()->with('status', 'Ticket closed successfully!');
    }
}
