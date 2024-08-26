<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use Yajra\DataTables\DataTables;

class BusinessOwnerController extends Controller {

    public function index(Request $request){
        if ($request->ajax()) {
            $userIds = Listing::distinct()->pluck('user_id');
            $users = User::whereIn('id', $userIds)->where('role', '!=', 0)->get();
            return Datatables::of($users)
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
        return view('manage.owner-list');
    }

    public function destroy(string $id){
        $owner = User::findOrFail($id);
        $owner->delete();
        return response()->json(['success' => true]);

    }
}
