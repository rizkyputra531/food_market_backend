<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kas Keluar &raquo; {{ $item->name }} &raquo; Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto px-4 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    @if ($errors->any())
                        <div class="mb-5" role="alert">
                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                There's something wrong!
                            </div>
                            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                                <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                </p>
                            </div>
                        </div>
                    @endif
                    <form class="w-full" action="{{ route('kaskeluar.update',  $item->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Nama
                                </label>
                                <input value="{{ old('name') ?? $item->name }}" name="name"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="text" placeholder="Nama Barang">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Jenis Pengeluaran
                                </label>
                                <select name="jenis_pengeluaran" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="{{ old('jenis_pengeluaran') ?? $item->jenis_pengeluaran }}" selected>{{ old('jenis_pengeluaran') ?? $item->jenis_pengeluaran }}</option>

                                    <option value="Produk">Produk</option>
                                    <option value="Utility">Utility</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Retribusi">Retribusi</option>
                                    <option value="Pemeliharaan">Pemeliharaan</option>

                                </select>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Supplier
                                </label>
                                <input value="{{ old('supplier') ?? $item->supplier}}" name="supplier"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="text" placeholder="Supplier">
                            </div>
                        </div>
                        
                        
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Tanggal Pembelian
                                </label>
                                <input value="{{ old('tanggal') ?? $item->tanggal }}" name="tanggal"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="date" placeholder="Food Price">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Quantity
                                </label>
                                <input value="{{ old('quantity') ?? $item->quantity}}" name="quantity"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="Quantity">
                            </div>

                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Harga
                                </label>
                                <input value="{{ old('harga') ?? $item->harga}}" name="harga"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" min="0" placeholder="Harga">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Total
                                </label>
                                <input value="{{ old('total') ?? $item->total }}" name="total"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="number" placeholder="Total">
                            </div>

                        </div>


                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save Food
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
