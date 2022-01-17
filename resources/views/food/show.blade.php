<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Food &raquo; {{ $item->name }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full rounded overflow-hidden shadow-lg px-6 py-6 bg-white">
                <div class="flex flex-wrap -mx-4 -mb-4 md:mb-0">
                    <div class="w-full md:w-1/6 px-4 mb-4 md:mb-0">
                        <img src="{{ $item->picturePath }}" alt="" class="object-cover h-48 w-96">
                    </div>
                    <div class="w-full md:w-5/6 px-4 mb-4 md:mb-0">
                        <div class="flex flex-wrap mb-10">
                            <div class="w-2/6">
                                <div class="text-sm">Product Name</div>
                                <div class="text-lg font-bold">{{ $item->name }}</div>
                            </div>
                            {{-- <div class="w-1/6">
                                <div class="text-sm">Quantity</div>
                                <div class="text-xl font-bold">{{ number_format($item->quantity) }}</div>
                            </div> --}}
                            
                            <div class="w-1/6">
                                <div class="text-sm">Biaya</div>
                                <div class="text-lg font-semibold">Rp. {{ number_format($item->price) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Modal</div>
                                <div class="text-lg font-semibold">Rp. {{ number_format($item->modal) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Laba</div>
                                <div class="text-lg font-semibold">Rp. {{ number_format($item->laba) }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Rate</div>
                                <div class="text-lg font-semibold">{{ ($item->rate) }} +</div>
                            </div>
                            

                        </div>
                        <div class="flex flex-wrap mb-10">
                            <div class="w-2/6">
                                <div class="text-sm">Description</div>
                                <div class="text-lg font-semibold">{{ $item->description }}</div>
                            </div>
                            
                            <div class="w-2/6">
                                <div class="text-sm">Bahan</div>
                                <div class="text-lg font-semibold">{{ $item->ingredients }}</div>
                            </div>
                            <div class="w-1/6">
                                <div class="text-sm">Total Terjual</div>
                                <div class="text-lg font-semibold">{{ number_format($item->total_sold) }} pcs</div>
                            </div>

                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-3/6">
                                <div class="text-sm">Types</div>
                                <div class="text-lg font-semibold">{{ $item->types }}</div>
                            </div>
                            <div class="w-1/6">

                                <a href="{{ route('food.edit', $item->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 rounded block text-center w-full mb-1">
                                    EDIT
                                </a>
                            </div>
                            <div class="w-1/6 ml-2 ">

                                {{-- <a href="#"
                                    class="bg-red-500 hover:bg-blue-700 text-white font-bold px-2 rounded block text-center w-full mb-1">
                                    DELETE
                                </a> --}}
                                <form action="{{ route('food.destroy', $item->id) }}" method="POST"
                                    class="block">
                                    {!! method_field('delete') . csrf_field() !!}
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold px-6 rounded block text-center w-full mb-1">
                                        DELETE
                                    </button>
                                </form>
                            </div>

                        </div>
                        <div class="flex flex-wrap mb-3">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
