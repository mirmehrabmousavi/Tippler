<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $search = $request->search;;
        if($request->search){
            $faqs = Faq::where(function ($query) use($search) {
                $query->where('search', $search)
                    ->orWhere('id', $search);
            })->latest()->paginate(50);
        }else{
            $faqs = Faq::latest()->paginate(50);
        }
        return view('admin.faqs.index',compact('faqs'));
    }

    public function create(){
        return view('admin.faqs.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'description' => 'required',
        ]);
        $faq = Faq::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return response()->json();
    }

    public function edit(Faq $faq){
        $faq = Faq::where('id', $faq->id)->first();
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Faq $faq,Request $request){
        $request->validate([
            'title' => 'required|max:220',
            'description' => 'required',
        ]);
        $faq = $faq->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return response()->json();
    }

    public function destroy(Faq $faq){
        $faq->delete();
        return redirect()->back()->with('success', 'سوال با موفقیت حذف شد');
    }

    public function destroyAll(Request $request){
        $ids = $request->ids;
        DB::table("faqs")->whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success'=>"FAQs Deleted successfully."]);
    }
}
