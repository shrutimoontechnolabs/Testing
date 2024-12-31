<?php

// app/Http/Controllers/NotificationController.php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        // Fetch notifications for the logged-in user
        $notifications = Notification::where('to_id', auth()->user()->id)
                                     ->latest()  // Order by most recent
                                     ->get();
        
        // Return the main layout or view, passing the notifications
        return view('layouts.userlayout', compact('notifications'));
    }
    
    public function markAsRead($notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['read_at' => now()]); // Mark as read
        
        return redirect()->route('tasks.index'); // Or redirect to a task or notifications page
    }
}
