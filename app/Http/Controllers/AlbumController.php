<?php

namespace App\Http\Controllers;

use App\Album;
use App\Category;
use App\Http\Requests\AlbumRequest;
use App\Image;
use App\ImageThumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;
use Webpatser\Uuid\Uuid;

class AlbumController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

        if($request->session()->get('operating_system') != null) {
            $request->session()->forget('operating_system');
        }

        $latestNullAlbums = Album::where('title', null)->where('user_id', Auth::user()->id)->get();
        if($latestNullAlbums != null) {
            foreach ($latestNullAlbums as $latestNullAlbum) {
                if(file_exists(public_path('uploaded_images/' . Auth::user()->email . '/' . $latestNullAlbum->id))) {
                    File::deleteDirectory(public_path('uploaded_images/' . Auth::user()->email . '/' . $latestNullAlbum->id));
                }
                if(file_exists(public_path('image_thumbnails/' . Auth::user()->email . '/' . $latestNullAlbum->id))) {
                    File::deleteDirectory(public_path('image_thumbnails/' . Auth::user()->email . '/' . $latestNullAlbum->id));
                }
                $latestNullAlbum->delete();
            }
        }
        $user = Auth::user();
        $host = $request->getHttpHost();
        $albums = Album::where('user_id', Auth::user()->id)->where('is_deleted', 0)->orderBy('created_at', 'desc')->paginate(6);
        $imageThumbnails = ImageThumbnail::all();
        return view('album.albumindex', compact('albums', 'images', 'imageThumbnails', 'user', 'host'));
    }

    public function createAlbumFirst() {
        $album = Album::create([
            'id' => Uuid::generate(5, Auth::user()->email . date('h:i:s'), Uuid::NS_DNS),
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('create_album', $album);
    }

    public function create(Request $request, Album $album) {
        $os = $request->session()->get('operating_system');
        $currency = Auth::user()->currency;
        $categories = Category::all('category_name', 'id');

//        $latestNullAlbums = Album::where('title', null)->where('user_id', Auth::user()->id)->get();
//        if($latestNullAlbums != null) {
//            foreach ($latestNullAlbums as $latestNullAlbum) {
//                $latestNullAlbum->delete();
//                if(file_exists(public_path('uploaded_images/' . Auth::user()->email . '/' . $latestNullAlbum->id))) {
//                    File::deleteDirectory(public_path('uploaded_images/' . Auth::user()->email . '/' . $latestNullAlbum->id), true);
//                }
//                if(file_exists(public_path('image_thumbnails/' . Auth::user()->email . '/' . $latestNullAlbum->id))) {
//                    File::deleteDirectory(public_path('image_thumbnails/' . Auth::user()->email . '/' . $latestNullAlbum->id));
//                }
//            }
//        }

        if($os != null) {
            if($os == 'iOS') {
                return view('album.ios_upload_page', compact('categories', 'album', 'currency'));
            }
        }

        return view('album.addalbum', compact('categories', 'album', 'currency'));
    }

    public function store(Request $request) {


        $messsages = array(
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'category_list.required' => 'Album Category is required',
        );

        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_list' => 'required',
        );

        $validator = Validator::make($request->all(), $rules, $messsages);


        if($validator->fails()){
            $album = Album::findOrFail($request->id);
            $images = $album->images()->get();
            $imageThumbnails = $album->image_thumbnails()->get();

            foreach ($images as $image) {
                $image->delete();
            }

            foreach ($imageThumbnails as $imageThumbnail) {
                $imageThumbnail->delete();
            }

            if(file_exists(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->id))) {
                File::deleteDirectory(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->id));
            }
            if(file_exists(public_path('image_thumbnails/' . Auth::user()->email . '/' . $request->id))) {
                File::deleteDirectory(public_path('image_thumbnails/' . Auth::user()->email . '/' . $request->id));
            }

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $album = Album::findOrFail($request->id);
        $album->title = $request->title;
        $album->description = $request->description;
        $album->price = $request->price;
        $album->categories()->sync($request->input('category_list'));
        $album->save();

        return redirect()->route('choose_album_cover', $album);
    }

    public function chooseAlbumCoverPage(Album $album) {
        $imageThumbnails = $album->image_thumbnails()->get();
        return view('album.choose_album_cover', compact('imageThumbnails', 'album'));
    }

    public function applyAlbumCover(Request $request, Album $album) {
        $this->validate($request, [
            'image_cover_id' => 'required'
        ]);

        $album->album_cover_id = $request->image_cover_id;
        $album->is_published = 1;
        $album->save();

        return redirect()->route('album.show', $album->id);
    }

