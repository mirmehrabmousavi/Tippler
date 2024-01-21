<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class  GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', ['only' => ['index','show']]);
        $this->middleware('permission:gallery-create', ['only' => ['create','store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);*/
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(20);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function getImages()
    {
        return Gallery::latest()->get();
    }

    public function getLastImage()
    {
        return Gallery::latest()->first();
    }

    public function upload(Request $request)
    {
        $siteName = Settings::where('key', 'name')->pluck('value')->first();
        $image = $request->file('file');
        $type = $image->getClientOriginalExtension();
        $sizeFile = $image->getsize()/1000;
        if( $sizeFile > 1000){
            $size = round($sizeFile/1000 ,2) . 'MB';
        }else {
            $size = round($sizeFile) . 'KB';
        }
        $imageName = ($siteName != '')?$siteName:env('APP_NAME').'_'.time().'.'.$image->extension();
        $path = $image->move($_SERVER['DOCUMENT_ROOT'].'/uploads/' ,$imageName);
        Gallery::create([
            'main_name' => $image->getClientOriginalName(),
            'name' => $imageName,
            'size' => $size,
            'type' => $type,
            'url' =>  '/uploads/' . $imageName ,
            'path' => $path->getRealPath(),
        ]);
        return response()->json(['success'=>$imageName]);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if (File::exists($_SERVER['DOCUMENT_ROOT'].$gallery->url)) {
            $gallery->delete();
            File::delete($_SERVER['DOCUMENT_ROOT'].$gallery->url);
            return redirect(route('admin.galleries.index'));
        }else{
            dd('file not exists');
        }
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        $galleries = Gallery::whereIn('id', explode(",", $ids))->get();
        foreach ($galleries as $gallery) {
            $filePath = $_SERVER['DOCUMENT_ROOT'].$gallery->url;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $gallery->delete();
        }
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
