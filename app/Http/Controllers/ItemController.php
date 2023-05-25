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

    public function destroy(Request $request)
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

    public function itemdetail($id)
    {
        $items = Alat::findOrFail($id);
        return view('pages.item-detail', ['item' => $items]);
    }
}
