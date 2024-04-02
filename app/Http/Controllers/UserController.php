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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'start_time' => Carbon::parse($request->start_time)->format('H:i'),
            'end_time' => Carbon::parse($request->end_time)->format('H:i'),
            'jokes_no' => $request->jokes_no,
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }
}
