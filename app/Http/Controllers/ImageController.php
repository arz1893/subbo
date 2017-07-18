<?php

namespace App\Http\Controllers;

use App\Album;
use App\Image;
use App\ImageThumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $album = Album::findOrFail($request->album_id);
        $file_images = Input::file('images');

        if(!is_null($file_images)) {
            foreach ($file_images as $file_image) {
                $uploadImage = new Image();
                $uploadImage->file_name = $album->id . '_' . $file_image->getClientOriginalName();
                $uploadImage->size = $file_image->getClientSize();
                $uploadImage->alias = $file_image->getClientOriginalName();
                $uploadImage->album_id = $album->id;

                $interventionImage = ImageManagerStatic::make($file_image->getRealPath());
                $interventionImage->save(public_path('image_thumbnails/').'thumb_'.$uploadImage->file_name, 60);

                $imageThumbnail = new ImageThumbnail();
                $imageThumbnail->thumbnail_name = 'thumb_' . $uploadImage->file_name;
                $imageThumbnail->thumbnail_size = $interventionImage->filesize();
                $imageThumbnail->album_id = $album->id;
                $imageThumbnail->alias = $file_image->getClientOriginalName();
                $uploadImage->save();
                $imageThumbnail->image_id = $uploadImage->id;

                $file_image->move('uploaded_images', $uploadImage->file_name);
                $imageThumbnail->save();
            }
        }

        return redirect()->route('album.show', $request->album_id);
    }

    public function getPictureName(Request $request) {
        if($request->json()) {
            $imageThumbnail = DB::table('image_thumbnails')->where('id', $request->pict_id)->first();
            return response()->json($imageThumbnail);
        }
        return null;
    }

    public function setAlbumCover(Request $request) {
        if($request->json()) {
            $imageThumbnail = ImageThumbnail::findOrFail($request->pict_id);
            $album = Album::findOrFail($imageThumbnail->album_id);

            $album->album_cover_id = $imageThumbnail->id;
            $album->update();

            return response()->json("success");
        }
        return "failed";
    }

    public function deleteImage(Request $request) {
        if($request->json()) {
            $imageThumbnail = ImageThumbnail::findOrFail($request->image_id);
            $image = Image::findOrFail($imageThumbnail->image_id);
            unlink(public_path('/image_thumbnails/'.$imageThumbnail->thumbnail_name));
            unlink(public_path('/uploaded_images/'.$image->file_name));
            $imageThumbnail->delete();
            return response()->json();
        }
        return "failed";
    }
}
