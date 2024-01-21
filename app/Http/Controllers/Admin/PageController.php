<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
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
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        Page::create($request->all());
        return response()->json();
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update($request->all());
        return response()->json();
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
