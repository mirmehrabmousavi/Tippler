<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','show']]);
        $this->middleware('permission:page-create', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);*/
    }

    public function index(Request $request)
    {
        if($request->has('search')){
            $pages = Page::where('title', 'like', '%'.$request->get('search').'%')
                ->orWhere('slug', 'like', '%'.$request->get('search').'%')
                ->paginate(20);
        }else{
            $pages = Page::latest()->paginate(20);
        }
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $tags = Tag::where('type', 'page')->get();
        return view('admin.pages.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $page = Page::create([
            'title' => $request->title,
            'image' => $request->image,
            'slug' => $request->slug,
            'content' => $request['content'],
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc,
        ]);
        $page->tags()->sync(json_decode($request->tags));
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $tags = Tag::where('type', 'page')->get();
        $selectedTags = $page->tags()->pluck('tags.id')->toArray();
        return view('admin.pages.edit', compact('page', 'tags', 'selectedTags'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update([
            'title' => $request->title,
            'image' => $request->image,
            'slug' => $request->slug,
            'content' => $request['content'],
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc,
        ]);
        $page->tags()->sync(json_decode($request->tags));
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect(route('admin.pages.index'));
    }

    public function confirm($id)
    {
        $page = Page::findOrFail($id);
        $page->publish = 1;
        $page->save();

        return redirect(route('admin.pages.index'));
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("pages")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Pages Deleted successfully."]);
    }
}
