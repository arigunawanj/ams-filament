{{-- WELCOME --}}
<div class="grid grid-cols-1 w-full mb-5 gap-3">
    <div class="max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <span id="salam" class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white"></span>
        <span id="salam" class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
    
        <p id="waktu" class="mb-3 font-normal text-gray-700 dark:text-gray-400">.</p>
    </div>

</div>

{{-- STAT --}}
<div>
    <div class="grid md:grid-cols-2 xl:grid-cols-3 grid-cols-1 w-full mb-5 gap-3">
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Total Barang</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0 Barang</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Total Customer</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0 Customer</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>


            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Total Distributor</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0 Distributor</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>


            </div>
        </div>


    </div>

</div>

{{-- BULANAN --}}
<div>
    <h3 class="text-center mb-5 text-2xl font-bold uppercase">Penjualan Bulan {{ $bulanEkstrak }} - {{ $carbon->year }}</h3>
    <div class="grid md:grid-cols-2 xl:grid-cols-3 grid-cols-1 w-full mb-5 gap-3">
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Total Orderan Bulan Ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0x order</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Transaksi Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-orange-600 dark:text-orange-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                </svg>

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Transaksi Belum Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-blue-700 dark:text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

            </div>
        </div>
    </div>

    <!-- BARIS 2 -->
    <div class="grid md:grid-cols-2 xl:grid-cols-3 grid-cols-1 w-full mb-5 gap-3">
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Barang Terlaris Bulan Ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0x order</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Pembeli Bulan ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-orange-600 dark:text-orange-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                </svg>

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Jumlah Belum Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-blue-700 dark:text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

            </div>
        </div>
    </div>
    

</div>

{{-- KESELURUHAN --}}
<div>
    <h3 class="text-center mb-5 text-2xl font-bold uppercase">Penjualan Keseluruhan</h3>
    <div class="grid md:grid-cols-2 xl:grid-cols-3 grid-cols-1 w-full mb-5 gap-3">
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Total Order Keseluruhan
                    </h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0x order</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Transaksi Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-orange-600 dark:text-orange-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                </svg>

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Transaksi Belum Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-blue-700 dark:text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

            </div>
        </div>
    </div>

     <!-- BARIS 2 -->
     <div class="grid md:grid-cols-2 xl:grid-cols-3 grid-cols-1 w-full mb-5 gap-3">
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Barang Terlaris Bulan Ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">0x order</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Pembeli Bulan ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-orange-600 dark:text-orange-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />
                </svg>

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Jumlah Belum Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp 0</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total 0x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-blue-700 dark:text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

            </div>
        </div>
    </div>
    

</div>

