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
        $mag = Mag::create([
            'title' => $request->title,
            'image' => $request->image,
            'slug' => $request->slug,
            'content' => $request['content'],
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc,
        ]);
        $mag->categories()->sync(json_decode($request->category));
        $mag->tags()->sync(json_decode($request->tags));
    }

    public function show($id)
    {
        $mag = Mag::findOrFail($id);
        return view('admin.mags.show', compact('mag'));
    }

    public function edit($id)
    {
        $mag = Mag::findOrFail($id);
        $categories = Category::where('type', 'mag')->get();
        $selectedCats = $mag->categories()->pluck('categories.id')->toArray();
        $tags = Tag::where('type', 'mag')->get();
        $selectedTags = $mag->tags()->pluck('tags.id')->toArray();
        return view('admin.mags.edit', compact('mag', 'categories', 'tags', 'selectedCats', 'selectedTags'));
    }

    public function update(Request $request, $id)
    {
        $mag = Mag::findOrFail($id);
        $mag->update([
            'title' => $request->title,
            'image' => $request->image,
            'slug' => $request->slug,
            'content' => $request['content'],
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc,
        ]);
        $mag->categories()->sync(json_decode($request->categories));
        $mag->tags()->sync(json_decode($request->tags));
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
