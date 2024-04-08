<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class ReelsController extends Controller
{
    public function reels()
    {
        return view(VIEW_FILE_NAMES['reels']);
    }

}
