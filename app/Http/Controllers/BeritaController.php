<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $dataBerita = Berita::
        orderByDesc('id')
        ->get();

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
                'file' => 'max:2048|mimes:png,jpg,jpeg',
                'judul' => 'required|max:100',
                'subjudul' => 'required|max:100',
                'body' => 'required|max:5000',
            ],
            [
                'file.max' => 'Image maksimal 2MB!',
                'file.mimes' => 'Image harus berupa png, jpg, jpeg!',
                'judul.required' => 'Judul tidak boleh kosong!',
                'judul.max' => 'Sub Judul maksimal 100 karakter!',
                'subjudul.required' => 'Judul tidak boleh kosong!',
                'subjudul.max' => 'Sub Judul maksimal 100 karakter!',
                'body.required' => 'deskripsi tidak boleh kosong!',
                'body.max' => 'deskripsi maksimal 1000 karakter!',
            ]
        );

        $items = new Berita;

        $image = null;
        if ($request->file) {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $fileName . '.' . $extension;

            $request->file->move(public_path('images/berita/'), $image);
        }

        $items->image = $image;
        $items->judul = $request->judul;
        $items->subjudul = $request->subjudul;
        $items->body = $request->body;
        $items->save();

        $messaging = app('firebase.messaging');

        $notification = Notification::fromArray([
            'title' => $request->judul,
            'body' => $request->subjudul,
        ]);

        $message = CloudMessage::withTarget('topic', 'diskoperindag')
            ->withNotification($notification);
        $messaging->send($message);

        if ($items) {
            return redirect()->intended('/berita')->with('create', 'berhasil create');
        }
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
                    'judul' => 'required|max:100',
                    'subjudul' => 'required|max:100',
                    'body' => 'required',
                ],
                [
                    'judul.required' => 'Judul tidak boleh kosong!',
                    'judul.max' => 'Sub Judul maksimal 100 karakter!',
                    'subjudul.required' => 'Judul tidak boleh kosong!',
                    'subjudul.max' => 'Sub Judul maksimal 100 karakter!',
                    'body.required' => 'deskripsi tidak boleh kosong!'
                ]
            );

            $items = Berita::findOrFail($id);
            $items->update($request->all());

            if ($items) {
                // Session::flash('status', 'success');
                // Session::flash('message', 'Data item bantuan berhasil diubah!');
                return redirect()->intended('/berita')->with('update', 'berhasil diupdate');
            }

            // return redirect('/berita');
        } else {
            $request->validate(
                [
                    'image' => 'required|max:2048|mimes:png,jpg,jpeg',
                    'judul' => 'required|max:100',
                    'subjudul' => 'required|max:100',
                    'body' => 'required',
                ],
                [
                    'image' => 'Image tidak boleh kosong!',
                    'image.max' => 'Image maksimal 2MB!',
                    'image.mimes' => 'Image harus berupa png, jpg, jpeg!',
                    'judul.required' => 'Judul tidak boleh kosong!',
                    'judul.max' => 'Sub Judul maksimal 100 karakter!',
                    'subjudul.required' => 'Judul tidak boleh kosong!',
                    'subjudul.max' => 'Sub Judul maksimal 100 karakter!',
                    'body.required' => 'deskripsi tidak boleh kosong!'
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
                return redirect()->intended('/berita')->with('update', 'berhasil diupdate');
            }
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->ids;

        if ($ids != null) {
            // foreach($ids as $data){
            //     File::delete(storage_path('images/berita/' . Berita::find($data)->image));
            // }
            $berita = Berita::whereIn('id', $ids);
            $berita->delete();

            if ($berita) {
                return redirect()->intended('/berita')->with('delete', 'berhasil dihapus');
            }
        } else {
            return redirect()->intended('/berita')->with('deleteFail', 'gagal dihapus');
        }
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function restoreView()
    {
        $dataBerita = Berita::onlyTrashed()->get();

        return view('pages.berita-deleted', ['itemList' => $dataBerita]);
    }

    public function beritaDetailDeleted($id)
    {
        $items = Berita::withTrashed()->find($id);

        return view('pages.berita-detail', ['item' => $items]);
    }

    public function forceDestroy(Request $request)
    {
        $ids = $request->ids;

        if ($ids != null) {
            foreach ($ids as $data) {
                $image = Berita::withTrashed()->find($data);
                if ($image->image != null) {
                    File::delete('images/berita/' . $image->image);
                }
            }
            $berita = Berita::whereIn('id', $ids);
            $berita->forceDelete();

            if ($berita) {
                return redirect()->intended('/berita-restore')->with('delete', 'berhasil dihapus');
            }
        } else {
            return redirect()->intended('/berita-restore')->with('deleteFail', 'gagal dihapus');
        }
    }

    public function restore($id)
    {
        $berita = Berita::withTrashed()->where('id', $id)->restore();

        return redirect()->intended('/berita-restore')->with('restore', 'berhasil dipulihkan');
    }
}
