<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index() //function untuk menampilkan semua alat
    {
        $items = Alat::all();

        return view('pages.alatitem', ['itemList' => $items]);
    }

    public function storeView() //function untuk menampilkan tampilan tambah berita
    {
        return view('pages.item-add');
    }

    public function store(Request $request) //function untuk menambahkan alat baru
    {
        $request->validate(
            [
                'nama_item' => 'required|max:50',
                'deskripsi' => 'required',
            ],
            [
                'nama_item.required' => 'Nama item tidak boleh kosong!',
                'nama_item.max' => 'Nama item maksimal 50 karakter!',
                'deskripsi.required' => 'deskripsi tidak boleh kosong!'
            ]
        );

        $items = new Alat;

        $items->create($request->all());

        if ($items) {
            return redirect()->intended('/alatitem')->with('create', 'berhasil create');
        }
    }

    public function destroy(Request $request) //function untuk menghapus alat
    {
        try {
            $ids = $request->ids;

            if($ids != null){
                $alat = Alat::whereIn('id', $ids);
                $alat->delete();

                if($alat){
                    return redirect()->intended('/alatitem')->with('delete', 'berhasil dihapus');
                }
            } else{
                return redirect()->intended('/alatitem')->with('deleteFail', 'gagal dihapus');
            }
        } catch (\Throwable $th) {
            return redirect()->intended('/alatitem')->with('gagal', 'gagal delete');
        }
    }

    public function updateView($id) //function untuk menampilkan tampilan edit alat
    {
        $items = Alat::findOrFail($id);
        return view('pages.item-edit', ['item' => $items]);
    }

    public function update(Request $request, $id) //function untuk update alat
    {
        $request->validate(
            [
                'nama_item' => 'required|max:50',
                'deskripsi' => 'required',
            ],
            [
                'nama_item.required' => 'Nama item tidak boleh kosong!',
                'nama_item.max' => 'Nama item maksimal 50 karakter!',
                'deskripsi.required' => 'deskripsi tidak boleh kosong!'
            ]
        );

        $items = Alat::findOrFail($id);
        $items->update($request->all());

        if ($items) {
            return redirect()->intended('/alatitem')->with('update', 'berhasil delete');
        }
    }

    public function itemdetail($id) //function untuk menampilkan detail alat
    {
        $items = Alat::findOrFail($id);
        return view('pages.item-detail', ['item' => $items]);
    }
}
