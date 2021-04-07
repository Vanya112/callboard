<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderByRaw('updated_at DESC')->paginate(4);
        return view('pages.index', [
            'announcements' => $announcements,
        ]);
    }

    public function getAnnouncement($announcement_id)
    {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
            $comments = Comment::where('announcement_id', $announcement_id)->orderByRaw('created_at DESC')->paginate(4);
            return view('pages.show-announcement', compact('announcement', 'comments'));
        } catch (ModelNotFoundException $exception) {
            return redirect('/');
        }
    }

    public function searchAnnouncements(Request $request)
    {
        $searchTitle = $request->searchTitle;
        $searchName = $request->searchName;
        $searchPhone = $request->searchPhone;
        $announcements = Announcement::where('title', 'LIKE', "{$searchTitle}%")
            ->where('user_name', 'LIKE', "{$searchName}%")
            ->where('phone_number', 'LIKE', "{$searchPhone}%")
            ->orderByRaw('updated_at DESC')->paginate(4);
        return view('pages.index', compact('announcements'));
    }
}
