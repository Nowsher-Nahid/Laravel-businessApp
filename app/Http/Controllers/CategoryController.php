<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller {

    public function index(Request $request){
        if ($request->ajax()) {

            $data = Category::query()->orderBy('title')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
                        $url = $row->image ? asset($row->image) : asset('assets/images/categories/placeholder-image.png');
                        return '<img src="'.htmlspecialchars($url).'" alt="'.$row->title.'" height="40">';
                    })
                    ->addColumn('action', function($row){
                            $btn = '
                            <div class="d-flex">
                                <a href="'.route('category.edit', $row->id).'" class="edit btn btn-primary btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);
        }
        return view('manage.category-list');
    }

    public function create(){
        return view('manage.add-category');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable'
        ]);

        $data = $request->all();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/categories'), $imageName);
            $imagePath = 'assets/images/categories/' . $imageName;
            $data['image'] = $imagePath;
        }

        Category::create($data);
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function edit(string $id){
        $category = Category::findOrFail($id);
        return view('manage.edit-category', compact('category'));
    }

    public function update(Request $request, string $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $data = $request->all();

        if($request->hasFile('image')){
            if ($category->image && File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }
            
            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/categories'), $imageName);
            $imagePath = 'assets/images/categories/' . $imageName;
            $data['image'] = $imagePath;
        }

        $category->update($data);
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id){
        $category = Category::findOrFail($id);
        if ($category->image) {
            $imagePath = public_path($category->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $category->delete();
        return response()->json(['success' => true]);
    }
}
