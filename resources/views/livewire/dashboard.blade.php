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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $jmlbarang }} Barang</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                  </svg>
                  

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Total Customer</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $jmlcust }} Customer</p>
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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $jmldist }} Distributor</p>
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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $orderBulan }}x order</p>
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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. {{ number_format($lunasBulan, 0, '.','.') }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total {{ $jmlLunas }}x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                  </svg>
                  
                  

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Transaksi Belum Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. {{ number_format($belumBulan, 0, '.','.') }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total {{ $jmlBelum }}x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $bulanTerlaris != null ? $bulanTerlaris->nama_barang : '-' }}</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                  </svg>
                  
            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Pembeli Bulan ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $bulanCustomer != null ? $bulanCustomer->nama_customer : '-' }}</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Jumlah Transaksi Bulan Ini</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. {{ number_format($totBulan, 0, '.','.') }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total {{ $jumOrBulan }}x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $jmlOrder }}x order</p>
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
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. {{ number_format($semuaLunas, 0, '.','.') }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total {{ $jumlahLunas }}x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                  </svg>
                  
                  

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Transaksi Belum Lunas</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. {{ number_format($semuaBelum, 0, '.','.') }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total {{ $jumlahBelum }}x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
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
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Barang Terlaris</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $barangTerlaris != null ? $barangTerlaris->nama_barang : '-' }}</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                  </svg>
                  
            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Pelanggan Tetap</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">{{ $customerLangganan != null ? $customerLangganan->nama_customer : '-' }}</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  

            </div>
        </div>
        <div
            class="flex items-center justify-between w-full h-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col">
                <a href="#">
                    <h5 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">Jumlah Transaksi Seluruhnya</h5>
                </a>
                <p class="mb-3 text-xl font-bold text-black dark:text-white">Rp. {{ number_format($jumlahSemua, 0, '.','.') }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Dengan total {{ $jmlOrder }}x pemesanan</p>
            </div>
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                  </svg>
                  

            </div>
        </div>
    </div>
    

</div>

