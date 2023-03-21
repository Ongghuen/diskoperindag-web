<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\BantuanItem;
use App\Models\ItemBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BantuanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('nama_bantuan', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('jenis_usaha', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('koordinator', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('sumber_anggaran', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('pages.bantuan', ['bantuanList' => $bantuan]);
    }

    public function addItem($id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $items = ItemBantuan::all();

        return view('pages.addItem', ['bantuan' => $bantuan, 'itemList' => $items]);
    }

    public function storeItem(Request $request)
    {
        $data = new BantuanItem;
        $dataBantuan = $request->bantuan_id;

        $data->create($request->all());

        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Item berhasil ditambahkan!');
        }

        return redirect('bantuan-detail/' . $dataBantuan);
    }

    public function deleteItem($item, $bantuan)
    {
        $data = BantuanItem::where('bantuan_id', '=', $bantuan)
            ->where('item_id', '=', $item)->delete();

        return back();
    }

    public function detailbantuan($id)
    {
        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where('id', '=', $id)
            ->first();

        return view('pages.bantuan-detail', ['item' => $bantuan]);
    }
}
