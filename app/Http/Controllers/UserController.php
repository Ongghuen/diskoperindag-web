<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bantuan;
use App\Models\Alat;
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
        $tl = Carbon::parse($request->tanggal_lahir);
        $umur = $tl->diffInYears(Carbon::now());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->NIK = $request->NIK;
        $user->kepala_keluarga = $request->kepala_keluarga;
        $user->alamat = $request->alamat;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->umur = $umur;
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

        return redirect('/detail-user-bantuan/' . $user);
    }

    public function detailuserbantuan($id)
    {
        $user = User::with(['role', 'bantuan.itemBantuan', 'pelatihan', 'sertifikat'])
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

    public function nolDuaPuluh(Request $request){
        $keyword = $request->keyword;

        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->whereBetween('umur', ['0', '20'])
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

    public function duaSatuTigaPuluh(Request $request){
        $keyword = $request->keyword;

        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->whereBetween('umur', ['21', '30'])
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

    public function tigaSatuEmpatPuluh(Request $request){
        $keyword = $request->keyword;

        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->whereBetween('umur', ['31', '40'])
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

    public function empatSatuLimaPuluh(Request $request){
        $keyword = $request->keyword;

        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->whereBetween('umur', ['41', '50'])
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

    public function limaSatuPlus(Request $request){
        $keyword = $request->keyword;

        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->whereBetween('umur', ['50', '200'])
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
}
