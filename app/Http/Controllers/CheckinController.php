<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkin;
use Illuminate\Support\Facades\Auth;


class CheckinController extends Controller
{
    public function index()
    {
        return view('checkin');
    }

    public function checkin(Request $request)
    {
        $userId = Auth::id(); // logged in user
        $checkin = Checkin::updateOrCreate(
            ['user_id' => $userId],
            ['checkin_time' => now()]
        );
        return response()->json(['status' => 'success', 'message' => 'Checked In']);
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $checkin = Checkin::where('user_id', $userId)->latest()->first();
        if ($checkin && !$checkin->checkout_time) {
            $checkin->checkout_time = now();
            $checkin->save();
            return response()->json(['status' => 'success', 'message' => 'Checked Out']);
        }
        return response()->json(['status' => 'error', 'message' => 'Already Checked Out']);
    }
}
