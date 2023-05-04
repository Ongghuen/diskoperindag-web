<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $dataBerita = Berita::where(function ($query) use ($keyword) {
            $query
                ->where('judul', 'LIKE', '%' . $keyword . '%')
                ->orWhere('subjudul', 'LIKE', '%' . $keyword . '%');
        })
            ->paginate(10);

        return view('pages.berita', ['itemList' => $dataBerita]);
    }

    public function beritadetail($id)
    {
        $items = Berita::findOrFail($id);
        return view('pages.berita-detail', ['item' => $items]);
    }

    public function editview($id)
    {
        $items = Berita::findOrFail($id);
        return view('pages.berita-edit', ['item' => $items]);
    }

    public function destroy($id)
    {
        $items = Berita::findOrFail($id);
        $items->delete();

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil dihapus!');
        }

        return redirect('/berita');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'judul' => 'required|max:50',
                'subjudul' => 'required|max:50',
                'body' => 'required|max:1000',
            ],
            [
                'judul.required' => 'Judul tidak boleh kosong!',
                'judul.max' => 'Sub Judul maksimal 50 karakter!',
                'subjudul.required' => 'Judul tidak boleh kosong!',
                'subjudul.max' => 'Sub Judul maksimal 50 karakter!',
                'body.required' => 'deskripsi tidak boleh kosong!',
                'body.max' => 'deskripsi maksimal 1000 karakter!',
            ]

        );

        $items = Berita::findOrFail($id);
        $items->update($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil diubah!');
        }

        return redirect('/berita');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required',
                'judul' => 'required|max:50',
                'subjudul' => 'required|max:50',
                'body' => 'required|max:1000',
            ],
            [
                'image' => 'Image tidak boleh kosong!',
                'judul.required' => 'Judul tidak boleh kosong!',
                'judul.max' => 'Sub Judul maksimal 50 karakter!',
                'subjudul.required' => 'Judul tidak boleh kosong!',
                'subjudul.max' => 'Sub Judul maksimal 50 karakter!',
                'body.required' => 'deskripsi tidak boleh kosong!',
                'body.max' => 'deskripsi maksimal 1000 karakter!',
            ]

        );

        $items = new Berita;

        $items->create($request->all());

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data item bantuan berhasil!');
        }

        return redirect('/berita');
    }

    
    public function storeView()
    {
        return view('pages.berita-add');
    }


}
