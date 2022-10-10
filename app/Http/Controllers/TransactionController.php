<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;


class TransactionController extends Controller
{
    function index()
    {
       $users = User::all();
       
        return view('admin.dashboard', compact('users'));
    }
}
