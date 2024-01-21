<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        /*$this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);*/
    }

    public function index(Request $request)
    {
        $info = [
            'productCategories' => Category::where(['parent_id' => 0])->where('type', 'product')->orderBy('sort_order', 'ASC')->get(),
            'magCategories' => Category::where(['parent_id' => 0])->where('type', 'mag')->orderBy('sort_order', 'ASC')->get(),
        ];

        return view('admin.taxonomy.categories.index', $info);
    }

    public function saveNestedCategories(Request $request){

        $json = $request->nested_category_array;
        $decoded_json = json_decode($json, TRUE);

        $simplified_list = [];
        $this->recur1($decoded_json, $simplified_list);

        DB::beginTransaction();
        try {
            $info = [
                "success" => FALSE,
            ];

            foreach($simplified_list as $k => $v){
                $category = Category::find($v['id']);
                $category->fill([
                    "parent_id" => $v['parent_id'],
                    "sort_order" => $v['sort_order'],
                ]);

                $category->save();
            }

            DB::commit();
            $info['success'] = TRUE;
        } catch (\Exception $e) {
            DB::rollback();
            $info['success'] = FALSE;
        }

        if($info['success']){
            $request->session()->flash('success', "All Categories updated.");
        }else{
            $request->session()->flash('error', "Something went wrong while updating...");
        }

        return redirect(route('admin.categories.index'));
    }

    public function recur1($nested_array=[], &$simplified_list=[]){

        static $counter = 0;

        foreach($nested_array as $k => $v){

            $sort_order = $k+1;
            $simplified_list[] = [
                "id" => $v['id'],
                "parent_id" => 0,
                "sort_order" => $sort_order
            ];

            if(!empty($v["children"])){
                $counter+=1;
                $this->recur2($v['children'], $simplified_list, $v['id']);
            }

        }
    }

    public function recur2($sub_nested_array=[], &$simplified_list=[], $parent_id = NULL){

        static $counter = 0;

        foreach($sub_nested_array as $k => $v){

            $sort_order = $k+1;
            $simplified_list[] = [
                "id" => $v['id'],
                "parent_id" => $parent_id,
                "sort_order" => $sort_order
            ];

            if(!empty($v["children"])){
                $counter+=1;
                return $this->recur2($v['children'], $simplified_list, $v['id']);
            }
        }
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.taxonomy.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?: $request->name,
            'parent_id' => (!empty($request->parent_id))? $request->parent_id : 0,
            'type' => $request->type,
            'image' => $request->image,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_desc' => $request->meta_desc
        ]);
        return response()->json();
    }

    public function edit($id){
        $categories = Category::orderBy('name', 'ASC')->get();
        $category = Category::find($id);
        return view('admin.taxonomy.categories.edit', compact('categories', 'category'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
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

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();

        return redirect(route('admin.categories.index'))->with('success', "Category removed successfully.");
    }
}
