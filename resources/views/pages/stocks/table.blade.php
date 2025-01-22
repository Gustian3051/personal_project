<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                No
            </th>
            <th scope="col" class="px-6 py-3">
                Nama Produk
            </th>
            <th scope="col" class="px-6 py-3">
                Stok Total
            </th>
            <th scope="col" class="px-6 py-3">
                Stok Masuk
            </th>
            <th scope="col" class="px-6 py-3">
                Stok Keluar
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody>
        @if ($stocks->isEmpty())
            <tr class="bg-white border-b dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                <td colspan="5" class="px-6 py-4 text-center">Tidak ada data</td>
            </tr>
        @endif
        @foreach ($stocks as $data)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td scope="col" class="px-6 py-3">
                    {{ $loop->iteration }}
                </td>
                <td scope="col" class="px-6 py-3">
                    {{ $data->product->name }}
                </td>
                <td scope="col" class="px-6 py-3">
                    {{ $data->quantity }}
                </td>
                <td scope="col" class="px-6 py-3">
                    {{ $data->in_stock ?? '-' }}
                </td>
                <td scope="col" class="px-6 py-3">
                    {{ $data->out_stock ?? '-' }}
                </td>
                <td scope="col" class="flex items-center gap-2 px-6 py-3 justify-center">

                    <div>
                        <form id="delete-form-{{ $data->id }}" action="{{ route('stock.destroy', $data->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $data->id }})"
                                class="flex items-center px-1 py-1 text-sm text-white bg-red-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/></svg>
                            </button>
                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
