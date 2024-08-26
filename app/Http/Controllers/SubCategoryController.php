<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller {

    public function index(Request $request){
        if ($request->ajax()) {
            $data = SubCategory::with('category')->orderBy('title')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function($row) {
                        return $row->category ? $row->category->title : 'N/A';
                    })
                    ->addColumn('action', function($row){
                            $btn = '
                            <div class="d-flex">
                                <a href="'.route('sub_category.edit', $row->id).'" class="edit btn btn-primary btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('manage.sub-category-list');
    }

    public function create(){
        $categories = Category::orderBy('title')->get();
        return view('manage.add-sub-category', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|unique:sub_categories,title',
            'category_id' => 'required|exists:categories,id',
        ]);
        $data = $request->all();        
        SubCategory::create($data);
        return redirect()->back()->with('success', 'Sub-category created successfully.');
    }

    public function edit(string $id){
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::orderBy('title')->get();
        return view('manage.edit-sub-category', compact('sub_category','categories'));
    }

    public function update(Request $request, string $id){
        $sub_category = SubCategory::findOrFail($id);
        
        $request->validate([
            'title' => [
            'required',
            'string',
                Rule::unique('sub_categories', 'title')->ignore($sub_category->id),
            ],
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $data = $request->all();
        $sub_category->update($data);
        return redirect()->back()->with('success', 'Sub-category updated successfully.');
    }

    public function destroy(string $id){
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();
        return response()->json(['success' => true]);
    }
}
