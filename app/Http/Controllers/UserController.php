<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alat;
use App\Models\User;
use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() //function untuk menampilkan semua pengguna yang terdaftar
    {
        $user = User::with(['role', 'bantuan.itemBantuan'])
            ->where('role_id', '=', 3)
            ->sortable()
            ->get();

        return view(
            'pages.user',
            [
                'userList' => $user,
            ]
        );
    }

    public function storeView() //function untuk menampilkan tampilan tambah pengguna
    {
        return view('pages.user-add');
    }

    public function store(Request $request) //function untuk menambah pengguna baru
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'email' => 'required|email|max:50|unique:users,email',
                'NIK' => 'unique:users|required|numeric|digits:16',
                'alamat' => 'required|max:100',
                'phone' => 'required|numeric|digits_between:10,13',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|max:50',
                'jenis_usaha_lainnya' => 'max:50'
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh lebih dari 50 karakter',
                'name.string' => 'Nama harus berupa huruf',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter',
                'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain',
                'NIK.required' => 'NIK tidak boleh kosong',
                'NIK.unique' => 'NIK sudah terdaftar',
                'NIK.numeric' => 'NIK harus berupa angka',
                'NIK.digits' => 'NIK harus berjumlah 16 karakter',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'alamat.max' => 'Alamat tidak boleh lebih dari 100 karakter',
                'phone.required' => 'Nomor telepon tidak boleh kosong',
                'phone.numeric' => 'Nomor telepon harus berupa angka',
                'phone.digits_between' => 'Nomor telepon minimal 10 angka dan maksimal 13 angka',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 30 karakter',
                'jenis_usaha_lainnya.max' => 'Jenis usaha lainnya tidak boleh lebih dari 50 karakter'
            ],
        );

        $user = new User;
        $jh = '';
        $password = bcrypt($request->NIK);
        $tl = Carbon::parse($request->tanggal_lahir);
        $umur = $tl->diffInYears(Carbon::now());

        if ($request->jenis_usaha === 'Lainnya') {
            $jh = $request->jenis_usaha_lainnya;
        }else{
            $jh = $request->jenis_usaha;
        }

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
        $user->jenis_usaha = $jh;
        $user->role_id = 3;
        $user->save();

        if ($user) {
            return redirect()->intended('/user')->with('create', 'berhasil create');
        }
    }

    public function destroy(Request $request) //function utntuk menghapus pengguna 
    {
        try {
            $ids = $request->ids;

            if($ids != null){
                $user = User::whereIn('id', $ids);
                $user->delete();

                if($user){
                    return redirect()->intended('/user')->with('delete', 'berhasil delete');
                }
            } else{
                return redirect()->intended('/user')->with('deleteFail', 'gagal dihapus');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/user')->with('gagal', 'gagal delete');
        }
    }

    public function updateView($id) //function untuk menampilkan tampilan edit pengguna
    {
        $user = User::findOrFail($id);
        return view('pages.user-edit', ['item' => $user]);
    }

    public function update(Request $request, $id) //function untuk update data pengguna
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'email' => ['required','email','max:50', Rule::unique('users')->ignore($id, 'id')],
                'NIK' => [
                    'required',
                    'numeric',
                    'digits:16',
                    Rule::unique('users')->ignore($id, 'id'),
                ],
                'alamat' => 'required|max:100',
                'phone' => 'required|numeric|digits_between:10,13',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|max:50',
                'jenis_usaha_lainnya' => 'max:50'
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh lebih dari 50 karakter',
                'name.string' => 'Nama harus berupa huruf',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter',
                'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain',
                'NIK.required' => 'NIK tidak boleh kosong',
                'NIK.unique' => 'NIK sudah terdaftar',
                'NIK.numeric' => 'NIK harus berupa angka',
                'NIK.digits' => 'NIK harus berjumlah 16 karakter',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'alamat.max' => 'Alamat tidak boleh lebih dari 100 karakter',
                'phone.required' => 'Nomor telepon tidak boleh kosong',
                'phone.numeric' => 'Nomor telepon harus berupa angka',
                'phone.digits_between' => 'Nomor telepon minimal 10 angka dan maksimal 13 angka',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 30 karakter',
                'jenis_usaha_lainnya.max' => 'Jenis usaha lainnya tidak boleh lebih dari 50 karakter'
            ],
        );

        $user = User::findOrFail($id);
        $jh = '';
        $tl = Carbon::parse($request->tanggal_lahir);
        $umur = $tl->diffInYears(Carbon::now());

        if ($request->jenis_usaha === 'Lainnya') {
            $jh = $request->jenis_usaha_lainnya;
        }else{
            $jh = $request->jenis_usaha;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->NIK = $request->NIK;
        $user->kepala_keluarga = $request->kepala_keluarga;
        $user->alamat = $request->alamat;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->umur = $umur;
        $user->jenis_usaha = $jh;
        $user->update();
        
        return redirect()->intended('/user')->with('update', 'berhasil update');
    }

    public function addBantuan($id) //function untuk menampilkan tampilan tambah bantuan baru
    {
        $user = User::findOrFail($id);

        return view('pages.addBantuan', ['user' => $user]);
    }

    public function storeBantuan(Request $request) //function untuk menambahkan bantuan baru
    {
        $request->validate(
            [
                'nama_bantuan' => 'required|max:100',
                'tahun_pemberian' => 'required|date',
                'koordinator_lainnya' => 'max:50',
                'nama_koordinator' => 'max:50',
                'anggaran_lainnya' =>'max:50'
            ],
            [
                'nama_bantuan.required' => 'Nama bantuan tidak boleh kosong!',
                'nama_bantuan.max' => 'Nama bantuan maksimal 100 karakter!',
                'tahun_pemberian.required' => 'Tanggal pemberian tidak boleh kosong!',
                'tahun_pemberian.date' => 'Tanggal pemberian harus berupa tanggal!',
                'koordinator_lainnya.max' => 'Koordinator lainnya maksimal 50 karakter!',
                'anggaran_lainnya.max' => 'Anggaran lainnya maksimal 50 karakter!',
                'nama_koordinator.max' => 'Nama koordinator maksimal 50 karakter'
            ]
        );

        $data = new Bantuan;
        $user = $request->user_id;
        $userName = User::findOrFail($user);
        $bantuanName = $request->nama_bantuan. ' ' .$userName->name;
        $lembagaKoordinator = '';
        $sumberAnggaran = '';

        if ($request->nama_koordinator == null) {
            if ($request->lembaga_koordinator === 'Lainnya') {
                $lembagaKoordinator = $request->koordinator_lainnya . ' - Tidak Diketahui';
            }else{
                $lembagaKoordinator = $request->lembaga_koordinator . ' - Tidak Diketahui';
            }
        }else{
            if ($request->lembaga_koordinator === 'Lainnya') {
                $lembagaKoordinator = $request->koordinator_lainnya . ' - ' . $request->nama_koordinator;
            }else{
                $lembagaKoordinator = $request->lembaga_koordinator . ' - ' . $request->nama_koordinator;
            }
        }

        if ($request->sumber_anggaran === 'Lainnya') {
            $sumberAnggaran = $request->anggaran_lainnya;
        }else{
            $sumberAnggaran = $request->sumber_anggaran;
        }

        $result = Bantuan::where('nama_bantuan', $bantuanName)->exists();

        if($result){
            return back()->withInput()->with('nameexists', 'gagal');
        }else{
            $data->nama_bantuan = $bantuanName;
            $data->koordinator = $lembagaKoordinator;
            $data->sumber_anggaran = $sumberAnggaran;
            $data->tahun_pemberian = $request->tahun_pemberian;
            $data->user_id = $request->user_id;
            $data->save();
            return redirect()->intended('/detail-user-bantuan/' . $user)->with('create', 'berhasil ditambahkan');
        }
    }

    public function detailuserbantuan($id) //function untuk menampilkan detail pengguna
    {
        $user = User::with(['role', 'bantuan.itemBantuan', 'pelatihan', 'sertifikat'])
            ->where('id', '=', $id)
            ->first();

        $pelatihan = Pelatihan::whereDoesntHave('user', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();

        $sertifikat = Sertifikat::whereDoesntHave('user', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();

        return view('pages.detail-user-bantuan', ['item' => $user, 'pelatihan' => $pelatihan, 'sertifikat' => $sertifikat]);
    }

    public function deleteBantuan($id) //function untuk menghapus bantuan
    {
        try {
            $data = Bantuan::findOrFail($id);
            $data->delete();

            return redirect()->back()->with('delete', 'berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', 'gagal dihapus');
        }
    }
}
