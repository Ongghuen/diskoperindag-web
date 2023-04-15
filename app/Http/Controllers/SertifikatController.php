<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SertifikatController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = Sertifikat::with('user')
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('no_sertifikat', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('nama', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('pages.sertifikat', ['itemList' => $items]);
    }

    public function detailsertifikat($id)
    {
        $items = Sertifikat::with('user')->findOrFail($id);
        return view('pages.sertifikat-detail', ['item' => $items]);
    }

    public function destroy($id)
    {
        $items = Sertifikat::findOrFail($id);
        $items->delete();

        return back();
    }

    public function storeView($id)
    {
        $user = User::findOrFail($id);

        return view('pages.sertifikat-add', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'no_sertifikat' => 'required',
                'nama' => 'required|max:50',
                'tanggal_terbit' => 'required|date',
                'kadaluarsa_penyelenggara' => 'required|date',
                'keterangan' => 'required|max:255',
            ],
            [
                'no_sertifikat.required' => 'No. Sertifikat tidak boleh kosong!',
                'nama.required' => 'Nama tidak boleh kosong!',
                'nama.max' => 'Nama maksimal 50 karakter!',
                'tanggal_terbit.required' => 'Tanggal Terbit tidak boleh kosong!',
                'kadaluarsa_penyelenggara.required' => 'Kadaluarsa Penyelenggara tidak boleh kosong!',
                'keterangan.required' => 'Keterangan tidak boleh kosong!',
                'keterangan.max' => 'Keterangan maksimal 50 karakter!',
            ]
        );

        $items = new Sertifikat;
        $user = $request->user_id;

        $items->create($request->all());

        return redirect('/detail-user-bantuan/' . $user);
    }

    public function updateView($idSertifikat, $idUser)
    {
        $items = Sertifikat::findOrFail($idSertifikat);
        $user = User::findOrFail($idUser);
        return view('pages.sertifikat-edit', ['item' => $items, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [

                'no_sertifikat' => 'required|max:20',
                'nama' => 'required|max:50',
                'tanggal_terbit' => 'required|date',
                'kadaluarsa_penyelenggara' => 'required|date',
                'keterangan' => 'required|max:255',
            ],
            [
                'no_sertifikat.required' => 'No. Sertifikat tidak boleh kosong!',
                'no_sertifikat.max' => 'No. Sertifikat maksimal 20 karakter!',
                'nama.required' => 'Nama tidak boleh kosong!',
                'nama.max' => 'Nama maksimal 50 karakter!',
                'tanggal_terbit.required' => 'Tanggal Terbit tidak boleh kosong!',
                'kadaluarasa_penyelenggara.required' => 'Kadaluarsa Penyelenggara tidak boleh kosong!',
                'keterangan.required' => 'Keterangan tidak boleh kosong!',
                'keterangan.max' => 'Keterangan maksimal 50 karakter!',
            ]
        );

        $items = Sertifikat::findOrFail($id);
        $user = $request->user_id;
        $items->update($request->all());

        return redirect('/detail-user-bantuan/' . $user);
    }
}
