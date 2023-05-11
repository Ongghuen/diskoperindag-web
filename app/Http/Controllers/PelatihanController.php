<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PelatihanController extends Controller
{
    public function index(Request $request)
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

    public function detailPelatihan($id)
    {
        $pelatihan = Pelatihan::with('user')
            ->where('id', '=', $id)
            ->first();

        return view('pages.pelatihan-detail', ['item' => $pelatihan]);
    }

    public function destroy($id)
    {
        try {
            $items = Pelatihan::findOrFail($id);
            $items->delete();
    
            return back()->with('delete', 'berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('gagal', 'gagal dihapus');
        }
    }

    public function storeView($id)
    {
        $user = User::findOrFail($id);

        return view('pages.pelatihan-add', ['user' => $user]);
    }

    public function store(Request $request)
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

        return redirect('/detail-user-bantuan/' . $user)->with('create', 'berhasil ditambahkan');
    }

    public function updateView($idPelatihan, $idUser)
    {
        $items = Pelatihan::findOrFail($idPelatihan);
        $user = User::findOrFail($idUser);
        return view('pages.pelatihan-edit', ['item' => $items, 'user' => $user]);
    }

    public function update(Request $request, $id)
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
        $user = $request->user_id;
        $items->update($request->all());

        return redirect('/detail-user-bantuan/' . $user)->with('update', 'berhasil diupdate');
    }
}
