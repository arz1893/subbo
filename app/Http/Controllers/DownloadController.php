<?php

namespace App\Http\Controllers;

use App\Album;
use App\User;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DownloadController extends Controller
{
    public function showDownload(Album $album) {

        $albumCreator = User::findOrFail($album->user_id);

        if(!file_exists(public_path('zippedfile/') . $albumCreator->email)) {
            File::makeDirectory(public_path('zippedfile') . '/' . $albumCreator->email);
        }

        $images = $album->images()->get();
        $zipper = new Zipper();
        $zipper->make(public_path('zippedfile/' . $albumCreator->email . '/' ) . $album->title . '.zip');

        foreach ($images as $image) {
            $zipper->add(public_path($image->path));
        }

        $zipper->close();

        return view('download.download_page', compact('album'));
    }

    public function downloadAlbum(Request $request) {
        $downloadedAlbum = Album::findOrFail($request->album_id);
        $albumCreator = User::findOrFail($downloadedAlbum->user_id);
        return response()->download(public_path('zippedfile/' . $albumCreator->email . '/') . $downloadedAlbum->title . '.zip');
    }
}
