<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\BantuanItem;
use App\Models\PelatihanItem;
use App\Models\SertifikatItem;
use App\Models\ItemBantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
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



    // Pelatihan Ngab

    public function indexpelatihan(Request $request)
    {
        $keyword = $request->keyword;

        $pelatihan = Bantuan::with(['user', 'itemPelatihan'])
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

        return view('pages.pelatihanfasilitas', ['pelatihanList' => $pelatihan]);
    }

    public function addItemPelatihan($id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $datapelatihan = Pelatihan::all();

        return view('pages.addItemPelatihan', ['bantuan' => $bantuan, 'PelatihanList' => $datapelatihan]);
    }

    public function storeItemPelatihan(Request $request)
    {
        $data = new PelatihanItem;
        $bantuan = $request->bantuan_id;

        $data->create($request->all());

        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Item berhasil ditambahkan!');
        }

        return redirect('pelatihandetail/' . $bantuan);
    }

    public function deleteItemPelatihan($item, $bantuan)
    {
        $data = PelatihanItem::where('bantuan_id', '=', $bantuan)
            ->where('item_id', '=', $item)->delete();

        return back();
    }


    public function detailpelatihan($id)
    {
        $pelatihan = Bantuan::with(['user', 'itemPelatihan'])
            ->where('id', '=', $id)
            ->first();

        return view('pages.pelatihandetail', ['item' => $pelatihan]);
    }



    // Sertifikat Ngab

    public function indexsertifikat(Request $request)
    {
        $keyword = $request->keyword;

        $sertifikat = Bantuan::with(['user', 'itemSertifikat'])
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

        return view('pages.sertifikatfasilitas', ['sertifikatList' => $sertifikat]);
    }

    public function addItemSertifikat($id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $datasertifikat = Sertifikat::all();

        return view('pages.addItemSertifikat', ['bantuan' => $bantuan, 'SertifikatList' => $datasertifikat]);
    }

    public function storeItemSertifikat(Request $request)
    {
        $data = new SertifikatItem;
        $bantuan = $request->bantuan_id;

        $data->create($request->all());

        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Item berhasil ditambahkan!');
        }

        return redirect('sertifikatdetail/' . $bantuan);
    }

    public function deleteItemSertifikat($item, $bantuan)
    {
        $data = SertifikatItem::where('bantuan_id', '=', $bantuan)
            ->where('item_id', '=', $item)->delete();

        return back();
    }


    public function detailsertifikat($id)
    {
        $sertifikat = Bantuan::with(['user', 'itemSertifikat'])
            ->where('id', '=', $id)
            ->first();

        return view('pages.sertifikatdetail', ['item' => $sertifikat]);
    }
}
