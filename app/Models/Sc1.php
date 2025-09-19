<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sc1 extends Model
{
    use HasFactory;

    protected $table = 'sc1';
    public $timestamps = false;     // ✅ tabel tidak punya created_at / updated_at
    protected $primaryKey = 'No'; // 👈 tambahkan ini


    protected $fillable = [
        'No',
        'Nopen_PIB',
        'Nopen_Date',
        'DescriptionofGoods_Matrial',
        'Code_Project',
        'FasilitasMITA_SP01',
        'Jalur',
        'COO_BarangAsal',
        'Dokumen_StatusDokumen',
        'Dokumen_Permasalahan',
        'Terima_AsliDate',
        'Terima_CopyDate',
        'Terima_Jarak',
        'Jumlah_PetiKemas',
        'Jumlah_Cont',
        'Jumlah_Type',
        'Jumlah_Satuan',
        'Gross_Weight',
        'Measurement',
        'PortofLoading_Kapal',
        'Date_PortofLoading',
        'PlaceOfDelivery',
        'Estimasi_DateSurabaya',
        'Po_Pc',
        'Po_Thn',
        'Po_Name',
        'Po_Code',
        'Shipper_Vendor',
        'Vessel_Flig',
        'KPPBC',
        'AWB_No',
        'AWB_Date',
        'Invoice_No',
        'Invoice_Date',
        'Invoice_Valuta',
        'Invoice_Incoterm',
        'invoice_Freight',   // ✅ huruf kecil sesuai SQL
        'Invoice_Asurasi',
        'Invoice_Nilai1',
        'Invoice_Nilai2',
        'Invoice_Keterangan',
        'Po_Nilai',
        'KETERANGAN_1',
        'Nilai_Idr',
        'Shipment_No',
        'Shipment_Date',
        'Shipment_Forwarding',
        'MemoPenerbitanPolis_No',
        'MemoPenerbitanPolis_Date',
        'MarineCargoFOB_No',
        'MarineCargoFOB_Date',
        'ImexTerimaMarineCargoFOB_Date',
        'PPJKTeimaMarineCargo_Date',
        'Lc_No',
        'Lc_Date',
        'Ppjk_Custom',
        'SuratKuasa_No',
        'SuratKuasa_Date',
        'PIB_AJU',
        'PIB_Date',
        'Krus_NDPBM',
        'No_HS',
        'Tarif_BM',
        'Tarif_PPN',
        'Tarif_Pph',
        'PdriBayar_BM',
        'PdriBayar_PPN',
        'PdriBayar_Pph',
        'PdriBayar_Total',
        'Keterangan_Consignee',
        'KETERANGAN_2',
        'O15_No',
        'O15_Date',
        'BPN_Date',
        'BPN_noNTPNPajak',
        'BPN_Bank',
        'SPPB_No',
        'SPPB_Date',
        'Date_BC11',
        'Date_InPal',
        'LokasiBarang',
        'Nama_Penerima',
        'MemoWarehosing_No',
        'MemoWarehosing_Date',
        'M03B_No',
        'M03B_Date',
        'Biaya_Storage',
        'Biaya_Demurrage',
        'Biaya_CustomsClearnce',
        'Total_Invoice',
        'BillingDok_SudahDiscan',
        'ShippingDok_SudahDiscan',
        'IFS',
    ];

    // 🔑 Ambil semua kolom + tipe data
    public static function getAllColumns()
    {
        $columns = DB::select("SHOW COLUMNS FROM sc1");
        $result = [];
        foreach ($columns as $col) {
            $result[$col->Field] = $col->Type;
        }
        return $result;
    }
}
