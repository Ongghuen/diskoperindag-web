<?php

namespace App\Http\Controllers;

use App\Models\ItemBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = ItemBantuan::
                where(function ($query) use($keyword){
                    $query
                    ->where('nama_item', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('stok', 'LIKE', '%'.$keyword.'%');
                })
                ->paginate(10);

        return view('pages.item', ['itemList' => $items]);
    }

    public function storeView()
    {
        return view('pages.item-add');
    }

    public function store(Request $request)
    {
        $items = new ItemBantuan;
        
        $items->create($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data item bantuan berhasil!');
        }

        return redirect('/item');
    }

    public function destroy($id)
    {
        $items = ItemBantuan::findOrFail($id);
        $items->delete();

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil dihapus!');
        }

        return redirect('/item');
    }

    public function updateView($id)
    {
        $items = ItemBantuan::findOrFail($id);
        return view('pages.item-edit', ['item' => $items]);
    }

    public function update(Request $request, $id)
    {
        $items = ItemBantuan::findOrFail($id);
        $items->update($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil diubah!');
        }

        return redirect('/item');
    }
}