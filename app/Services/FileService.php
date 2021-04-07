<?php

namespace App\Services;


class FileService
{
    public function addUserImage($request, $announcement)
    {
        $announcementFilePath = storage_path('app/public') . "\\" . $announcement->user_name . "\\" . $announcement->id;
        $request->file('image')->move($announcementFilePath, $announcement->image_name);
    }

    public function editUserImage($request, $copyOfAnnouncement, $announcement)
    {
        $imageFilePath = storage_path('app/public') . "\\" . $copyOfAnnouncement->user_name . "\\" . $copyOfAnnouncement->id . "\\" . $copyOfAnnouncement->image_name;
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);
        }
        $this->addUserImage($request, $announcement);
    }

    public function deleteUserImage($copyOfAnnouncement)
    {
        $userDirPath = storage_path('app/public') . "\\" . $copyOfAnnouncement->user_name;
        $announcementDirPath = storage_path('app/public') . "\\" . $copyOfAnnouncement->user_name . "\\" . $copyOfAnnouncement->id;
        $imageFilePath = storage_path('app/public') . "\\" . $copyOfAnnouncement->user_name . "\\" . $copyOfAnnouncement->id . "\\" . $copyOfAnnouncement->image_name;
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);
        }
        if (file_exists($announcementDirPath)) {
            rmdir($announcementDirPath);
        }
        $count_elements = count(array_diff(scandir(storage_path('app/public') . "\\" . $copyOfAnnouncement->user_name), [".", ".."]));
        if ($count_elements === 0 && file_exists($userDirPath)) {
            rmdir(storage_path('app/public') . "\\" . $copyOfAnnouncement->user_name);
        }
    }
}
