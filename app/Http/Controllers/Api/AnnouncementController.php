<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $today =  Carbon::now()->format('Y-m-d');
        $announcements = Announcements::where('post_date', '<=', $today)
            ->select('post_date', 'user_id', 'messages', 'participation')
            ->get()
            ->groupBy('post_date')
            ->toArray();

        return response()->json([
            'success' => 'true',
            'message' => 'Announcement data retrieved!',
            'data' => $announcements
        ]);
    }
}
