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

    <style>
        :root {
            --main-bg: #132036;
            --header-bg: #1c2e55;
            --border-color: #34425A;
            --frozen-bg: #1f2e4d;
        }
        body {
            background-color: var(--main-bg);
        }
        th, td {
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
            /* Mengembalikan padding default agar tidak terlalu mepet */
            padding: 1rem 0;
        }
        .card-body {
            padding: 0;
        }

        /* Kustomisasi DataTables */
        .table-dark {
            --bs-table-bg: var(--main-bg);
            --bs-table-border-color: var(--border-color);
        }
        #sc1Table thead {
            background-color: var(--header-bg);
        }
        .dtfc-fixed-left,
        .dtfc-fixed-right {
            background-color: var(--frozen-bg) !important;
        }

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
                  <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" style="height: 50px;">
                </a>
            </div>
            <nav class="d-flex align-items-center gap-3">
                @auth
                    {{-- Tampilan saat user sudah login --}}
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    {{-- Tampilan saat user belum login --}}
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                @endauth
            </nav>
        </div>
    </header>
    <main class="container-fluid">
        <div class="card">
            {{-- ========================================================== --}}
            {{-- BAGIAN INI TELAH DIUBAH --}}
            {{-- ========================================================== --}}
            <div class="card-header">
                <h4 class="mb-3">
                    <i class="fas fa-database me-2"></i> Dashboard Admin
                </h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fas fa-plus me-2"></i> Tambah Data
                </button>
            </div>
            {{-- ========================================================== --}}
            {{-- AKHIR BAGIAN YANG DIUBAH --}}
            {{-- ========================================================== --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="sc1Table" class="table table-dark table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                @foreach($columns as $field)
                                    <th class="text-uppercase text-center align-middle">{{ $field }}</th>
                                @endforeach
                                <th class="text-uppercase text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                @foreach($columns as $field)
                                    <td class="align-middle">{{ $row->$field }}</td>
                                @endforeach
                                <td class="text-center align-middle">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $row->No }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.delete', ['No' => $row->No]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="modalEdit{{ $row->No }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.update', ['No' => $row->No]) }}" method="POST">
                                            @csrf
                                            <div class="modal-header border-bottom border-secondary">
                                                <h5 class="modal-title">Edit Data No {{ $row->No }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body row g-3" style="max-height:70vh; overflow-y:auto;">
                                                @foreach($columns as $field)
                                                    @if($field !== 'No')
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{ $field }}</label>
                                                        <input type="text" name="{{ $field }}" class="form-control" value="{{ $row->$field }}">
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer border-top border-secondary">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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
                        @foreach($columns as $field)
                            @if($field !== 'No')
                            <div class="col-md-6">
                                <label class="form-label">{{ $field }}</label>
                                <input type="text" name="{{ $field }}" class="form-control">
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

    <script>
    $(document).ready(function() {
        $('#sc1Table').DataTable({
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            pageLength: 20,
            lengthChange: false,
            ordering: false,
            fixedColumns: {
                left: 4,
                right: 1
            }
        });
    });
    </script>
</body>
</html>