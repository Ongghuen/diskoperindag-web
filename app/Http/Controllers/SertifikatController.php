<?php

namespace App\Http\Controllers;


use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SertifikatController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = Sertifikat::where(function ($query) use ($keyword) {
            $query
                ->where('no_sertifikat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('nama', 'LIKE', '%' . $keyword . '%');
        })
            ->paginate(10);

        return view('pages.sertifikatitem', ['itemList' => $items]);
    }

    public function storeView()
    {
        return view('pages.sertifikat-add');
    }

    public function store(Request $request)
    {
        $items = new Sertifikat;

        $items->create($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data sertifikat berhasil!');
        }

        return redirect('/sertifikatitem');
    }

    public function destroy($id)
    {
        $items = Sertifikat::findOrFail($id);
        $items->delete();

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data sertifikat berhasil dihapus!');
        }

        return redirect('/sertikatitem');
    }

    public function updateView($id)
    {
        $items = Sertifikat::findOrFail($id);
        return view('pages.sertifikat-edit', ['item' => $items]);
    }

    public function update(Request $request, $id)
    {
        $items = Sertifikat::findOrFail($id);
        $items->update($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data sertifikat berhasil diubah!');
        }

        return redirect('/sertifikatitem');
    }

    public function sertifikatdetail($id)
    {
        $items = Sertifikat::findOrFail($id);
        return view('pages.sertifikat-detail', ['item' => $items]);
    }
}
