<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Card;
use App\Models\Ticket;
use App\Models\User;

class BusController extends Controller
{
    public function getBusInfo(Request $request)
    {
        $route = Route::where('name', $request->route_name)->first();

        if (!$route) {
            return response()->json(['message' => 'Route not found'], 404);
        }

        $bus = $route->bus;

        return response()->json([
            'bus_name' => $bus->name,
            'route_name' => $route->name,
            'fare' => $route->fare
        ]);
    }

    public function deductFare(Request $request)
    {
        $user = User::find($request->user_id);
        $route = Route::find($request->route_id);

        if (!$user || !$route) {
            return response()->json(['message' => 'Invalid data'], 400);
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

        $tickets = Ticket::where('user_id', $user->id)->get();

        return response()->json(['tickets' => $tickets], 200);
    }
}
