<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(Request $request)
       {
           // Replace with the recipient address
           Mail::to('sidiainquade@gmail.com')->send(                               );

           return back()->with('success', 'Email sent successfully!');
       }
}
