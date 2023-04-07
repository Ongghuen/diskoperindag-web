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
        $request->validate(
            [
                'name' => 'required|max:30|min:5|string',
                'password' => 'required|max:30|min:5|string',
                'email' => 'required|email|max:50',
                'NIK' => 'required|numeric|min:15|max:17',
                'address' => 'required|max:100',
                'phone' => 'required|numeric|min:10|max:15',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|max:30',

            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'password.max' => 'Password tidak boleh lebih dari 30 karakter',
                'password.min' => 'Password tidak boleh kurang dari 5 karakter',
                'password.string' => 'Password harus berupa huruf',
                'name.max' => 'Nama tidak boleh lebih dari 30 karakter',
                'name.min' => 'Nama tidak boleh kurang dari 5 karakter',
                'name.string' => 'Nama harus berupa huruf',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter',
                'NIK.required' => 'NIK tidak boleh kosong',
                'NIK.numeric' => 'NIK harus berupa angka',
                'NIK.min' => 'NIK tidak boleh kurang dari 15 karakter',
                'NIK.max' => 'NIK tidak boleh lebih dari 17 karakter',
                'address.required' => 'Alamat tidak boleh kosong',
                'address.max' => 'Alamat tidak boleh lebih dari 100 karakter',
                'phone.required' => 'Nomor telepon tidak boleh kosong',
                'phone.numeric' => 'Nomor telepon harus berupa angka',
                'phone.min' => 'Nomor telepon tidak boleh kurang dari 10 karakter',
                'phone.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 30 karakter',

            ],
        );

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

        $request->validate(
            [
                'name' => 'required|max:30|min:5|string',
                'email' => 'required|email|max:50',
                'NIK' => 'required|numeric|min:15|max:17',
                'address' => 'required|max:100',
                'phone' => 'required|numeric|min:10|max:15',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|max:30',

            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh lebih dari 30 karakter',
                'name.min' => 'Nama tidak boleh kurang dari 5 karakter',
                'name.string' => 'Nama harus berupa huruf',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter',
                'NIK.required' => 'NIK tidak boleh kosong',
                'NIK.numeric' => 'NIK harus berupa angka',
                'NIK.min' => 'NIK tidak boleh kurang dari 15 karakter',
                'NIK.max' => 'NIK tidak boleh lebih dari 17 karakter',
                'address.required' => 'Alamat tidak boleh kosong',
                'address.max' => 'Alamat tidak boleh lebih dari 100 karakter',
                'phone.required' => 'Nomor telepon tidak boleh kosong',
                'phone.numeric' => 'Nomor telepon harus berupa angka',
                'phone.min' => 'Nomor telepon tidak boleh kurang dari 10 karakter',
                'phone.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 30 karakter',

            ],
        );

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
        $request->validate(
            [
                'nama_bantuan' => 'required|max:50',
                'jenis_usaha' => 'required|max:50',
                'tanggal_pemberian' => 'required|date',
                'koordinator' => 'required|max:50',
                'sumber_anggaran' => 'required|max:50',
            ],
            [
                'nama_bantuan.required' => 'Nama bantuan tidak boleh kosong!',
                'nama_bantuan.max' => 'Nama bantuan maksimal 50 karakter!',
                'jenis_usaha.required' => 'Jenis usaha tidak boleh kosong!',
                'jenis_usaha.max' => 'Jenis usaha maksimal 50 karakter!',
                'tanggal_pemberian.required' => 'Tanggal pemberian tidak boleh kosong!',
                'tanggal_pemberian.date' => 'Tanggal pemberian harus berupa tanggal!',
                'koordinator.required' => 'Koordinator tidak boleh kosong!',
                'koordinator.max' => 'Koordinator maksimal 50 karakter!',
                'sumber_anggaran.required' => 'Sumber anggaran tidak boleh kosong!',
                'sumber_anggaran.max' => 'Sumber anggaran maksimal 50 karakter!',
            ]
        );

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

    public function nolDuaPuluh(Request $request)
    {
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

    public function duaSatuTigaPuluh(Request $request)
    {
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

    public function tigaSatuEmpatPuluh(Request $request)
    {
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

    public function empatSatuLimaPuluh(Request $request)
    {
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

    public function limaSatuPlus(Request $request)
    {
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
