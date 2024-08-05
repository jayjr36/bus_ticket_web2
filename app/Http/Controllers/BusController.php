<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Card;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class BusController extends Controller
{
    public function getBusInfo(Request $request)
{
    $route = Route::where('name', $request->route_name)
                  ->whereHas('bus', function ($query) use ($request) {
                      $query->where('name', $request->bus_name);
                  })
                  ->first();

    if (!$route) {
        return response()->json(['message' => 'Route not found for the specified bus'], 404);
    }

    return response()->json([
        'bus_name' => $route->bus->name,
        'route_name' => $route->name,
        'route_id' => $route->id, 
        'fare' => $route->fare
    ]);
}


  public function deductFare(Request $request)
{
    // Query the bus ID based on the bus name
    $bus = Bus::where('name', $request->bus_name)->first();

    if (!$bus) {
        return response()->json(['message' => 'Invalid bus name'], 400);
    }

    $user = User::find($request->user_id);
    $route = Route::find($request->route_id);

    if (!$user || !$route) {
        return response()->json(['message' => 'Invalid data'], 400);
    }

    // Check if the route belongs to the specified bus
    if ($route->bus_id !== $bus->id) {
        return response()->json(['message' => 'Route does not belong to the specified bus'], 400);
    }

    $card = $user->card;

    if ($card->balance < $route->fare) {
        return response()->json(['message' => 'Insufficient balance'], 400);
    }

    $card->balance -= $route->fare;
    $card->save();

    $ticket = Ticket::create([
        'user_id' => $user->id,
        'bus_id' => $route->bus_id,
        'route_id' => $route->id,
        'fare' => $route->fare,
    ]);

    return response()->json(['message' => 'Fare deducted', 'ticket' => $ticket], 200);
}


public function getTickets(Request $request)
{
    $user = User::find($request->user_id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Fetch tickets for the user with related bus and route information
    $tickets = Ticket::where('user_id', $user->id)
                     ->with(['bus', 'route']) // Eager load relationships
                     ->get();

    // Transform each ticket to include bus name, route name, and formatted date
    $formattedTickets = $tickets->map(function ($ticket) {
        return [
            'id' => $ticket->id,
            'user_id' => $ticket->user_id,
            'bus_id' => $ticket->bus_id,
            'bus_name' => $ticket->bus->name, // Access bus name via relationship
            'route_id' => $ticket->route_id,
            'route_name' => $ticket->route->name, // Access route name via relationship
            'fare' => $ticket->fare,
            'date' => $ticket->created_at->toDateTimeString(), // Format date as needed
            'created_at' => $ticket->created_at,
            'updated_at' => $ticket->updated_at,
        ];
    });

    return response()->json(['tickets' => $formattedTickets], 200);
}

public function processTicket(Request $request)
{
    $validator = Validator::make($request->all(), [
        'bus_name' => 'required|string',
        'route_name' => 'required|string',
        'card_number' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Retrieve the validated input
    $busName = $request->input('bus_name');
    $routeName = $request->input('route_name');
    $cardNumber = $request->input('card_number');

    // Check if the card exists and retrieve it
    $card = Card::where('card_number', $cardNumber)->first();

    if (!$card) {
        return response()->json(['message' => 'Card not found.'], 404);
    }

    // Find the route by name
    $route = Route::where('name', $routeName)->first();

    if (!$route) {
        return response()->json(['message' => 'Route not found.'], 404);
    }

    // Check if the user has enough balance
    if ($card->balance < $route->fare) {
        return response()->json(['message' => 'Insufficient balance.'], 400);
    }

    // Deduct the fare from the card's balance
    $card->balance -= $route->fare;
    $card->save();

    // Create the ticket
    $ticket = Ticket::create([
        'fare' => $route->fare,
        'user_id' => $card->user_id,
        'route_id' => $route->id,
    ]);

    return response()->json([
        'message' => 'success',
        'success' => true,
    ], 200);
}

}
