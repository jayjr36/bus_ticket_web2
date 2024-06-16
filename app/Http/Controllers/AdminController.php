<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Ticket;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'card_number' => 'required|string|max:255|unique:cards',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Card::create([
            'user_id' => $user->id,
            'card_number' => $validated['card_number'],
            'balance' => 0,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function topupUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = User::find($validated['user_id']);
        $user->card->balance += $validated['amount'];
        $user->card->save();

        return redirect()->route('admin.users')->with('success', 'User balance topped up successfully');
    }

    public function showBuses()
    {
        $buses = Bus::with('routes')->get();
        return view('admin.buses', compact('buses'));
    }

    public function showPassengers(Bus $bus, Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $tickets = Ticket::where('bus_id', $bus->id)->whereDate('created_at', $date)->with('user')->get();
        return view('admin.passengers', compact('bus', 'tickets', 'date'));
    }

    public function showFareCollection(Bus $bus, Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $totalFare = Ticket::where('bus_id', $bus->id)->whereDate('created_at', $date)->sum('fare');
        return view('admin.fare-collection', compact('bus', 'totalFare', 'date'));
    }
}
