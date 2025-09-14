<?php

namespace App\Http\Controllers;

use App\Models\Sc1;
use Illuminate\Http\Request;

class Sc1Controller extends Controller
{
    // Tampilan user (hanya beberapa kolom)
    public function index()
    {
        $data = Sc1::select(
            'No',
            'Nopen_PIB',
            'Nopen_Date',
            'DescriptionofGoods_Matrial',
            'Dokumen_StatusDokumen',
            'PortofLoading_Kapal',
            'Date_PortofLoading',
            'PlaceOfDelivery',
            'Estimasi_DateSurabaya'
        )->get();

        return view('home', compact('data'));
    }

    // Tampilan admin (semua kolom + CRUD)
    public function admin()
    {
        $data = Sc1::all();
        $columns = Sc1::getAllColumns(); // 🔑 Ambil semua kolom
        return view('admin', compact('data', 'columns'));
    }

    // Tambah data
    public function store(Request $request)
    {
        $data = $request->except('No'); // jangan isi primary key manual
        Sc1::create($data);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    // Update data
    public function update(Request $request, $id)
    {
        $row = Sc1::findOrFail($id);
        $data = $request->except('No');
        $row->update($data);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $row = Sc1::findOrFail($id);
        $row->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
