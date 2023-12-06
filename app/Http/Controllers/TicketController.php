<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Notifications\TicketUpdatedNotification;

class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::where('status', '!=', 'resolved')->get();
        return  view('ticket.index')->with('tickets',$tickets);
    }
    public function resolve()
    {
        $tickets = Ticket::where('status', 'resolved')->get();
        return  view('ticket.resolve')->with('tickets',$tickets);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
{

    if ($request->file('attachment')) {
        $ext = $request->file('attachment')->extension();
        $filename = Str::random(25) . '.' . $ext;
        $name = Str::random(15);

        $contents = file_get_contents($request->file('attachment'));
        $path = "attachments/{$filename}";

        Storage::disk('public')->put($path, $contents);

        $ticket = Ticket::create([
        'receive'       => $request->receive,
        'title'       => $request->title,
        'description' => $request->description,
        'user_id'     => auth()->id(),
        'ticket_id'     => $name,
        'attachment'  => $path, // Assuming you have a column named 'attachment' in your 'tickets' table
        ]);
        
        $ticket->update(['attachment'=>$path]);
    } else{

        $name = Str::random(15);
    $ticket = Ticket::create([
        
        'receive'       => $request->receive,
        'title'       => $request->title,
        'description' => $request->description,
        'user_id'     => auth()->id(),
        'ticket_id'     => $name,
]);

    }
    return response()->redirectToRoute('ticket.index');
}

public function show(Ticket $ticket)
{
        return view('ticket.show', compact('ticket'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {  
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    
public function update(UpdateTicketRequest $request, Ticket $ticket)
{
    // Update the ticket with the request data (excluding 'attachment')
    $ticket->update($request->except('attachment'));

    if ($request->hasFile('attachment')) {
        // Delete the current attachment if it exists
        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }

        // Process the new attachment
        $attachmentFile = $request->file('attachment');
        $ext = $attachmentFile->extension();
        $filename = Str::random(25) . '.' . $ext;
        $path = "attachments/{$filename}";

        // Store the new attachment
        Storage::disk('public')->put($path, file_get_contents($attachmentFile));

        // Update the ticket with the new attachment path
        $ticket->update(['attachment' => $path]);
    }

    return redirect(route('ticket.index'));
}
    



// TicketController.php

public function resolved($id)
{
    // Assuming you have an 'is_resolved' column in your 'tickets' table
    // You can customize the logic based on your application requirements

    $ticket = Ticket::findOrFail($id);
    $ticket->update(['status' => 'resolved']);

    return redirect()->route('ticket.index')->with('success', 'Ticket marked as resolved successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }
}   
