<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Message;
use App\Models\Project;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getUser()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * retun the view for admin.
     */
    public function index()
    {
        $users = User::all();
        $tools = \App\Models\Tool::all();
        $projects = \App\Models\Project::all();
        $projects->load('tools');
        $messages = \App\Models\Message::all();

        return view('home', compact('users','tools','projects','messages'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully');
    }

    public function update(UpdateUserRequest $request)
    {
      
        
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
   
}
