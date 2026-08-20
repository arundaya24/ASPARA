<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'email', 'message', 'phone', 'status',
        'read_at', 'reply', 'replied_at', 'ip_address', 'user_agent'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    public function markAsRead()
    {
        if ($this->status === 'unread') {
            $this->update([
                'status' => 'read',
                'read_at' => now()
            ]);
        }
    }

    public function markAsReplied()
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now()
        ]);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'unread' => '<span class="status-badge status-unread">Belum Dibaca</span>',
            'read' => '<span class="status-badge status-read">Sudah Dibaca</span>',
            'replied' => '<span class="status-badge status-replied">Sudah Dibalas</span>',
            default => '<span class="status-badge">' . $this->status . '</span>',
        };
    }
}
