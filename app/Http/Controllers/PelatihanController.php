<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PelatihanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = Pelatihan::where(function ($query) use ($keyword) {
            $query
                ->where('nama', 'LIKE', '%' . $keyword . '%')
                ->orWhere('tempat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('penyelenggara', 'LIKE', '%' . $keyword . '%');
        })
            ->paginate(10);

        return view('pages.pelatihanitem', ['itemList' => $items]);
    }

    public function storeView()
    {
        return view('pages.pelatihan-add');
    }

    public function store(Request $request)
    {
        $items = new Pelatihan;

        $items->create($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data pelatihan berhasil!');
        }

        return redirect('/pelatihanitem');
    }

    public function destroy($id)
    {
        $items = Pelatihan::findOrFail($id);
        $items->delete();

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data pelatihan berhasil dihapus!');
        }

        return redirect('/pelatihanitem');
    }

    public function updateView($id)
    {
        $items = Pelatihan::findOrFail($id);
        return view('pages.pelatihan-edit', ['item' => $items]);
    }

    public function update(Request $request, $id)
    {
        $items = Pelatihan::findOrFail($id);
        $items->update($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data pelatihan berhasil diubah!');
        }

        return redirect('/pelatihanitem');
    }

    public function pelatihandetail($id)
    {
        $items = Pelatihan::findOrFail($id);
        return view('pages.pelatihan-detail', ['item' => $items]);
    }
}
