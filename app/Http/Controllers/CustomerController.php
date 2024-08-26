<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller{

    public function index(Request $request){
        if ($request->ajax()) {
            $data = User::query()->where('role', 1)->orderBy('name')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '
                            <div class="d-flex">
                                <button class="delete btn btn-danger btn-sm" data-id="'.$row->id.'"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('manage.customer-list');
    }

    public function edit(){
        return view('manage.edit-customer');
    }

    public function update(Request $request, string $id){
        //
    }

    public function destroy(string $id){
        $customer = User::findOrFail($id);
        $customer->delete();
        return response()->json(['success' => true]);
    }
}
