<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bantuan;
use App\Models\ItemBantuan;
use App\Models\UsersBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%');
            })
            ->whereHas('role', function ($query) use ($keyword) {
                $query
                    ->where('name', 'User');
            })
            ->sortable()
            ->paginate(10);




        return view(
            'pages.user',
            [
                'userList' => $user,

            ]
        );
    }

    public function storeView()
    {
        return view('pages.user-add');
    }

    public function store(Request $request)
    {
        $user = new User;
        $password = bcrypt($request->password);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->NIK = $request->NIK;
        $user->kepala_keluarga = $request->kepala_keluarga;
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

    public function updateView($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user-edit', ['item' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        if ($user) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data user berhasil diubah!');
        }

        return redirect('/user');
    }

    public function addBantuan($id)
    {
        $user = User::findOrFail($id);

        return view('pages.addBantuan', ['user' => $user]);
    }

    public function storeBantuan(Request $request)
    {
        $data = new Bantuan;
        $user = $request->user_id;

        $data->create($request->all());

        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Bantuan berhasil ditambahkan!');
        }

        return redirect('/detail-user-bantuan/' . $user);
    }

    public function detailuserbantuan($id)
    {
        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->where('id', '=', $id)
            ->first();

        return view('pages.detail-user-bantuan', ['item' => $user]);
    }

    public function deleteBantuan($id)
    {
        $data = Bantuan::findOrFail($id);
        $data->delete();

        return back();
    }
}
