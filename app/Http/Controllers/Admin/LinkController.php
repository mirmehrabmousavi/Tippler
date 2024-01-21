<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Link::create($request->all());
        return response()->json();
    }

    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return redirect(route('admin.settings.index', ['tab=links']))->with('success', 'با موفقیت حذف شد.');
    }
}
