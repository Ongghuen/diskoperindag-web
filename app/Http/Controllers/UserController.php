<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $user = User::with('role')
                ->where(function ($query) use($keyword){
                    $query
                    ->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('NIK', 'LIKE', '%'.$keyword.'%');
                })
                ->whereHas('role', function($query) use($keyword){
                    $query
                    ->where('name', 'User');
                })
                ->paginate(10);

        return view('pages.user', ['userList' => $user]);
    }

    public function store(Request $request)
    {
        $user = new User;
        $password = bcrypt($request->password);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->NIK = $request->NIK;
        $user->alamat = $request->alamat;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->save();

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data user berhasil!');
        }

        return redirect('/user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data user berhasil dihapus!');
        }

        return redirect('/user');
    }
}
