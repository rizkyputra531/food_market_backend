<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>
     <div class="mt-10 mb-10">
        <div class="bg-white max-w-7xl mx-auto px-4 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-4 -mb-4 md:mb-0">

                    <div class="w-full md:w-5/6 px-4 mb-4 md:mb-0">
                        <div class="flex flex-wrap mb-3">
                            <div class="w-3/6 mb-10">

                                <div class="text-xl font-bold">Laba Bersih <small>(Laba Kotor - Kas Keluar)</small>
                                    <hr />
                                </div>

                            </div>
                            

                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-1/6">

                                <div class="text-sm">Total Laba Kotor</div>
                                <div class="text-xl font-bold">Rp. {{ number_format($total_laba) }} </div>
                            </div>
                        
                            <div class="w-2/6">
                                <div class="text-sm">Total Kas Keluar</div>
                                <div class="text-xl font-bold">- Rp. {{ number_format($total_pengeluaran) }}      </div>
                            </div>

                            <div class="w-2/6">
                                <div class="text-sm">Total Laba Bersih</div>
                                <div class="text-xl font-bold">Rp. {{ number_format($laba_bersih) }}</div>
                            </div>
                            


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-10 mt-10">
        <div class="bg-white max-w-7xl mx-auto px-4 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-4 -mb-4 md:mb-0">

                    <div class="w-full md:w-5/6 px-4 mb-4 md:mb-0">
                        <div class="flex flex-wrap mb-3">
                            <div class="w-6/6 mb-10">

                                <div class="text-xl font-bold">Kas Masuk
                                    <hr />
                                </div>

                            </div>

                        </div>

                        <div class="flex flex-wrap mb-3">
                            <div class="w-1/6">

                                <div class="text-sm">Produk Terjual</div>
                                <div class="text-xl font-bold">{{ $quantity }} produk</div>
                            </div>
                            <div class="w-2/6">
                                <div class="text-sm">Total Uang Masuk</div>
                                <div class="text-xl font-bold">Rp. {{ number_format($total) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Total Modal</div>
                                <div class="text-xl font-bold">Rp. {{ number_format($total_modal) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Total Laba Kotor</div>
                                <div class="text-xl font-bold">Rp. {{ number_format($total_laba) }}</div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="mb-10">
        <div class="bg-white max-w-7xl mx-auto px-4 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-4 -mb-4 md:mb-0">

                    <div class="w-full md:w-5/6 px-4 mb-4 md:mb-0">
                        <div class="flex flex-wrap mb-3">
                            <div class="w-3/6 mb-10">

                                <div class="text-xl font-bold">Kas Keluar
                                    <hr />
                                </div>

                            </div>
                            

                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-1/6">

                                <div class="text-sm">Total Pembelian</div>
                                <div class="text-xl font-bold">{{ $jumlah_pembelian }} item</div>
                            </div>
                            <div class="w-2/6">
                                <div class="text-sm">Total Uang Keluar</div>
                                <div class="text-xl font-bold">Rp. {{ number_format($total_pengeluaran) }}</div>
                            </div>
                            


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
   


</x-app-layout>
