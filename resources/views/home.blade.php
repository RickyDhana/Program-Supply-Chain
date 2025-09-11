<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring IMEX</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#0a1730] text-white font-sans flex flex-col min-h-screen">

    <header class="bg-gradient-to-r from-[#1c2e55] to-[#0a1730] shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-5">
            <div class="flex items-center">
                <div>
                    <img src="{{ asset('images/pal-logo.png') }}" alt="PAL Indonesia" class="h-17 md:h-19">
                </div>
            </div>

            <nav class="flex items-center space-x-6">
                <a href="/" class="hover:text-gray-300 transition">Home</a>
                <a href="/login" class="border border-white px-4 py-2 rounded-md hover:bg-white hover:text-[#0a1730] transition text-sm">
                    Log In
                </a>
            </nav>
        </div>
    </header>


    <main class="flex-grow flex flex-col items-center justify-center text-center px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-8">
            MONITORING IMPOR <br> EKSPOR
        </h1>

        <form action="/search" method="GET" class="flex w-full max-w-md space-x-2">
            <input type="text" name="search" placeholder="Find Material"
                class="w-full px-4 py-2 rounded-md bg-transparent border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition">
                Find
            </button>
        </form>
    </main>

    <div class="w-full px-4 md:px-8 lg:px-16 pb-12">
        <div class="overflow-x-auto">
            <table class="min-w-full text-center">
                <thead class="bg-[#1e2a47]">
                    <tr>
                        <th class="px-6 py-3 font-semibold tracking-wider">DESCRIPTION OF GOODS</th>
                        <th class="px-6 py-3 font-semibold tracking-wider">VENDOR</th>
                        <th class="px-6 py-3 font-semibold tracking-wider">INFORMATION</th>
                        <th class="px-6 py-3 font-semibold tracking-wider">STATUS</th>
                    </tr>
                </thead>
                <tbody class="bg-[#0f2041]">

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Propeller Shaft Type-A</td>
                        <td class="px-6 py-4 whitespace-nowrap">Marine Tech Gmbh</td>
                        <td class="px-6 py-4 whitespace-nowrap">PO: 12345, ETA: 25 Sep 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-900 text-green-200">
                                Delivered
                            </span>
                        </td>
                    </tr>

                    <tr class="bg-[#13264a]">
                        <td class="px-6 py-4 whitespace-nowrap">Navigation Radar System</td>
                        <td class="px-6 py-4 whitespace-nowrap">Raytheon Anschütz</td>
                        <td class="px-6 py-4 whitespace-nowrap">PO: 67890, ETA: 15 Oct 2025</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-yellow-900 text-yellow-200">
                                On Shipment
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>


    <footer class="text-center py-10 text-gray-500">
        © IMEX 2025
    </footer>

</body>

</html>