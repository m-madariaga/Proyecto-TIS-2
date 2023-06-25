<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public static function print(){
        $user= Auth::User();
        $notifs= $user->unreadnotifications;
        foreach($notifs as $notif){
            error_log($notif->data['body']);
            $notif->markAsRead();
        }
        return $notifs;
    }
}