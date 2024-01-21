<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mag;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagController extends  Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:mag-list|mag-create|mag-edit|mag-delete', ['only' => ['index','show']]);
        $this->middleware('permission:mag-create', ['only' => ['create','store']]);
        $this->middleware('permission:mag-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:mag-delete', ['only' => ['destroy']]);*/
    }

    public function index(Request $request)
    {
        if($request->has('search')){
            $mags = Mag::where('title', 'like', '%'.$request->get('search').'%')
                            ->orWhere('slug', 'like', '%'.$request->get('search').'%')
                            ->orWhere('tags', 'like', '%'.$request->get('search').'%')
                            ->paginate(20);
        }else{
            $mags = Mag::latest()->paginate(20);
        }
        return view('admin.mags.index', compact('mags'));
    }

    public function create()
    {
        $categories = Category::where('type', 'mag')->get();
        $tags = Tag::where('type', 'mag')->get();
        return view('admin.mags.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        Mag::create($request->all());
        return response()->json();
    }

    public function show($id)
    {
        $mag = Mag::findOrFail($id);
        return view('admin.mags.show', compact('mag'));
    }

    public function edit($id)
    {
        $mag = Mag::findOrFail($id);
        $selectedCategories = array($mag->category);
        $categories = Category::where('type', 'mag')->get();
        $tags = Tag::where('type', 'mag')->get();
        return view('admin.mags.edit', compact('mag', 'categories', 'tags', 'selectedCategories'));
    }

    public function update(Request $request, $id)
    {
        $mag = Mag::findOrFail($id);
        $mag->update($request->all());
        return response()->json();
    }

    public function destroy($id)
    {
        $mag = Mag::findOrFail($id);
        $mag->delete();
        return redirect(route('admin.mags.index'))->with('success', 'با موفقیت حذف شد.');
    }

    public function confirm($id)
    {
        $mag = Mag::findOrFail($id);
        $mag->publish = 1;
        $mag->save();

        return redirect(route('admin.mags.index'))->with('success', 'با موفقیت منتشر شد.');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("mags")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Mags Deleted successfully."]);
    }
}
