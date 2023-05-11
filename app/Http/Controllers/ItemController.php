<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index()
    {
        $items = Alat::all();

        return view('pages.alatitem', ['itemList' => $items]);
    }

    public function storeView()
    {
        return view('pages.item-add');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_item' => 'required|max:50',
                'stok' => 'required|numeric',
                'deskripsi' => 'required|max:255',
            ],
            [
                'nama_item.required' => 'Nama item tidak boleh kosong!',
                'nama_item.max' => 'Nama item maksimal 50 karakter!',
                'stok.required' => 'Stok tidak boleh kosong!',
                'stok.numeric' => 'Jumlah harus berupa angka!',
                'deskripsi.required' => 'deskripsi tidak boleh kosong!',
                'deskripsi.max' => 'deskripsi maksimal 255 karakter!',
            ]

        );

        $items = new Alat;

        $items->create($request->all());

        if ($items) {
            // Session::flash('status', 'success');
            // Session::flash('message', 'Tambah data item bantuan berhasil!');
            return redirect()->intended('/alatitem')->with('create', 'berhasil create');
        }
    }

    public function destroy($id)
    {
        $items = Alat::findOrFail($id);
        $items->delete();

        if ($items) {
            return redirect()->intended('/alatitem')->with('delete', 'berhasil delete');
        }
    }

    public function updateView($id)
    {
        $items = Alat::findOrFail($id);
        return view('pages.item-edit', ['item' => $items]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_item' => 'required|max:50',
                'stok' => 'required|max:6',
                'deskripsi' => 'required|max:255',
            ],
            [
                'nama_item.required' => 'Nama item tidak boleh kosong!',
                'nama_item.max' => 'Nama item maksimal 50 karakter!',
                'stok.required' => 'Stok tidak boleh kosong!',
                'stok.max' => 'Stok maksimal 6 karakter!',
                'deskripsi.required' => 'deskripsi tidak boleh kosong!',
                'deskripsi.max' => 'deskripsi maksimal 255 karakter!',
            ]

        );

        $items = Alat::findOrFail($id);
        $items->update($request->all());

        if ($items) {
            return redirect()->intended('/alatitem')->with('update', 'berhasil delete');
        }
    }

    public function itemdetail($id)
    {
        $items = Alat::findOrFail($id);
        return view('pages.item-detail', ['item' => $items]);
    }
}
