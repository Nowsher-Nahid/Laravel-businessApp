<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Listing;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller {

    public function index(Request $request){
        if ($request->ajax()) {
            if (Auth::user()->role === 0) {
                $data = Listing::query()
                    ->orderBy('created_at', 'desc')
                    ->get();
            }else {
                $data = Listing::query()
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function($row) {
                        return $row->category ? $row->category->title : 'N/A';
                    })
                    ->addColumn('sub_category', function($row) {
                        return $row->subCategory  ? $row->subCategory->title : 'N/A';
                    })
                    ->addColumn('action', function($row){
                            $btn = '
                            <div class="d-flex">
                                <a href="'.route('listing.edit', $row->id).'" class="edit btn btn-primary btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('manage.listing-list');
    }

    public function create(){
        $countries = Country::all();
        $categories = Category::orderBy('title')->get();
        return view('manage.add-listing', compact('countries','categories'));
    }

    public function fetchStates(Request $request){
        $countryId = $request->input('country_id');
        $states = State::where('country_id', $countryId)->get();
        $str_options = "<option value=''>Select State</option>";
        foreach($states as $state){
            $str_options .= "<option value='$state->id'>$state->name</option>";
        }
        return response()->json($str_options);
    }

    public function fetchCities(Request $request){
        $stateId = $request->input('state_id');
        $cities = City::where('state_id', $stateId)->pluck('city');
        $str_options = "<option value=''>Select City</option>";
        foreach($cities as $city){
            $str_options .= "<option value='$city'>$city</option>";
        }
        return response()->json($str_options);
    }

    public function fetchSubCategories(Request $request){
        $category_id = $request->input('category_id');
        $sub_categories = SubCategory::where('category_id', $category_id)->get();
        $str_options = "<option value=''>Select Sub-category</option>";
        foreach($sub_categories as $sub_category){
            $str_options .= "<option value='$sub_category->id'>$sub_category->title</option>";
        }
        return response()->json($str_options);
    }

    public function store(Request $request){
        $request->validate([
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'company' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'services' => 'nullable|string',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ft_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $country = Country::findOrFail($request->country);
        $data['country'] = $country->name;
        $state = State::findOrFail($request->state);
        $data['state'] = $state->name;
        $data['user_id'] = Auth::id();

        // Handle featured image upload
        if ($request->hasFile('ft_image')) {
            $image = $request->file('ft_image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/listings'), $imageName);
            $imagePath = 'assets/images/listings/' . $imageName;
            $data['ft_image'] = $imagePath;
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery')) {
            $galleryImages = [];
            foreach ($request->file('gallery') as $image) {
                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/listings'), $imageName);
                $imagePath = 'assets/images/listings/' . $imageName;
                $galleryImages[] = $imagePath;
            }
            $data['gallery'] = json_encode($galleryImages);
        }

        Listing::create($data);
        return redirect()->back()->with('success', 'Listing created successfully.');
    }

    public function edit(string $id){
        $listing = Listing::findOrFail($id);
        $countries = Country::all();
        $categories = Category::all();

        $sub_categories = SubCategory::where('category_id', $listing->category_id)->get();

        $country_id = Country::where('name', $listing->country)->first();
        $states = State::where('country_id', $country_id->id)->get();

        $state_id = State::where('name', $listing->state)->first();
        $cities = City::where('state_id', $state_id->id)->get();

        return view('manage.edit-listing', compact('listing','countries','states','cities','categories','sub_categories','country_id','state_id'));
    }

    public function update(Request $request, string $id){
        $request->validate([
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'company' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'services' => 'nullable|string',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ft_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $listing = Listing::findOrFail($id);
        $data = $request->all();

        $country = Country::findOrFail($request->country);
        $data['country'] = $country->name;
        $state = State::findOrFail($request->state);
        $data['state'] = $state->name;

        // Handle featured image upload
        if ($request->hasFile('ft_image')) {
            $image = $request->file('ft_image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/listings'), $imageName);
            $imagePath = 'assets/images/listings/' . $imageName;
            $data['ft_image'] = $imagePath;
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery')) {
            $galleryImages = [];
            foreach ($request->file('gallery') as $image) {
                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/listings'), $imageName);
                $imagePath = 'assets/images/listings/' . $imageName;
                $galleryImages[] = $imagePath;
            }
            $data['gallery'] = json_encode($galleryImages);
        }

        $listing->update($data);
        return redirect()->back()->with('success', 'Listing updated successfully.');
    }

    public function destroy(string $id){
        $listing = Listing::findOrFail($id);
        if ($listing->ft_image) {
            $imagePath = public_path($listing->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $listing->delete();
        return response()->json(['success' => true]);
    }
}
