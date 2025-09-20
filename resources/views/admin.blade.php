        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">

        <head>
            <meta charset="UTF-8">
            <title>Admin Dashboard - SC1</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap5.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.bootstrap5.min.css">

            <style>
                :root {
                    --main-bg: #132036;
                    --header-bg: #1c2e55;
                    --header-main-bg: #162647;
                    /* Slightly darker for main headers */
                    --border-color: #34425A;
                    --frozen-bg: #1f2e4d;
                }

                body {
                    background-color: var(--main-bg);
                }

                th,
                td {
                    white-space: nowrap;
                }

                /* Styling untuk Header Baru */
                .site-header {
                    background-color: var(--header-bg);
                    padding: 0.75rem 2rem;
                }

                .site-header .nav-link {
                    color: #dee2e6;
                    font-weight: 500;
                    transition: color 0.2s;
                }

                .site-header .nav-link:hover {
                    color: #ffffff;
                }

                .card {
                    background-color: transparent !important;
                    border: none;
                }

                .card-header {
                    background-color: transparent !important;
                    border-bottom: none !important;
                    padding: 1rem 0;
                }

                .card-body {
                    padding: 0;
                }

                /* Kustomisasi DataTables */
                .table-dark {
                    --bs-table-bg: var(--main-bg);
                    --bs-table-border-color : var(--border-color);
                }

                #sc1Table thead {
                    background-color: var(--header-bg);
                }

                .dtfc-fixed-left,
                .dtfc-fixed-right {
                    background-color: var(--frozen-bg) !important;
                }

                /* ========================================================== */
                /* BAGIAN BARU: Desain untuk header dengan sub-header       */
                /* ========================================================== */
                #sc1Table thead tr:first-child>th {
                    background-color: var(--header-main-bg);
                    border-bottom: 2px solid var(--border-color);
                    vertical-align: middle;
                }

                /* ========================================================== */
                /* AKHIR BAGIAN BARU                                        */
                /* ========================================================== */

                /* Styling Modal */
                .modal-content {
                    background-color: var(--header-bg);
                    border-color: var(--border-color);
                }

                .modal-content .form-control {
                    background-color: #2a3038;
                    color: #f8f9fa;
                    border: 1px solid #495057;
                }

                .modal-content .form-control:focus {
                    border-color: #80bdff;
                    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
                }
            </style>
        </head>

        <body class="text-light">
            <header class="site-header shadow-sm mb-4">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" style="height: 98px;">
                        </a>
                    </div>
                    <nav class="d-flex align-items-center gap-3">
                        @auth
                        {{-- Tampilan saat user sudah login --}}
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                        @endauth
                    </nav>
                </div>
            </header>
            <main class="container-fluid">
                <div class="card">
                    <div class="card-header" class="card gap-100">
                        <h4 class="flex-grow flex flex-col items-center justify-center text-center px-4 mt-28">
                            Dashboard Admin
                        </h4>
                        <div id="header-buttons" class="d-flex gap-2">
                            <!-- Tombol Export Excel Manual -->
                            <a href="{{ route('sc1.export') }}" class="btn btn-success">
                                <i class="fas fa-file-excel me-2"></i> Export Excel
                            </a>

                            <!-- Tombol Tambah Data -->
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                <i class="fas fa-plus me-2"></i> Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sc1Table" class="table table-dark table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">No</th>
                                        <th colspan="2" class="text-center">Nopen</th>
                                        <th rowspan="2" class="text-center">Description of Goods / Matrial</th>
                                        <th rowspan="2" class="text-center">Code Project</th>
                                        <th rowspan="2" class="text-center">Fasilitas MITA / SP01</th>
                                        <th rowspan="2" class="text-center">Jalur</th>
                                        <th colspan="1" class="text-center">COO</th>
                                        <th colspan="2" class="text-center">Dokumen</th>
                                        <th colspan="3" class="text-center">Terima B/L Asli / Copy IMEX Terima</th>
                                        <th colspan="4" class="text-center">Jumlah</th>
                                        <th rowspan="2" class="text-center">Gross Weight (KGS)</th>
                                        <th rowspan="2" class="text-center">Measurement (cbm)</th>
                                        <th colspan="2" class="text-center">Port of Loading</th>
                                        <th rowspan="2" class="text-center">Place of Delivery</th>
                                        <th colspan="1" class="text-center">Estimasi Di Pelabuhan</th>
                                        <th colspan="4" class="text-center">PO</th>
                                        <th rowspan="2" class="text-center">Shipper / Vendor</th>
                                        <th rowspan="2" class="text-center">Vessel / Flig</th>
                                        <th rowspan="2" class="text-center">KPPBC</th>
                                        <th colspan="2" class="text-center">B / L / AWB</th>
                                        <th colspan="9" class="text-center">Invoice</th>
                                        <th rowspan="2" class="text-center">PO Nilai</th>
                                        <th rowspan="2" class="text-center">Keterangan</th>
                                        <th colspan="1" class="text-center">Nilai</th>
                                        <th colspan="3" class="text-center">Shipment Of Instruction (SI)</th>
                                        <th colspan="2" class="text-center">Memo Penerbit Polis (FOB)</th>
                                        <th colspan="2" class="text-center">Marine Cargo FOB</th>
                                        <th colspan="1" class="text-center">Imex Terima Marine Cargo FOB</th>
                                        <th colspan="1" class="text-center">PPJK Teima Marine Cargo</th>
                                        <th colspan="2" class="text-center">L/C</th>
                                        <th colspan="1" class="text-center">PPJK</th>
                                        <th colspan="2" class="text-center">Surat Kuasa</th>
                                        <th colspan="2" class="text-center">Pemberitahuan Impor Barang (PIB)</th>
                                        <th colspan="1" class="text-center">KRUS</th>
                                        <th colspan="1" class="text-center">No</th>
                                        <th colspan="3" class="text-center">Tarif %</th>
                                        <th colspan="4" class="text-center">PDRI Bayar</th>
                                        <th colspan="1" class="text-center">Keterangan</th>
                                        <th rowspan="2" class="text-center">Keterangan</th>
                                        <th colspan="2" class="text-center">O-15</th>
                                        <th colspan="3" class="text-center">BPN</th>
                                        <th colspan="2" class="text-center">SPPB</th>
                                        <th colspan="1" class="text-center">Date</th>
                                        <th colspan="1" class="text-center">Date</th>
                                        <th colspan="1" class="text-center">Lokasi</th>
                                        <th colspan="1" class="text-center">Nama</th>
                                        <th colspan="2" class="text-center">Memo Warehousing</th>
                                        <th colspan="2" class="text-center">M03B</th>
                                        <th colspan="3" class="text-center">Biaya</th>
                                        <th rowspan="2" class="text-center">Total INVOICE (PPN 10%)</th>
                                        <th colspan="2" class="text-center">Dokumen Discan</th>
                                        <th rowspan="2" class="text-center">IFS</th>
                                        <th rowspan="2" class="text-center">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PIB</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">Barang Asal</th>

                                        <th class="text-center">Status Dokumen</th>
                                        <th class="text-center">Permasalahan</th>

                                        <th class="text-center">Asli Date</th>
                                        <th class="text-center">Copy Date</th>
                                        <th class="text-center">Jarak</th>

                                        <th class="text-center">Peti Kemas</th>
                                        <th class="text-center">CONT</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Satuan</th>

                                        <th class="text-center">Kapal</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">Date Surabaya</th>

                                        <th class="text-center">PC</th>
                                        <th class="text-center">Thn</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Code</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Valuta</th>
                                        <th class="text-center">Incoterm 2010</th>
                                        <th class="text-center">Freight</th>
                                        <th class="text-center">Asuransi</th>
                                        <th class="text-center">Nilai 1</th>
                                        <th class="text-center">Nilai 2</th>
                                        <th class="text-center">Keterangan Lain</th>

                                        <th class="text-center">IDR</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Forwarding</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">Date</th>

                                        <th class="text-center">Date</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">Customs</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">AJU</th>
                                        <th class="text-center">DATE</th>

                                        <th class="text-center">NDPBM</th>

                                        <th class="text-center">HS</th>

                                        <th class="text-center">BM</th>
                                        <th class="text-center">PPN</th>
                                        <th class="text-center">PPh</th>

                                        <th class="text-center">BM</th>
                                        <th class="text-center">PPN</th>
                                        <th class="text-center">PPh</th>
                                        <th class="text-center">Total</th>

                                        <th class="text-center">Consignee</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">Date</th>
                                        <th class="text-center">No NTPN Pajak</th>
                                        <th class="text-center">Bank</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">BC.11</th>

                                        <th class="text-center">In PAL</th>

                                        <th class="text-center">Barang</th>
                                        <th class="text-center">Penerima</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">No</th>
                                        <th class="text-center">Date</th>

                                        <th class="text-center">Storage</th>
                                        <th class="text-center">Demurrage / Detention</th>
                                        <th class="text-center">Customs Clearance</th>

                                        <th class="text-center">BILLING DOK</th>
                                        <th class="text-center">SHIPPING DOK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row->No }}</td>
                                        <td>{{ $row->Nopen_PIB }}</td>
                                        <td>{{ $row->Nopen_Date }}</td>
                                        <td>{{ $row->DescriptionofGoods_Matrial }}</td>
                                        <td>{{ $row->Code_Project }}</td>
                                        <td>{{ $row->FasilitasMITA_SP01 }}</td>
                                        <td>{{ $row->Jalur }}</td>
                                        <td>{{ $row->COO_BarangAsal }}</td>
                                        <td>{{ $row->Dokumen_StatusDokumen }}</td>
                                        <td>{{ $row->Dokumen_Permasalahan }}</td>
                                        <td>{{ $row->Terima_AsliDate }}</td>
                                        <td>{{ $row->Terima_CopyDate }}</td>
                                        <td>{{ $row->Terima_Jarak }}</td>
                                        <td>{{ $row->Jumlah_PetiKemas }}</td>
                                        <td>{{ $row->Jumlah_Cont }}</td>
                                        <td>{{ $row->Jumlah_Type }}</td>
                                        <td>{{ $row->Jumlah_Satuan }}</td>
                                        <td>{{ $row->Gross_Weight }}</td>
                                        <td>{{ $row->Measurement }}</td>
                                        <td>{{ $row->PortofLoading_Kapal }}</td>
                                        <td>{{ $row->Date_PortofLoading }}</td>
                                        <td>{{ $row->PlaceOfDelivery }}</td>
                                        <td>{{ $row->Estimasi_DateSurabaya }}</td>
                                        <td>{{ $row->PO_PC }}</td>
                                        <td>{{ $row->PO_Thn }}</td>
                                        <td>{{ $row->PO_Name }}</td>
                                        <td>{{ $row->PO_Code }}</td>
                                        <td>{{ $row->Shipper_Vendor }}</td>
                                        <td>{{ $row->Vessel_Flig }}</td>
                                        <td>{{ $row->KPPBC }}</td>
                                        <td>{{ $row->AWB_No }}</td>
                                        <td>{{ $row->AWB_Date }}</td>
                                        <td>{{ $row->Invoice_No }}</td>
                                        <td>{{ $row->Invoice_Date }}</td>
                                        <td>{{ $row->Invoice_Valuta }}</td>
                                        <td>{{ $row->Invoice_Incoterm }}</td>
                                        <td>{{ $row->Invoice_Freight }}</td>
                                        <td>{{ $row->Invoice_Asurasi }}</td>
                                        <td>{{ $row->Invoice_Nilai1 }}</td>
                                        <td>{{ $row->Invoice_Nilai2 }}</td>
                                        <td>{{ $row->Invoice_Keterangan }}</td>
                                        <td>{{ $row->PO_Nilai }}</td>
                                        <td>{{ $row->KETERANGAN_1 }}</td>
                                        <td>{{ $row->Nilai_IDR }}</td>
                                        <td>{{ $row->Shipment_No }}</td>
                                        <td>{{ $row->Shipment_Date }}</td>
                                        <td>{{ $row->Shipment_Forwarding }}</td>
                                        <td>{{ $row->MemoPenerbitanPolis_No }}</td>
                                        <td>{{ $row->MemoPenerbitanPolis_Date }}</td>
                                        <td>{{ $row->MarineCargoFOB_No }}</td>
                                        <td>{{ $row->MarineCargoFOB_Date }}</td>
                                        <td>{{ $row->ImexTerimaMarineCargoFOB_Date }}</td>
                                        <td>{{ $row->PPJKTeimaMarineCargo_Date }}</td>
                                        <td>{{ $row->Lc_No }}</td>
                                        <td>{{ $row->Lc_Date }}</td>
                                        <td>{{ $row->Ppjk_Custom }}</td>
                                        <td>{{ $row->SuratKuasa_No }}</td>
                                        <td>{{ $row->SuratKuasa_Date }}</td>
                                        <td>{{ $row->PIB_AJU }}</td>
                                        <td>{{ $row->PIB_Date }}</td>
                                        <td>{{ $row->Krus_NDPBM }}</td>
                                        <td>{{ $row->No_HS }}</td>
                                        <td>{{ $row->Tarif_BM }}</td>
                                        <td>{{ $row->Tarif_PPN }}</td>
                                        <td>{{ $row->Tarif_PPh }}</td>
                                        <td>{{ $row->PdriBayar_BM }}</td>
                                        <td>{{ $row->PdriBayar_PPN }}</td>
                                        <td>{{ $row->PdriBayar_Pph }}</td>
                                        <td>{{ $row->PdriBayar_Total }}</td>
                                        <td>{{ $row->Keterangan_Consignee }}</td>
                                        <td>{{ $row->KETERANGAN_2 }}</td>
                                        <td>{{ $row->O15_No }}</td>
                                        <td>{{ $row->O15_Date }}</td>
                                        <td>{{ $row->BPN_Date }}</td>
                                        <td>{{ $row->BPN_noNTPNPajak }}</td>
                                        <td>{{ $row->BPN_Bank }}</td>
                                        <td>{{ $row->SPPB_No }}</td>
                                        <td>{{ $row->SPPB_Date }}</td>
                                        <td>{{ $row->Date_BC11 }}</td>
                                        <td>{{ $row->Date_InPal }}</td>
                                        <td>{{ $row->LokasiBarang }}</td>
                                        <td>{{ $row->Nama_Penerima }}</td>
                                        <td>{{ $row->MemoWarehosing_No }}</td>
                                        <td>{{ $row->MemoWarehosing_Date }}</td>
                                        <td>{{ $row->M03B_No }}</td>
                                        <td>{{ $row->M03B_Date }}</td>
                                        <td>{{ $row->Biaya_Storage }}</td>
                                        <td>{{ $row->Biaya_Demurrage }}</td>
                                        <td>{{ $row->Biaya_CustomsClearnce }}</td>
                                        <td>{{ $row->Total_Invoice }}</td>
                                        <td>{{ $row->BillingDok_SudahDiscan }}</td>
                                        <td>{{ $row->ShippingDok_SudahDiscan }}</td>
                                        <td>{{ $row->IFS }}</td>
                                        <td class="text-center">
                                            {{-- [MULAI] Blok Kode yang Diperbarui --}}
                                            <div class="d-flex justify-content-center gap-2">
                                                
                                                {{-- Tombol Edit --}}
                                                <button class="btn btn-warning btn-sm" 
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $row->No }}">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>

                                                {{-- Form untuk Tombol Hapus --}}
                                                <form action="{{ route('admin.delete', ['No' => $row->No]) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </form>

                                            </div>
                                            {{-- [AKHIR] Blok Kode yang Diperbarui --}}
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="modalEdit{{ $row->No }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.update', $row->No) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header border-bottom border-secondary">
                                                        <h5 class="modal-title">Edit Data No {{ $row->No }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body row g-3" style="max-height:70vh; overflow-y:auto;">
                                                        @foreach($columns as $field => $type)
                                                        @if($field !== 'No')
                                                        <div class="col-md-6">
                                                            {{-- Label: nama kolom (underscore jadi spasi) --}}
                                                            <label class="form-label">{{ str_replace('_', ' ', $field) }}</label>

                                                            {{-- Input sesuai tipe data --}}
                                                            @if(str_contains($type, 'date'))
                                                            <input type="date" name="{{ $field }}" class="form-control" value="{{ old($field, $row->$field) }}">
                                                            @elseif(str_contains($type, 'int') || str_contains($type, 'decimal'))
                                                            <input type="number" step="any" name="{{ $field }}" class="form-control" value="{{ old($field, $row->$field) }}">
                                                            @else
                                                            <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $row->$field) }}">
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>

                                                    <div class="modal-footer border-top border-secondary">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            {{-- Modal Tambah --}}
            <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="modal-header border-bottom border-secondary">
                                <h5 class="modal-title">Tambah Data Baru</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body row g-3" style="max-height:70vh; overflow-y:auto;">
                                {{-- Looping semua kolom --}}
                                @foreach($columns as $field => $type)
                                @if($field !== 'No')
                                <div class="col-md-6">
                                    {{-- Ubah underscore jadi spasi --}}
                                    <label class="form-label">{{ str_replace('_', ' ', $field) }}</label>

                                    {{-- Sesuaikan input dengan tipe --}}
                                    @if(str_contains($type, 'date'))
                                    <input type="date" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field) }}">
                                    @elseif(str_contains($type, 'int') || str_contains($type, 'decimal'))
                                    <input type="number" step="any" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field) }}">
                                    @else
                                    <input type="text" name="{{ $field }}" class="form-control @error($field) is-invalid @enderror" value="{{ old($field) }}">
                                    @endif
                                </div>
                                @endif
                                @endforeach
                            </div>

                            <div class="modal-footer border-top border-secondary">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

            <script>
                // Inisialisasi DataTable dan simpan referensinya dalam sebuah variabel
                var table = $('#sc1Table').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                    pageLength: 20,
                    lengthChange: false,
                    ordering: false,
                    fixedHeader: true, // 🔑 ini penting
                    fixedColumns: {
                        left: 4,
                        right: 1
                    },
                    
                    // Hapus 'B' (Buttons) dari konfigurasi DOM karena akan kita pindahkan secara manual
                    // 'f' adalah filter/pencarian, 't' adalah tabel, 'p' adalah paginasi
                    dom: '<"top d-flex justify-content-end"f>t<"bottom d-flex justify-content-end"p>',
                });

                // Pindahkan container tombol yang dibuat oleh DataTables ke div custom kita
                table.buttons().container().appendTo('#header-buttons');
            </script>
        </body>

        </html>