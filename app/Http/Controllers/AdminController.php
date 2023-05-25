<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index() //function untuk menampilkan semua data admin yang ada ditabel user
    {
        $admin = User::with('role')
            ->where('role_id', '=', 2)
            ->sortable()
            ->get();

        return view(
            'pages.admin',['adminList' => $admin]
        );
    }

    public function storeView() //function untuk menampilkan tampilan tambah admin
    {
        return view('pages.admin-add');
    }

    public function store(Request $request) //function untuk tambah admin
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'email' => 'required|email|max:50|unique:users,email',
                'NIK' => 'unique:users|required|numeric|digits:16',
                'alamat' => 'required|max:100',
                'phone' => 'required|numeric',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|max:30',
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
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 30 karakter',
            ],
        );

        $user = new User;
        $password = bcrypt($request->NIK);
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
        $user->role_id = 2;
        $user->save();

        if ($user) {
            return redirect()->intended('/admin')->with('create', 'berhasil create');
        }
    }

    public function destroy(Request $request) // function untuk multiple delete admin 
    {
        try {
            $ids = $request->ids;

            if($ids != null){
                $user = User::whereIn('id', $ids);
                $user->delete();

                if($user){
                    return redirect()->intended('/admin')->with('delete', 'berhasil delete');
                }
            } else{
                return redirect()->intended('/admin')->with('deleteFail', 'gagal dihapus');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/admin')->with('gagal', 'gagal delete');
        }
    }

    public function updateView($id) //function untuk menampilkan tampilan edit admin
    {
        $user = User::findOrFail($id);
        return view('pages.admin-edit', ['item' => $user]);
    }

    public function update(Request $request, $id) //function untuk update data admin
    {
        $request->validate(
            [
                'name' => 'required|max:50',
                'email' => 'required|email|max:50',
                'alamat' => 'required|max:100',
                'phone' => 'required|numeric',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required|max:30',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.max' => 'Nama tidak boleh lebih dari 50 karakter',
                'name.string' => 'Nama harus berupa huruf',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'alamat.max' => 'Alamat tidak boleh lebih dari 100 karakter',
                'phone.required' => 'Nomor telepon tidak boleh kosong',
                'phone.numeric' => 'Nomor telepon harus berupa angka',
                'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid',
                'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 30 karakter',
            ],
        );

        $user = User::findOrFail($id);

        $user->update($request->all());
        return redirect()->intended('/admin')->with('update', 'berhasil update');
    }

    public function show($id) // function untuk menampilkan detail admin
    {
        $user = User::where('id', '=', $id)
            ->first();

        return view('pages.admin-detail', ['item' => $user]);
    }

    public function resetPassword($id) //function untuk mengganti password admin
    {
        $user = User::findOrFail($id);

        $user->password = bcrypt($user->NIK);
        $user->update();

        return redirect()->back()->with('resetPw', 'berhasil reset');
    }
}
