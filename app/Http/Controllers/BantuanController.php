<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
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
                    ->orWhere('tahun_pemberian', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('pages.bantuan', ['bantuanList' => $bantuan]);
    }

    public function store(Request $request)
    {
        $bantuan = new Bantuan;

        $bantuan->create($request->all());

        if ($bantuan) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data bantuan berhasil!');
        }

        return redirect('/bantuan');
    }

    public function destroy($id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $bantuan->delete();

        if ($bantuan) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data bantuan berhasil dihapus!');
        }

        return redirect('/bantuan');
    }

    public function update(Request $request, $id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $bantuan->update($request->all());

        if ($bantuan) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data bantuan berhasil diubah!');
        }

        return redirect('/bantuan');
    }
}
