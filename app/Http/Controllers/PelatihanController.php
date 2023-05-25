<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Models\UserPelatihan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PelatihanController extends Controller
{
    public function index(Request $request) //fucntion untuk menampilkan semua pelatihan
    {
        $keyword = $request->keyword;

        $items = Pelatihan::with('user')
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('nama', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tempat', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('penyelenggara', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return view('pages.pelatihan', ['itemList' => $items]);
    }

    public function detailPelatihan($id) //function untuk menampilkan detail pelatihan
    {
        $pelatihan = Pelatihan::with('user')
            ->where('id', '=', $id)
            ->first();

        $user = User::where('role_id', '3')->whereDoesntHave('pelatihan', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();

        return view('pages.pelatihan-detail', ['pelatihan' => $pelatihan, 'user' => $user]);
    }

    public function destroy(Request $request) //function untuk menghapus pelatihan
    {
        try {
            $ids = $request->ids;

            if($ids != null){
                $pelatihan = Pelatihan::whereIn('id', $ids);
                $pelatihan->delete();

                if($pelatihan){
                    return redirect()->intended('/pelatihan')->with('delete', 'berhasil delete');
                }
            } else{
                return redirect()->intended('/pelatihan')->with('deleteFail', 'gagal dihapus');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/pelatihan')->with('gagal', 'gagal delete');
        }
    }

    public function storeView() //function untuk menampilkan tampilan tambah
    {
        return view('pages.pelatihan-add');
    }

    public function store(Request $request) //funtion untuk menambahkan pelatihan
    {
        $request->validate(
            [
                'nama' => 'required|max:50',
                'penyelenggara' => 'required|max:50',
                'tanggal_pelaksanaan' => 'required|date',
                'tempat' => 'required|max:50',
            ],
            [
                'nama.required' => 'Nama Pelatihan tidak boleh kosong',
                'nama.max' => 'Nama Pelatihan maksimal 50 karakter',
                'tanggal_pelaksanaan.required' => 'tanggal pelaksanaan tidak boleh kosong',
                'penyelenggara.max' => 'Penyelenggara maksimal 50 karakter',
                'penyelenggara.required' => 'Penyelenggara tidak boleh kosong',
                'tempat.required' => 'Tempat tidak boleh kosong',
            ]
        );

        $items = new Pelatihan;
        $user = $request->user_id;

        $items->create($request->all());

        return redirect('/pelatihan')->with('create', 'berhasil ditambahkan');
    }

    public function updateView($idPelatihan) //function untuk menampilkan tampilan edit pelatihan
    {
        $items = Pelatihan::findOrFail($idPelatihan);
        return view('pages.pelatihan-edit', ['item' => $items]);
    }

    public function update(Request $request, $id) //funtion untuk update pelatihan
    {
        $request->validate(
            [
                'nama' => 'required|max:50',
                'penyelenggara' => 'required|max:50',
                'tanggal_pelaksanaan' => 'required|date',
                'tempat' => 'required|max:50',
            ],
            [
                'nama.required' => 'Nama Pelatihan tidak boleh kosong',
                'nama.max' => 'Nama Pelatihan maksimal 50 karakter',
                'tanggal_pelaksanaan.required' => 'tanggal pelaksanaan tidak boleh kosong',
                'penyelenggara.max' => 'Penyelenggara maksimal 50 karakter',
                'penyelenggara.required' => 'Penyelenggara tidak boleh kosong',
                'tempat.required' => 'Tempat tidak boleh kosong',
            ]
        );

        $items = Pelatihan::findOrFail($id);
        $items->update($request->all());

        return redirect('/pelatihan')->with('update', 'berhasil diupdate');
    }

    public function addUser(Request $request) //function untuk menambahkan pengguna ikut ke pelatihan
    {
        $data = new UserPelatihan;
        $data->create($request->all());

        if ($data) {
            return redirect()->back()->with('create', 'Item berhasil ditambahkan');
        }
    }

    public function deleteUser($user, $pelatihan) //function untuk menghapus user dari pelatihan
    {
        $data = UserPelatihan::where('user_id', $user)->where('pelatihan_id', $pelatihan)->delete();

        if ($data) {
            return redirect()->back()->with('delete', 'berhasil delete');
        }
    }
}
