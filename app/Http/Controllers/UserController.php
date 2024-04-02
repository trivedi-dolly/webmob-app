<?php

namespace App\Http\Controllers;

use App\Mail\JokeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        return view('joke_delivery_form');
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'jokes_no' => 'required|integer|min:1',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'start_time' => Carbon::parse($validatedData['start_time'])->format('H:i'),
            'end_time' => Carbon::parse($validatedData['end_time'])->format('H:i'),
            'jokes_no' => $validatedData['jokes_no'],
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }
}
