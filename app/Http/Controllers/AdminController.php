<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Comment;
use App\Services\AdminService;
use App\Services\FileService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    private $adminService;

    private $fileService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->adminService = new AdminService();
        $this->fileService = new FileService();
    }

    public function redirect()
    {
        return redirect(route('index'));
    }

    public function getAddAnnouncementForm()
    {
        return view('form.admin.add-announcement-form');
    }

    public function getEditAnnouncementForm($announcement_id)
    {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
            if (Auth::user()->name !== $announcement->user_name) {
                redirect(route('index'));
            }
            return view('form.admin.edit-announcement-form', compact('announcement'));
        } catch (ModelNotFoundException $exception) {
            return redirect(route('index'));
        }
    }

    public function getDeleteAnnouncementForm($announcement_id)
    {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
            if (Auth::user()->name !== $announcement->user_name) {
                redirect(route('index'));
            }
        } catch (ModelNotFoundException $exception) {
            return redirect(route('index'));
        }
        return view('form.admin.delete-announcement-form', compact('announcement'));
    }

    public function addAnnouncement(Request $request)
    {
        $validator = $this->adminService->validate($request);
        if ($validator->fails()) {
            return redirect(route('getAddAnnouncementForm'))
                ->withErrors($validator)
                ->withInput();
        }
        $announcement = new Announcement();
        $this->adminService->fillAnnouncement($request, $announcement);
        $announcement->save();
        if ($this->fileService->addUserImage($request, $announcement) === false) {
            $announcement->delete();
        }
        return redirect(route('index'));
    }

    public function editAnnouncement(Request $request, $announcement_id)
    {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('index'));
        }
        if (Auth::user()->name !== $announcement->user_name) {
            redirect(route('index'));
        }
        $validator = $this->adminService->validate($request);
        if ($validator->fails()) {
            return redirect(route('getEditAnnouncementForm', compact('announcement_id')))
                ->withErrors($validator)
                ->withInput();
        }
        $copyOfAnnouncement = clone $announcement;
        $this->adminService->fillAnnouncement($request, $announcement);
        $this->fileService->editUserImage($request, $copyOfAnnouncement, $announcement);
        $announcement->save();
        return redirect(route('index'));
    }

    public function deleteAnnouncement(Request $request, $announcement_id)
    {
        try {
            $announcement = Announcement::findOrFail($announcement_id);
        } catch (ModelNotFoundException $exception) {
            return redirect(route('index'));
        }
        if (Auth::user()->name !== $announcement->user_name) {
            redirect(route('index'));
        }
        $copyOfAnnouncement = clone $announcement;
        $announcement->delete();
        $this->fileService->deleteUserImage($copyOfAnnouncement);
        $comments = Comment::where('announcement_id', $announcement_id);
        $comments->delete();
        return redirect(route('index'));
    }

}
