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
use Illuminate\Support\Facades\Validator;

class BantuanController extends Controller
{
    public function index(Request $request) //function untuk menampilkan semua bantuan yang diberikan ke pengguna
    {
        $keyword = $request->keyword;

        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('nama_bantuan', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tahun_pemberian', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('koordinator', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('sumber_anggaran', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('jenis_usaha', 'LIKE', '%' . $keyword . '%');
            })
            ->get();

        return view('pages.bantuan', ['bantuanList' => $bantuan]);
    }

    public function addItem($id) //function untuk menampilkan tampilan tambah alat ke bantuan
    {
        $bantuan = Bantuan::findOrFail($id);
        $items = Alat::all();

        return view('pages.addItem', ['bantuan' => $bantuan, 'itemList' => $items]);
    }

    public function storeItem(Request $request) //function untuk menambahkan alat ke bantuan
    {
        $validator = Validator::make($request->all(), [
            'kuantitas' => 'required|numeric',
        ], [
            'kuantitas.required' => 'Jumlah tidak boleh kosong!',
            'kuantitas.numeric' => 'Jumlah harus berupa angka!',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('gagaladditem', 'Validasi gagal');
        }

        $data = new BantuanAlat;
        $dataBantuan = $request->bantuan_id;

        $data->create($request->all());

        if ($data) {
            return redirect('bantuan-detail/' . $dataBantuan)->with('create', 'Item berhasil ditambahkan');
        }
    }

    public function deleteItem($item, $bantuan) //function untuk mengahapus alat dari bantuan
    {
        $data = BantuanAlat::where('bantuan_id', '=', $bantuan)
            ->where('alat_id', '=', $item)->delete();

        if ($data) {
            return redirect('bantuan-detail/' . $bantuan)->with('delete', 'Item berhasil dihapus!');
        }
    }

    public function detailbantuan($id) //function untuk menampilkan detail bantuan
    {
        $bantuan = Bantuan::with(['user', 'itemBantuan'])
            ->where('id', '=', $id)
            ->first();

        $alat = Alat::whereDoesntHave('bantuan', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();

        return view('pages.bantuan-detail', ['item' => $bantuan, 'alat' => $alat]);
    }

    public function updateView($idBantuan, $idUser) //function untuk menampilka tampilan edit bantuan
    {
        $items = Bantuan::findOrFail($idBantuan);
        $user = User::findOrFail($idUser);
        return view('pages.bantuan-edit', ['item' => $items, 'user' => $user]);
    }

    public function update(Request $request, $id) //function untu update bantuan
    {
        $request->validate(
            [
                'nama_bantuan' => 'required|max:100',
                'tahun_pemberian' => 'required|date',
                'koordinator_lainnya' => 'max:50',
                'nama_koordinator' => 'max:50',
                'anggaran_lainnya' =>'max:50'
            ],
            [
                'nama_bantuan.required' => 'Nama bantuan tidak boleh kosong!',
                'nama_bantuan.max' => 'Nama bantuan maksimal 100 karakter!',
                'tahun_pemberian.required' => 'Tanggal pemberian tidak boleh kosong!',
                'tahun_pemberian.date' => 'Tanggal pemberian harus berupa tanggal!',
                'koordinator_lainnya.max' => 'Koordinator lainnya maksimal 50 karakter!',
                'anggaran_lainnya.max' => 'Anggaran lainnya maksimal 50 karakter!',
                'nama_koordinator.max' => 'Nama koordinator maksimal 50 karakter'
            ]
        );

        $data = Bantuan::findOrFail($id);
        $user = $request->user_id;
        $userName = User::findOrFail($user);
        $bantuanName = $request->nama_bantuan. ' ' .$userName->name;
        $lembagaKoordinator = '';
        $sumberAnggaran = '';

        if ($request->nama_koordinator == null) {
            if ($request->lembaga_koordinator === 'Lainnya') {
                $lembagaKoordinator = $request->koordinator_lainnya . ' - Tidak Diketahui';
            }else{
                $lembagaKoordinator = $request->lembaga_koordinator . ' - Tidak Diketahui';
            }
        }else{
            if ($request->lembaga_koordinator === 'Lainnya') {
                $lembagaKoordinator = $request->koordinator_lainnya . ' - ' . $request->nama_koordinator;
            }else{
                $lembagaKoordinator = $request->lembaga_koordinator . ' - ' . $request->nama_koordinator;
            }
        }

        if ($request->sumber_anggaran === 'Lainnya') {
            $sumberAnggaran = $request->anggaran_lainnya;
        }else{
            $sumberAnggaran = $request->sumber_anggaran;
        }

        if ($bantuanName === $request->nama_bantuan_ril) {
            $data->nama_bantuan = $bantuanName;
            $data->koordinator = $lembagaKoordinator;
            $data->sumber_anggaran = $sumberAnggaran;
            $data->tahun_pemberian = $request->tahun_pemberian;
            $data->user_id = $request->user_id;
            $data->update();
            return redirect()->intended('/detail-user-bantuan/' . $user)->with('update', 'berhasil diubah');
        }else{
            $result = Bantuan::where('nama_bantuan', $bantuanName)->exists();
    
            if($result){
                return back()->withInput()->with('nameexists', 'gagal');
            }else{
                $data->nama_bantuan = $bantuanName;
                $data->koordinator = $lembagaKoordinator;
                $data->sumber_anggaran = $sumberAnggaran;
                $data->tahun_pemberian = $request->tahun_pemberian;
                $data->user_id = $request->user_id;
                $data->update();
                return redirect()->intended('/detail-user-bantuan/' . $user)->with('update', 'berhasil diubah');
            }
        }
    }

    public function updateQty(Request $request, $idBantuan, $idAlat) //function untuk uodate kuantitas alat yang diberikan
    {
        $validator = Validator::make($request->all(), [
            'kuantitas' => 'required|numeric',
        ], [
            'kuantitas.required' => 'Jumlah tidak boleh kosong!',
            'kuantitas.numeric' => 'Jumlah harus berupa angka!',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('gagaledititem', 'Validasi gagal');
        }

        $bantuan = Bantuan::find($idBantuan); // Mengambil model Bantuan berdasarkan $bantuan_id
        $bantuan->itemBantuan()->updateExistingPivot($idAlat, ['kuantitas' => $request->kuantitas]);
        $dataBantuan = $request->bantuan_id;

        if ($bantuan) {
            return redirect('bantuan-detail/' . $dataBantuan)->with('update', 'Item berhasil ditambahkan');
        }
    }
}
