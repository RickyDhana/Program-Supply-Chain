<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply Chain Monitoring - PT PAL</title>

    {{-- DEPENDENSI UNTUK TAMPILAN & FUNGSI --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #d1d5db !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #6b7280 !important;
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
    <main class="flex-grow flex flex-col items-center justify-center text-center px-4 mt-28">
        <h1 class="text-3xl md:text-4xl font-bold mb-8">
            MONITORING IMPOR EKSPOR
        </h1>

        {{-- Search box custom --}}
        <div class="flex w-full max-w-md space-x-2 mb-24">
            <input type="text" id="customSearchBox" placeholder="Find Material"
                class="w-full px-4 py-2 rounded-md bg-transparent border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button id="searchButton" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition">
                Find
            </button>
        </div>
    </main>

    <div class="bg-[#0f2041] p-4 sm:p-6 rounded-lg shadow-xl">
        <div class="overflow-x-auto">
            <table id="userTable" class="min-w-full text-sm" style="width:100%">
                <thead class="bg-[#1e2a47]">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">No</th>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">Description of Goods</th>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">Code Project</th>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">Date Port of Loading</th>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">Estimasi Date Surabaya</th>
                        <th class="px-4 py-3 font-semibold text-center tracking-wider">Dokumen Status</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1e2a47]">
                    @foreach($data as $row)
                    <tr class="hover:bg-[#13264a] transition-colors duration-200">
                        <td class="px-4 py-3 whitespace-nowrap text-center">{{ $row->No }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">{{ $row->DescriptionofGoods_Matrial }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">{{ $row->Code_Project }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">{{ optional($row->Date_PortofLoading ? \Carbon\Carbon::parse($row->Date_PortofLoading) : null)->format('d M Y') ?? '-' }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">{{ optional($row->Date_PortofLoading ? \Carbon\Carbon::parse($row->Estimasi_DateSurabaya) : null)->format('d M Y') ?? '-' }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">
                            @php
                            $status = strtolower($row->Dokumen_StatusDokumen);
                            $badgeClass = 'bg-gray-700 text-gray-200';
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- DEPENDENSI JAVASCRIPT --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#userTable').DataTable({
                scrollX: true,
                paging: true,
                pageLength: 20,
                lengthChange: false,
                ordering: false,
                dom: 'rt<"flex justify-between mt-4"ip>' // ❌ hilangkan search bawaan
            });

            // Fungsi search pakai box custom
            $('#searchButton').on('click', function(e) {
                e.preventDefault();
                table.search($('#customSearchBox').val()).draw();
            });

            // Enter untuk langsung search
            $('#customSearchBox').on('keyup', function(e) {
                if (e.key === 'Enter') {
                    table.search(this.value).draw();
                }
            });
        });
    </script>

</body>

</html>