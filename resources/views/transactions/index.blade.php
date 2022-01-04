<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="bg-white max-w-7xl mx-auto px-4 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white">
                    <table class="table-auto w-full text-center">
                        <thead>
                            <tr>
                                {{-- <th class="border px-2 py-2">No</th> --}}
                                <th class="border px-6 py-4">ID</th>
                                <th class="border px-6 py-4" width="250px">Food</th>
                                <th class="border px-6 py-4" width="200px">User Email</th>
                                <th class="border px-2 py-2" >Quantity</th>
                                <th class="border px-6 py-4">Total</th>
                                <th class="border px-6 py-4">Status</th>
                                <th class="border px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @forelse($transaction as $item)
                                <tr>

                                    {{-- <td class="border px-6 py-4">{{ $no++ }}</td> --}}
                                    <td class="border px-6 py-4">{{ $item->id }}</td>
                                    <td class="border px-6 py-4 ">{{ $item->food->name }}</td>
                                    <td class="border px-6 py-4 ">{{ $item->user->email }}</td>
                                    <td class="border px-6 py-4">{{ $item->quantity }}</td>
                                    <td class="border px-6 py-4">Rp. {{ number_format($item->total) }}</td>
                                    <td class="border px-6 py-4">{{ $item->status }}</td>
                                    <td class="border px-6 py- text-center">
                                        <a href="{{ route('transactions.show', $item->id) }}"
                                            class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">
                                            View
                                        </a>
                                        <form action="{{ route('transactions.destroy', $item->id) }}" method="POST"
                                            class="inline-block">
                                            {!! method_field('delete') . csrf_field() !!}
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded inline-block">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border text-center p-5">
                                        Data Tidak Ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-5">
                    {{ $transaction->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
