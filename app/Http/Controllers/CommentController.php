<?php

namespace App\Http\Controllers;


use App\Models\Announcement;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    private $commentService;

    function __construct()
    {
        $this->commentService = new CommentService();
    }

    public function addComment(Request $request, $announcement_id) {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('index'));
        }
        $comments = Comment::where('announcement_id', $announcement_id)->orderByRaw('created_at DESC')->paginate(4);
        $validator = $this->commentService->validate($request);
        if ($validator->fails()) {
            return redirect(route('getAnnouncement', compact('announcement_id', 'comments')))
                ->withErrors($validator)
                ->withInput();
        }
        $comment = new Comment();
        $this->commentService->fillComment($request, $comment, $announcement_id);
        $comment->save();
        return redirect(route('getAnnouncement', compact('announcement_id', 'comments')));
    }

    public function searchComments(Request $request, $announcement_id) {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('index'));
        }
        $searchName = $request->searchName;
        $searchText = $request->searchText;
        $comments = Comment::where('announcement_id', $announcement_id)
            ->where('user_name', 'LIKE', "{$searchName}%")
            ->where('text', 'LIKE', "{$searchText}%")->orderByRaw('created_at DESC')->paginate(4);
        return view('pages.show-announcement', compact('announcement', 'comments'));

    }
}
