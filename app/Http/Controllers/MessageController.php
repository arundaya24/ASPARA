<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReply;

class MessageController extends Controller
{
    /**
     * API: Simpan pesan dari frontend
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|min:10',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();

        $message = Message::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim! Kami akan segera merespons.',
            'data' => $message
        ], 201);
    }

    /**
 * Admin: Tampilkan semua pesan
 */
public function index()
{
    // Gunakan paginate() bukan get() agar bisa pakai links()
    $messages = Message::latest()->paginate(20);
    $unreadCount = Message::where('status', 'unread')->count();

    return view('admin.messages.index', compact('messages', 'unreadCount'));
}

    /**
     * Admin: Tampilkan detail pesan
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->markAsRead();

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Admin: Balas pesan
     */
    public function reply(Request $request, $id)
{
    $request->validate([
        'reply' => 'required|string|min:3'
    ]);

    $message = Message::findOrFail($id);
    $message->update([
        'reply' => $request->reply,
        'status' => 'replied',
        'replied_at' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Balasan berhasil dikirim!'
    ]);
}

    /**
     * Admin: Hapus pesan
     */
    /**
 * Admin: Mark all messages as read
 */
public function markAllRead()
{
    Message::where('status', 'unread')->update([
        'status' => 'read',
        'read_at' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Semua pesan telah ditandai sebagai sudah dibaca.'
    ]);
}

/**
 * Admin: Delete all messages
 */
public function destroyAll()
    {
        Message::truncate();

        return response()->json([
            'success' => true,
            'message' => 'Semua pesan berhasil dihapus.'
        ]);
    }

    /**
     * Admin: Delete single message
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus.'
        ]);
    }


}
