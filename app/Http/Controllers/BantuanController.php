<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Bantuan;
use App\Models\Pelatihan;
use App\Models\Sertifikat;
use App\Models\BantuanAlat;
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
            ->get();

        return view('pages.bantuan', ['bantuanList' => $bantuan]);
    }

    public function addItem($id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $items = Alat::all();

        return view('pages.addItem', ['bantuan' => $bantuan, 'itemList' => $items]);
    }

    public function storeItem(Request $request)
    {
        $request->validate(
            [
                'kuantitas' => 'required|numeric',
            ],
            [
                'kuantitas.required' => 'Jumlah tidak boleh kosong!',
                'kuantitas.numeric' => 'Jumlah harus berupa angka!',
            ]
        );
        $data = new BantuanAlat;
        $dataBantuan = $request->bantuan_id;

        $data->create($request->all());

        if ($data) {
            // Session::flash('status', 'success');
            // Session::flash('message', 'Item berhasil ditambahkan!');
            return redirect('bantuan-detail/' . $dataBantuan)->with('create', 'Item berhasil ditambahkan');
        }
    }

    public function deleteItem($item, $bantuan)
    {
        $data = BantuanAlat::where('bantuan_id', '=', $bantuan)
            ->where('alat_id', '=', $item)->delete();

        if ($data) {
            return redirect('bantuan-detail/' . $bantuan)->with('delete', 'Item berhasil dihapus!');
        }
    }

    public function detailbantuan($id)
    {
        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where('id', '=', $id)
            ->first();

        return view('pages.bantuan-detail', ['item' => $bantuan]);
    }

    public function updateView($idBantuan, $idUser)
    {
        $items = Bantuan::findOrFail($idBantuan);
        $user = User::findOrFail($idUser);
        return view('pages.bantuan-edit', ['item' => $items, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_bantuan' => 'required|max:50',
                'jenis_usaha' => 'required|max:50',
                'tahun_pemberian' => 'required|date',
                'koordinator' => 'required|max:50',
                'sumber_anggaran' => 'required|max:50',
            ],
            [
                'nama_bantuan.required' => 'Nama bantuan tidak boleh kosong!',
                'nama_bantuan.max' => 'Nama bantuan maksimal 50 karakter!',
                'jenis_usaha.required' => 'Jenis usaha tidak boleh kosong!',
                'jenis_usaha.max' => 'Jenis usaha maksimal 50 karakter!',
                'tahun_pemberian.required' => 'Tanggal pemberian tidak boleh kosong!',
                'tahun_pemberian.date' => 'Tanggal pemberian harus berupa tanggal!',
                'koordinator.required' => 'Koordinator tidak boleh kosong!',
                'koordinator.max' => 'Koordinator maksimal 50 karakter!',
                'sumber_anggaran.required' => 'Sumber anggaran tidak boleh kosong!',
                'sumber_anggaran.max' => 'Sumber anggaran maksimal 50 karakter!',
            ]
        );

        $items = Bantuan::findOrFail($id);
        $user = $request->user_id;
        $items->update($request->all());

        return redirect()->intended('/detail-user-bantuan/' . $user)->with('update', 'berhasil diubah');
    }
}
