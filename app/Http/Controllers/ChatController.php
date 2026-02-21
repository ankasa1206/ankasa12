<?php

namespace App\Http\Controllers;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller {
    private function getContacts() {
        return (Auth::user()->role == 'admin') 
            ? User::where('role', 'wali')->get() 
            : User::where('role', 'admin')->get();
    }

    public function inbox() {
        return view('chat.messenger', [
            'users' => $this->getContacts(),
            'receiver' => null,
            'messages' => collect([])
        ]);
    }

    public function index($receiverId) {
        $users = $this->getContacts();
        $receiver = User::findOrFail($receiverId);
        $messages = Message::where(function($q) use ($receiverId) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $receiverId);
        })->orWhere(function($q) use ($receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('chat.messenger', compact('users', 'receiver', 'messages'));
    }

public function store(Request $request) {
    $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return $request->ajax() ? response()->json($message) : back();
}
}