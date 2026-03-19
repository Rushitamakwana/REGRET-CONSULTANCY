<?php

namespace App\Traits;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

trait Notifiable
{
    /**
     * Log a notification for the authenticated admin user.
     */
    protected function logNotification(string $title, string $message, string $type = 'success', array $data = []): void
    {
        if (!Auth::check() || !in_array(Auth::user()->role ?? '', ['admin', 'super_admin'])) {
            return;
        }

        Notification::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ]);
    }
}

