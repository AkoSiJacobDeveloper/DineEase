<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Table;
use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function create()
    {
        $availableTables = Table::where('is_available', true) 
            ->select(['id', 'table_number', 'is_available'])
            ->get();

        return Inertia::render('WebPage/Reservation', [
            'tables' => $availableTables->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        // Validate the reservation form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'guests' => 'required|integer|min:1|max:20',
            'table_id' => 'required|integer',
            'date' => 'required|date',
        ]);

        // Optional: Get the table number for email content
        $table = Table::find($validated['table_id']);
        $validated['table'] = $table ? $table->table_number : 'Unknown';

        // ✅ Correct way to send the email
        Mail::to($validated['email'])->send(new ReservationMail($validated));

        return back()->with('success', 'Reservation created successfully');
    }
}
