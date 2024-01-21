<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:tag-list|tag-create|tag-edit|tag-delete', ['only' => ['index','show']]);
        $this->middleware('permission:tag-create', ['only' => ['create','store']]);
        $this->middleware('permission:tag-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tag-delete', ['only' => ['destroy']]);*/
    }

    public function index(Request $request)
    {
        if($request->has('search')){
            $tags = Tag::where('name', 'like', '%'.$request->get('search').'%')->paginate(20);
        }else{
            $tags = Tag::latest()->paginate(20);
        }
        return view('admin.taxonomy.tags.index', compact('tags'));
    }

    public function create()
    {
        //return view('admin.taxonomy.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Tag::create([
            'name' => $request->name,
            'slug' => $request->slug ?: $request->name,
            'type' => $request->type,
            'image' => $request->image,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc
        ]);
        return response()->json();
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        //return view('admin.taxonomy.tags.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.taxonomy.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return redirect(route('admin.tags.index'))->with('success', 'با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect(route('admin.tags.index'))->with('success', 'با موفقیت حذف شد.');
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("tags")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
