<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Settings;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


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
        $galleries = Gallery::where('file', 0)->latest()->paginate(20);
        $files = Gallery::where('file', 1)->latest()->paginate(20);

        $year = verta()->year;
        $farvardin = Verta::parse($year . ' فروردین 1')->formatGregorian('Y-m-d H:i:s');
        $ordibehesht = Verta::parse($year . ' اردیبهشت 1')->formatGregorian('Y-m-d H:i:s');
        $khordad = Verta::parse($year . ' خرداد 1')->formatGregorian('Y-m-d H:i:s');
        $tir = Verta::parse($year . ' تیر 1')->formatGregorian('Y-m-d H:i:s');
        $mordad = Verta::parse($year . ' مرداد 1')->formatGregorian('Y-m-d H:i:s');
        $shahrivar = Verta::parse($year . ' شهریور 1')->formatGregorian('Y-m-d H:i:s');
        $mehr = Verta::parse($year . ' مهر 1')->formatGregorian('Y-m-d H:i:s');
        $aban = Verta::parse($year . ' آبان 1')->formatGregorian('Y-m-d H:i:s');
        $azar = Verta::parse($year . ' آذر 1')->formatGregorian('Y-m-d H:i:s');
        $dey = Verta::parse($year . ' دی 1')->formatGregorian('Y-m-d H:i:s');
        $bahman = Verta::parse($year . ' بهمن 1')->formatGregorian('Y-m-d H:i:s');
        $esfand = Verta::parse($year . ' اسفند 1')->formatGregorian('Y-m-d H:i:s');

        $farvardinGallery = Gallery::where('file', 0)->whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtGallery = Gallery::where('file', 0)->whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadGallery = Gallery::where('file', 0)->whereBetween('created_at', [$khordad, $tir])->count();
        $tirGallery = Gallery::where('file', 0)->whereBetween('created_at', [$tir, $mordad])->count();
        $mordadGallery = Gallery::where('file', 0)->whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarGallery = Gallery::where('file', 0)->whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrGallery = Gallery::where('file', 0)->whereBetween('created_at', [$mehr, $aban])->count();
        $abanGallery = Gallery::where('file', 0)->whereBetween('created_at', [$aban, $azar])->count();
        $azarGallery = Gallery::where('file', 0)->whereBetween('created_at', [$azar, $dey])->count();
        $deyGallery = Gallery::where('file', 0)->whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanGallery = Gallery::where('file', 0)->whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandGallery = Gallery::where('file', 0)->whereBetween('created_at', [$esfand, $farvardin])->count();

        $farvardinFile = Gallery::where('file', 1)->whereBetween('created_at', [$farvardin, $ordibehesht])->count();
        $ordibeheshtFile = Gallery::where('file', 1)->whereBetween('created_at', [$ordibehesht, $khordad])->count();
        $khordadFile = Gallery::where('file', 1)->whereBetween('created_at', [$khordad, $tir])->count();
        $tirFile = Gallery::where('file', 1)->whereBetween('created_at', [$tir, $mordad])->count();
        $mordadFile = Gallery::where('file', 1)->whereBetween('created_at', [$mordad, $shahrivar])->count();
        $shahrivarFile = Gallery::where('file', 1)->whereBetween('created_at', [$shahrivar, $mehr])->count();
        $mehrFile = Gallery::where('file', 1)->whereBetween('created_at', [$mehr, $aban])->count();
        $abanFile = Gallery::where('file', 1)->whereBetween('created_at', [$aban, $azar])->count();
        $azarFile = Gallery::where('file', 1)->whereBetween('created_at', [$azar, $dey])->count();
        $deyFile = Gallery::where('file', 1)->whereBetween('created_at', [$dey, $bahman])->count();
        $bahmanFile = Gallery::where('file', 1)->whereBetween('created_at', [$bahman, $esfand])->count();
        $esfandFile = Gallery::where('file', 1)->whereBetween('created_at', [$esfand, $farvardin])->count();

        return view('admin.galleries.index', compact(
            'galleries',
            'files',
            //Galleries
            'farvardinGallery',
            'ordibeheshtGallery',
            'khordadGallery',
            'tirGallery',
            'mordadGallery',
            'shahrivarGallery',
            'mehrGallery',
            'abanGallery',
            'azarGallery',
            'deyGallery',
            'bahmanGallery',
            'esfandGallery',
            //Files
            'farvardinFile',
            'ordibeheshtFile',
            'khordadFile',
            'tirFile',
            'mordadFile',
            'shahrivarFile',
            'mehrFile',
            'abanFile',
            'azarFile',
            'deyFile',
            'bahmanFile',
            'esfandFile',
        ));
    }

    public function getImages()
    {
        return Gallery::where('file', 0)->latest()->get();
    }

    public function getLastImage()
    {
        return Gallery::where('file', 0)->latest()->first();
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
            'user_id' => Auth::id(),
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
            return redirect(route('admin.galleries.index', 'tab=gallery'));
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

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|max:1000000',
        ]);

        $siteName = Settings::where('key', 'name')->pluck('value')->first();
        $file = $request->file('file');
        $type = $file->getClientOriginalExtension();
        $sizeFile = $file->getsize()/1000;
        if( $sizeFile > 1000){
            $size = round($sizeFile/1000 ,2) . 'MB';
        }else {
            $size = round($sizeFile) . 'KB';
        }
        if ($request['name']) {
            $name = $request['name'];
        }else{
            $name = $file->getClientOriginalName();
        }
        $fileName = ($siteName != '')?$siteName:env('APP_NAME').'_'.$name.'.'.$file->extension();
        $path = $file->move($_SERVER['DOCUMENT_ROOT'].'/uploads/files/' ,$fileName);
        Gallery::create([
            'user_id' => Auth::id(),
            'main_name' => $file->getClientOriginalName(),
            'name' => $fileName,
            'size' => $size,
            'type' => $type,
            'url' =>  '/uploads/files/' . $fileName ,
            'path' => $path->getRealPath(),
            'file' => 1,
        ]);
        return response()->json();
    }

    public function destroyFile($id)
    {
        $file = Gallery::findOrFail($id);
        if (File::exists($_SERVER['DOCUMENT_ROOT'].$file->url)) {
            $file->delete();
            File::delete($_SERVER['DOCUMENT_ROOT'].$file->url);
            return redirect(route('admin.galleries.index', 'tab=file'));
        }else{
            dd('file not exists');
        }
    }

    public function destroyAllFile(Request $request)
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


    public function ckeditorUpload(Request $request)
    {
        $siteName = Settings::where('key', 'name')->pluck('value')->first();
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = ($siteName != '')?$siteName:env('APP_NAME').'_'.time().'.'.$extension;
            $request->file('upload')->move($_SERVER['DOCUMENT_ROOT'].'/uploads/'.now()->year.'/', $fileName);
            $url = asset('uploads/'.now()->year.'/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
