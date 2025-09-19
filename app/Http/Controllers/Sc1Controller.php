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
        $rules = [];
        foreach (Sc1::getAllColumns() as $field => $type) {
            if ($field !== 'No') {
                if (str_contains($type, 'varchar') || str_contains($type, 'date')) {
                    $rules[$field] = 'nullable|string'; // bisa kamu ganti 'required|string'
                } elseif (str_contains($type, 'int') || str_contains($type, 'decimal')) {
                    $rules[$field] = 'nullable|numeric';
                }
            }
        }

        $validated = $request->validate($rules);

        Sc1::create($validated);

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
