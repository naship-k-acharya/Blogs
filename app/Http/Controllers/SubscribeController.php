<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SubscribeController extends Controller
{
    public function store(Request $request)
	{
        $email = Auth::user()->email;

        // Check if the email already exists in the subscribers table
        if (Subscribe::where('email', $email)->exists()) {
           
            sleep(3);
            Toastr::success('You successfully Subscribed out Channel');
            return redirect()->back();
        }

        // Create a new subscriber record
        $subscriber = new Subscribe();
        $subscriber->email = $email;
        $subscriber->save();
        sleep(3);
        Toastr::success('Thank you for subscribing!');
        // Optionally, you can flash a success message
        return redirect()->back();
	}
}
