<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\UserSertifikat;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SertifikatController extends Controller
{
    public function index(Request $request) //function untuk menampilkan semua sertifikat
    {
        $keyword = $request->keyword;

        $items = Sertifikat::with('user')
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('nama', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return view('pages.sertifikat', ['itemList' => $items]);
    }

    public function detailsertifikat($id) //function untuk menampilkan detail sertifikat
    {
        $items = Sertifikat::with('user')->findOrFail($id);

        $user = User::where('role_id', '3')->whereDoesntHave('sertifikat', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        return view('pages.sertifikat-detail', ['sertifikat' => $items, 'user' => $user]);
    }

    public function destroy(Request $request) //fuction untuk multiple delete sertifikat
    {
        try {
            $ids = $request->ids;

            if($ids != null){
                $sertifikat = Sertifikat::whereIn('id', $ids);
                $sertifikat->delete();

                if($sertifikat){
                    return redirect()->intended('/sertifikat')->with('delete', 'berhasil delete');
                }
            } else{
                return redirect()->intended('/sertifikat')->with('deleteFail', 'gagal dihapus');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/sertifikat')->with('gagal', 'gagal delete');
        }
    }

    public function storeView() //function untuk menampilkan tampilan tambah sertifikat 
    {
        return view('pages.sertifikat-add');
    }

    public function store(Request $request) //fucntion untuk menambah sertifikat
    {
        $request->validate(
            [
                'nama' => 'required|max:100|unique:sertifikat',
                'tanggal_terbit' => 'required|date',
                'kadaluarsa_penyelenggara' => 'required|date',
                'keterangan' => 'required|max:1000',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong!',
                'nama.max' => 'Nama maksimal 100 karakter!',
                'nama.unique' => 'Nama sertifikat sudah ada, silahkan gunakan nama lain',
                'tanggal_terbit.required' => 'Tanggal Terbit tidak boleh kosong!',
                'kadaluarsa_penyelenggara.required' => 'Kadaluarsa Penyelenggara tidak boleh kosong!',
                'keterangan.required' => 'Keterangan tidak boleh kosong!',
                'keterangan.max' => 'Keterangan maksimal 1000 karakter'
            ]
        );

        $items = new Sertifikat;

        $items->create($request->all());

        return redirect('/sertifikat')->with('create', 'berhasil ditambahkan');
    }

    public function updateView($idSertifikat) //function untuk menampilkan tampilan edit sertifikat
    {
        $items = Sertifikat::findOrFail($idSertifikat);
        return view('pages.sertifikat-edit', ['item' => $items]);
    }

    public function update(Request $request, $id) //function untuk update sertifikat
    {
        $request->validate(
            [
                'nama' => ['required','max:50', Rule::unique('sertifikat')->ignore($id, 'id')],
                'tanggal_terbit' => 'required|date',
                'kadaluarsa_penyelenggara' => 'required|date',
                'keterangan' => 'required|max:1000',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong!',
                'nama.max' => 'Nama maksimal 50 karakter!',
                'nama.unique' => 'Nama pelatihan sudah ada, silahkan gunakan nama lain',
                'tanggal_terbit.required' => 'Tanggal Terbit tidak boleh kosong!',
                'kadaluarasa_penyelenggara.required' => 'Kadaluarsa Penyelenggara tidak boleh kosong!',
                'keterangan.required' => 'Keterangan tidak boleh kosong!',
                'keterangan.max' => 'Keterangan maksimal 1000 karakter'
            ]
        );

        $items = Sertifikat::findOrFail($id);
        $items->update($request->all());

        return redirect('/sertifikat')->with('update', 'berhasil diupdate');
    }

    public function addUser(Request $request) //function untuk menambahkan pengguna ke dalam sertifikat
    {
        $data = new UserSertifikat;
        $data->create($request->all());

        if ($data) {
            return redirect()->back()->with('create', 'Item berhasil ditambahkan');
        }
    }

    public function deleteUser($user, $sertifikat) //function untuk menghapus user dari sertifikat
    {
        $data = UserSertifikat::where('user_id', $user)->where('sertifikat_id', $sertifikat)->delete();

        if ($data) {
            return redirect()->back()->with('delete', 'berhasil delete');
        }
    }
}
