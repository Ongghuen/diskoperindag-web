<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Facades\File;
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


    public function storeView()
    {
        return view('pages.berita-add');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|max:2048|mimes:png,jpg,jpeg',
                'judul' => 'required|max:50',
                'subjudul' => 'required|max:50',
                'body' => 'required|max:1000',
            ],
            [
                'image' => 'Image tidak boleh kosong!',
                'image.max' => 'Image maksimal 2MB!',
                'image.mimes' => 'Image harus berupa png, jpg, jpeg!',
                'judul.required' => 'Judul tidak boleh kosong!',
                'judul.max' => 'Sub Judul maksimal 50 karakter!',
                'subjudul.required' => 'Judul tidak boleh kosong!',
                'subjudul.max' => 'Sub Judul maksimal 50 karakter!',
                'body.required' => 'deskripsi tidak boleh kosong!',
                'body.max' => 'deskripsi maksimal 1000 karakter!',
            ]

        );

        $items = new Berita;

        $fileNameImage = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/berita/'), $fileNameImage);

        $items->image = $fileNameImage;
        $items->judul = $request->judul;
        $items->subjudul = $request->subjudul;
        $items->body = $request->body;
        $items->save();


        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Tambah data item bantuan berhasil!');
        }

        return redirect('/berita');
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

    public function update(Request $request, $id)
    {

        if ($request->image == null) {
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
        } else {
            $request->validate(
                [
                    'image' => 'required|max:2048|mimes:png,jpg,jpeg',
                    'judul' => 'required|max:50',
                    'subjudul' => 'required|max:50',
                    'body' => 'required|max:1000',
                ],
                [
                    'image' => 'Image tidak boleh kosong!',
                    'image.max' => 'Image maksimal 2MB!',
                    'image.mimes' => 'Image harus berupa png, jpg, jpeg!',
                    'judul.required' => 'Judul tidak boleh kosong!',
                    'judul.max' => 'Sub Judul maksimal 50 karakter!',
                    'subjudul.required' => 'Judul tidak boleh kosong!',
                    'subjudul.max' => 'Sub Judul maksimal 50 karakter!',
                    'body.required' => 'deskripsi tidak boleh kosong!',
                    'body.max' => 'deskripsi maksimal 1000 karakter!',
                ]

            );

            $deleteimage = Berita::findOrFail($id);
            File::delete('images/berita/' . $deleteimage->image);

            $items = Berita::findOrFail($id);

            $fileNameImage = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/berita/'), $fileNameImage);

            $items->image = $fileNameImage;
            $items->judul = $request->judul;
            $items->subjudul = $request->subjudul;
            $items->body = $request->body;
            $items->save();

            if ($items) {
                Session::flash('status', 'success');
                Session::flash('message', 'Data item bantuan berhasil diubah!');
            }

            return redirect('/berita');
        }
    }
    public function destroy($id)
    {
        $deleteimage = Berita::findOrFail($id);
        File::delete('images/berita/' . $deleteimage->image);

        $items = Berita::findOrFail($id);
        $items->delete();

        if ($items) {
            Session::flash('status', 'success');
            Session::flash('message', 'Data item bantuan berhasil dihapus!');
        }

        return redirect('/berita');
    }
}
