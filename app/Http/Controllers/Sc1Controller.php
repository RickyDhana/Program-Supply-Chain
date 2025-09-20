<?php

namespace App\Http\Controllers;

use App\Models\Sc1;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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

    // Export ke Excel
    public function exportExcel()
    {
        $data = Sc1::all()->toArray(); // ambil semua data

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // =========================
        // HEADER BARIS 1
        // =========================
        $sheet->setCellValue('A1', 'No'); 
        $sheet->mergeCells('A1:A2');

        $sheet->setCellValue('B1', 'Nopen'); 
        $sheet->mergeCells('B1:C1');

        $sheet->setCellValue('D1', 'Description of Goods / Matrial'); 
        $sheet->mergeCells('D1:D2');

        $sheet->setCellValue('E1', 'Code Project'); 
        $sheet->mergeCells('E1:E2');

        $sheet->setCellValue('F1', 'Fasilitas MITA / SP01'); 
        $sheet->mergeCells('F1:F2');

        $sheet->setCellValue('G1', 'Jalur'); 
        $sheet->mergeCells('G1:G2');

        $sheet->setCellValue('H1', 'COO'); 
        $sheet->mergeCells('H1:H2');

        $sheet->setCellValue('I1', 'Dokumen'); 
        $sheet->mergeCells('I1:J1');

        $sheet->setCellValue('K1', 'Terima B/L Asli / Copy IMEX Terima'); 
        $sheet->mergeCells('K1:M1');

        $sheet->setCellValue('N1', 'Jumlah'); 
        $sheet->mergeCells('N1:Q1');

        $sheet->setCellValue('R1', 'Gross Weight (KGS)'); 
        $sheet->mergeCells('R1:R2');

        $sheet->setCellValue('S1', 'Measurement (cbm)'); 
        $sheet->mergeCells('S1:S2');

        $sheet->setCellValue('T1', 'Port of Loading'); 
        $sheet->mergeCells('T1:U1');

        $sheet->setCellValue('V1', 'Place of Delivery'); 
        $sheet->mergeCells('V1:V2');

        $sheet->setCellValue('W1', 'Estimasi Di Pelabuhan'); 
        $sheet->mergeCells('W1:W2');

        $sheet->setCellValue('X1', 'PO'); 
        $sheet->mergeCells('X1:AA1');

        $sheet->setCellValue('AB1', 'Shipper / Vendor'); 
        $sheet->mergeCells('AB1:AB2');

        $sheet->setCellValue('AC1', 'Vessel / Flig'); 
        $sheet->mergeCells('AC1:AC2');

        $sheet->setCellValue('AD1', 'KPPBC'); 
        $sheet->mergeCells('AD1:AD2');

        $sheet->setCellValue('AE1', 'B / L / AWB'); 
        $sheet->mergeCells('AE1:AF1');

        $sheet->setCellValue('AG1', 'Invoice'); 
        $sheet->mergeCells('AG1:AO1');

        $sheet->setCellValue('AP1', 'PO Nilai'); 
        $sheet->mergeCells('AP1:AP2');

        $sheet->setCellValue('AQ1', 'Keterangan'); 
        $sheet->mergeCells('AQ1:AQ2');

        $sheet->setCellValue('AR1', 'Nilai'); 
        $sheet->mergeCells('AR1:AR2');

        $sheet->setCellValue('AS1', 'Shipment Of Instruction (SI)'); 
        $sheet->mergeCells('AS1:AU1');

        $sheet->setCellValue('AV1', 'Memo Penerbit Polis (FOB)'); 
        $sheet->mergeCells('AV1:AW1');

        $sheet->setCellValue('AX1', 'Marine Cargo FOB'); 
        $sheet->mergeCells('AX1:AY1');

        $sheet->setCellValue('AZ1', 'Imex Terima Marine Cargo FOB'); 
        $sheet->mergeCells('AZ1:AZ2');

        $sheet->setCellValue('BA1', 'PPJK Teima Marine Cargo'); 
        $sheet->mergeCells('BA1:BA2');

        $sheet->setCellValue('BB1', 'L/C'); 
        $sheet->mergeCells('BB1:BC1');

        $sheet->setCellValue('BD1', 'PPJK'); 
        $sheet->mergeCells('BD1:BD2');

        $sheet->setCellValue('BE1', 'Surat Kuasa'); 
        $sheet->mergeCells('BE1:BF1');

        $sheet->setCellValue('BG1', 'Pemberitahuan Impor Barang (PIB)'); 
        $sheet->mergeCells('BG1:BH1');

        $sheet->setCellValue('BI1', 'KRUS'); 
        $sheet->mergeCells('BI1:BI2');

        $sheet->setCellValue('BJ1', 'No'); 
        $sheet->mergeCells('BJ1:BJ2');

        $sheet->setCellValue('BK1', 'Tarif %'); 
        $sheet->mergeCells('BK1:BM1');

        $sheet->setCellValue('BN1', 'PDRI Bayar'); 
        $sheet->mergeCells('BN1:BQ1');

        $sheet->setCellValue('BR1', 'Keterangan'); 
        $sheet->mergeCells('BR1:BR2');

        $sheet->setCellValue('BS1', 'Keterangan'); 
        $sheet->mergeCells('BS1:BS2');

        $sheet->setCellValue('BT1', 'O-15'); 
        $sheet->mergeCells('BT1:BU1');

        $sheet->setCellValue('BV1', 'BPN'); 
        $sheet->mergeCells('BV1:BX1');

        $sheet->setCellValue('BY1', 'SPPB'); 
        $sheet->mergeCells('BY1:BZ1');

        $sheet->setCellValue('CA1', 'Date'); 
        $sheet->mergeCells('CA1:CA2');

        $sheet->setCellValue('CB1', 'Date'); 
        $sheet->mergeCells('CB1:CB2');

        $sheet->setCellValue('CC1', 'Lokasi'); 
        $sheet->mergeCells('CC1:CC2');

        $sheet->setCellValue('CD1', 'Nama'); 
        $sheet->mergeCells('CD1:CD2');

        $sheet->setCellValue('CE1', 'Memo Warehousing'); 
        $sheet->mergeCells('CE1:CF1');

        $sheet->setCellValue('CG1', 'M03B'); 
        $sheet->mergeCells('CG1:CH1');

        $sheet->setCellValue('CI1', 'Biaya'); 
        $sheet->mergeCells('CI1:CK1');

        $sheet->setCellValue('CL1', 'Total INVOICE (PPN 10%)'); 
        $sheet->mergeCells('CL1:CL2');

        $sheet->setCellValue('CM1', 'BILLING DOK'); 
        $sheet->mergeCells('CM1');

        $sheet->setCellValue('CN1', 'SHIPPING DOK'); 
        $sheet->mergeCells('CN1');

        $sheet->setCellValue('CO1', 'IFS'); 
        $sheet->mergeCells('CO1:CO2');

        // HEADER BARIS 2 (Subheader)
        $sheet->setCellValue('B2', 'PIB');
        $sheet->setCellValue('C2', 'Date');

        $sheet->setCellValue('I2', 'Status Dokumen');
        $sheet->setCellValue('J2', 'Permasalahan');

        $sheet->setCellValue('K2', 'Asli Date');
        $sheet->setCellValue('L2', 'Copy Date');
        $sheet->setCellValue('M2', 'Jarak');

        $sheet->setCellValue('N2', 'Peti Kemas');
        $sheet->setCellValue('O2', 'CONT');
        $sheet->setCellValue('P2', 'Type');
        $sheet->setCellValue('Q2', 'Satuan');

        $sheet->setCellValue('T2', 'Kapal');
        $sheet->setCellValue('U2', 'Date');

        $sheet->setCellValue('X2', 'PC');
        $sheet->setCellValue('Y2', 'Thn');
        $sheet->setCellValue('Z2', 'Name');
        $sheet->setCellValue('AA2', 'Code');

        $sheet->setCellValue('AE2', 'No');
        $sheet->setCellValue('AF2', 'Date');

        $sheet->setCellValue('AG2', 'No');
        $sheet->setCellValue('AH2', 'Date');
        $sheet->setCellValue('AI2', 'Valuta');
        $sheet->setCellValue('AJ2', 'Incoterm 2010');
        $sheet->setCellValue('AK2', 'Freight');
        $sheet->setCellValue('AL2', 'Asuransi');
        $sheet->setCellValue('AM2', 'Nilai 1');
        $sheet->setCellValue('AN2', 'Nilai 2');
        $sheet->setCellValue('AO2', 'Keterangan Lain');

        $sheet->setCellValue('AS2', 'No');
        $sheet->setCellValue('AT2', 'Date');
        $sheet->setCellValue('AU2', 'Forwarding');

        $sheet->setCellValue('AV2', 'No');
        $sheet->setCellValue('AW2', 'Date');

        $sheet->setCellValue('AX2', 'No');
        $sheet->setCellValue('AY2', 'Date');

        $sheet->setCellValue('BB2', 'No');
        $sheet->setCellValue('BC2', 'Date');

        $sheet->setCellValue('BE2', 'No');
        $sheet->setCellValue('BF2', 'Date');

        $sheet->setCellValue('BG2', 'AJU');
        $sheet->setCellValue('BH2', 'DATE');

        $sheet->setCellValue('BK2', 'BM');
        $sheet->setCellValue('BL2', 'PPN');
        $sheet->setCellValue('BM2', 'PPh');

        $sheet->setCellValue('BN2', 'BM');
        $sheet->setCellValue('BO2', 'PPN');
        $sheet->setCellValue('BP2', 'PPh');
        $sheet->setCellValue('BQ2', 'Total');

        $sheet->setCellValue('BT2', 'No');
        $sheet->setCellValue('BU2', 'Date');

        $sheet->setCellValue('BV2', 'Date');
        $sheet->setCellValue('BW2', 'No NTPN Pajak');
        $sheet->setCellValue('BX2', 'Bank');

        $sheet->setCellValue('BY2', 'No');
        $sheet->setCellValue('BZ2', 'Date');

        $sheet->setCellValue('CE2', 'No');
        $sheet->setCellValue('CF2', 'Date');

        $sheet->setCellValue('CG2', 'No');
        $sheet->setCellValue('CH2', 'Date');

        $sheet->setCellValue('CI2', 'Storage');
        $sheet->setCellValue('CJ2', 'Demurrage / Detention');
        $sheet->setCellValue('CK2', 'Customs Clearance');

        $sheet->setCellValue('CM2', 'SUDAH DISCAN');
        $sheet->setCellValue('CN2', 'SUDAH DISCAN');

        // DATA MULAI DARI BARIS 3
        $sheet->fromArray($data, null, 'A3');

        // styling header biar rapi
        $sheet->getStyle('A1:CP2')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A1:CP2')->getFont()->setBold(true);

        // export
        $writer = new Xlsx($spreadsheet);
        $filename = 'sc1_data.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}