//    public function uploadImagePage(Album $album) {
//        return view('album.upload_image_page', compact('album'));
//    }

    public function uploadAllImages(Request $request) {
//        dd($request->all());
        $image = $request->file('file');
        if(!is_null($image)) {
            $filename = $request->album_id . '_' . $image->getClientOriginalName();

            $uploadedImage = Image::create([
                'file_name' => $filename,
                'size' => $image->getClientSize(),
                'path' => 'uploaded_images/' . Auth::user()->email . '/' . $request->album_id . '/' . $filename,
                'alias' => $image->getClientOriginalName(),
                'album_id' => $request->album_id
            ]);

            if(!File::exists(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->album_id))) {
                mkdir(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->album_id), 0777, true);
                $image->move(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->album_id . '/'), $filename);
            } else {
                $image->move(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->album_id . '/'), $filename);
            }

            if(!File::exists(public_path('image_thumbnails/' . Auth::user()->email . '/' . $request->album_id))) {
                mkdir(public_path('image_thumbnails/' . Auth::user()->email . '/' . $request->album_id), 0777, true);

                $interventionImage = ImageManagerStatic::make(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->album_id . '/' . $filename));
                $interventionImage->save(public_path('image_thumbnails/' . Auth::user()->email . '/' . $request->album_id . '/') . 'thumb_' . $filename, 60);
            } else {
                $interventionImage = ImageManagerStatic::make(public_path('uploaded_images/' . Auth::user()->email . '/' . $request->album_id . '/' . $filename));
                $interventionImage->save(public_path('image_thumbnails/' . Auth::user()->email . '/' . $request->album_id . '/') . 'thumb_' . $filename, 60);
            }

            ImageThumbnail::create([
                'thumbnail_name' => 'thumb_' . $filename,
                'thumbnail_size' => $interventionImage->filesize(),
                'thumbnail_path' => 'image_thumbnails/' . Auth::user()->email . '/' . $request->album_id . '/' . 'thumb_' . $filename,
                'alias' => $image->getClientOriginalName(),
                'image_id' => $uploadedImage->id,
                'album_id' => $request->album_id,
                'user_id' => Auth::user()->id
            ]);
        }
        return response()->json('success', 200);
    }

    public function update(Album $album, AlbumRequest $request) {
        $album->update($request->all());
        if(!is_null($request->category_list)) {
            $album->categories()->sync($request->input('category_list'));
        }
        return redirect()->route('album.show', $album->id);
    }

    public function show(Album $album) {
        $imageThumbnails = ImageThumbnail::where('album_id', $album->id)->get();
        $currency = Auth::user()->currency;
        return view('album.showalbum', compact('album', 'imageThumbnails', 'currency'));
    }

    public function edit(Album $album) {
        $categories = Category::pluck('category_name', 'id');
        $selectedCategories = $album->categories()->get();
        return view('album.editalbum', compact('album', 'categories', 'selectedCategories'));
    }

    public function destroy(Album $album) {
        $images = Image::where('album_id', $album->id)->get();
        $imageThumbnails = ImageThumbnail::all();
        foreach ($images as $image) {
            if(file_exists(public_path('uploaded_images/' . Auth::user()->email . '/' . $album->id . '/' . $image->image_name))) {
                unlink(public_path('uploaded_images/' . Auth::user()->email . '/' . $album->id . '/' . $image->image_name));
            }
            foreach ($imageThumbnails as $imageThumbnail) {
                if($image->id == $imageThumbnail->image_id) {
                    if(file_exists(public_path('image_thumbnails/' . Auth::user()->email . '/' . $album->id . '/' . $imageThumbnail->thumbnail_name))) {
                        unlink(public_path('image_thumbnails/' . Auth::user()->email . '/' . $album->id . '/' . $imageThumbnail->thumbnail_name));
                    }
                }
            }
        }
        File::deleteDirectory(public_path('/uploaded_images/' . Auth::user()->email . '/' . $album->id));
        File::deleteDirectory(public_path('/image_thumbnails/' . Auth::user()->email . '/' . $album->id));

        $album->delete();
        return redirect('album');
    }

    public function deleteAlbum(Request $request) {
        if($request->json()) {
            $album = Album::findOrFail($request->album_id);

            $album->is_deleted = 1;
            $album->save();
            return response()->json();
        }
        return null;
    }

    public function getAlbumName(Request $request) {
        if ($request->json()) {
//            $album = Album::findOrFail($request->album_id);
            $album = DB::table('albums')->where('id', $request->album_id)->first();
            return response()->json($album->title);
        }
        return null;
    }

    public function publishAlbum(Request $request) {
        if ($request->json()) {
            $album = Album::findOrFail($request->album_id);
            $album->is_published = 1;
            $album->save();

            return response()->json($request->album_id);
        }
        return null;
    }

    public function unpublishAlbum(Request $request) {
        if($request->json()) {
            $album = Album::findOrFail($request->album_id);
            $album->is_published = 0;
            $album->save();
            return response()->json($request->album_id);
        }
        return null;
    }

    public function operatingSystemDetection(Request $request) {
        if($request->os = 'iOS') {
            $request->session()->put('operating_system', 'iOS');
        }
        return response()->json('success', 200);
    }
}
