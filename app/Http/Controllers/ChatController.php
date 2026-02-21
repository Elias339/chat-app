<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        $users = User::where('id','!=',auth()->id())->get();
        return view('chat.index',compact('users'));
    }

    public function sendMessage(Request $request){
        $request->validate([
            'receiver_id'=>'required|exists:users,id',
            'message'=>'required|string',
        ]);

        Message::create([
            'sender_id'=>auth()->id(),
            'receiver_id'=>$request->receiver_id,
            'message'=>$request->message
        ]);

        return response()->json(['success'=>true]);
    }

    public function getMessages(User $user){
        $messages = Message::where(function($q) use($user){
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $user->id);
        })->orWhere(function($q) use($user){
            $q->where('sender_id', $user->id)
              ->where('receiver_id', auth()->id());
        })->get();

        return response()->json($messages);
    }
}
