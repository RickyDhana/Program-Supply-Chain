<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Chain Monitoring - PT PAL</title>

    {{-- DEPENDENSI UNTUK TAMPILAN & FUNGSI --}}

    {{-- 1. TailwindCSS untuk styling modern --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- 2. DataTables CSS untuk styling tabel (Paging, Search, dll) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    {{-- Kustomisasi kecil untuk membuat DataTables cocok dengan tema gelap --}}
    <style>
        /* Mengubah warna teks dan background pada elemen DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #d1d5db !important; /* Warna teks abu-abu terang */
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #6b7280 !important; /* Warna teks lebih redup saat disabled */
        }
        .dataTables_wrapper .dataTables_filter input {
            background-color: #1f2937; /* Background input search */
            border: 1px solid #4b5563;
            color: #d1d5db;
        }
    </style>
</head>

<body class="bg-[#0a1730] text-white font-sans">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-[#1c2e55] to-[#0a1730] shadow-md mb-8">
        <div class="container mx-auto flex justify-between items-center px-6 py-5">
            <div>
                <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" class="h-12 md:h-14">
            </div>
            <nav class="flex items-center space-x-6">
                <a href="/" class="hover:text-gray-300 transition">Home</a>
                <a href="/login" class="border border-white px-4 py-2 rounded-md hover:bg-white hover:text-[#0a1730] transition text-sm">
                    Login
                </a>
            </nav>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center sm:text-left">
            Supply Chain Monitoring
        </h1>

        <div class="bg-[#0f2041] p-4 sm:p-6 rounded-lg shadow-xl">
            <div class="overflow-x-auto">
                <table id="userTable" class="min-w-full text-sm" style="width:100%">
                    <thead class="bg-[#1e2a47]">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-center tracking-wider">No</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Nopen PIB</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Nopen Date</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Description of Goods</th>
                            <th class="px-4 py-3 font-semibold text-center tracking-wider">Dokumen Status</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Port of Loading</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Date Port of Loading</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Place Of Delivery</th>
                            <th class="px-4 py-3 font-semibold text-left tracking-wider">Estimasi Date Surabaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1e2a47]">
                        @foreach($data as $row)
                        <tr class="hover:bg-[#13264a] transition-colors duration-200">
                            <td class="px-4 py-3 whitespace-nowrap text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $row->Nopen_PIB }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($row->Nopen_Date)->format('d M Y') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $row->DescriptionofGoods_Matrial }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                @php
                                    $status = strtolower($row->Dokumen_StatusDokumen);
                                    $badgeClass = 'bg-gray-700 text-gray-200'; // Default
                                    if (str_contains($status, 'delivered') || str_contains($status, 'selesai')) {
                                        $badgeClass = 'bg-green-900 text-green-200';
                                    } elseif (str_contains($status, 'shipment') || str_contains($status, 'perjalanan')) {
                                        $badgeClass = 'bg-yellow-900 text-yellow-200';
                                    } elseif (str_contains($status, 'process') || str_contains($status, 'proses')) {
                                        $badgeClass = 'bg-blue-900 text-blue-200';
                                    }
                                @endphp
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $badgeClass }}">
                                    {{ $row->Dokumen_StatusDokumen }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $row->PortofLoading_Kapal }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($row->Date_PortofLoading)->format('d M Y') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $row->PlaceOfDelivery }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($row->Estimasi_DateSurabaya)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DEPENDENSI JAVASCRIPT --}}
    {{-- Urutan penting: jQuery dulu, baru DataTables --}}

    {{-- 1. jQuery (wajib untuk DataTables) --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    {{-- 2. DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- 3. Skrip inisialisasi DataTables Anda --}}
    <script>
$(document).ready(function() {
    var table = $('#userTable').DataTable({
        scrollX: true,
        paging: true,
        pageLength: 20,
        lengthChange: false,
        ordering: false,
        dom: '<"flex justify-center mb-4"f>rt<"flex justify-between mt-4"ip>'
    });

    // Tambahkan styling Tailwind untuk input search
    $('div.dataTables_filter input').addClass('px-4 py-2 rounded-lg bg-transparent border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white');

    // Tambahkan placeholder yang lebih informatif
    $('div.dataTables_filter input').attr('placeholder');
});
</script>
</body>
</html>