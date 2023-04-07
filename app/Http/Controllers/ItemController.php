<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = Alat::where(function ($query) use ($keyword) {
            $query
                ->where('nama_item', 'LIKE', '%' . $keyword . '%')
                ->orWhere('stok', 'LIKE', '%' . $keyword . '%');
        })
            ->paginate(10);

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

        $items = new Alat;

        $items->create($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data item bantuan berhasil!');
        }

        return redirect('/alatitem');
    }

    public function destroy($id)
    {
        $items = Alat::findOrFail($id);
        $items->delete();

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil dihapus!');
        }

        return redirect('/alatitem');
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
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil diubah!');
        }

        return redirect('/alatitem');
    }

    public function itemdetail($id)
    {
        $items = Alat::findOrFail($id);
        return view('pages.item-detail', ['item' => $items]);
    }
}
