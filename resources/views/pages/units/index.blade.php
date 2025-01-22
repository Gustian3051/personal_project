@extends('layouts.app')

@section('content')
    <div class="p-1 sm:ml-64 dark:bg-gray-900">
        <div class="container">
            <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-7">
                <div class=" mb-4">
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Satuan</h1>
                </div>

                {{-- MAIN CONTENT --}}
                <div
                    class="p-4 mb-4 rounded bg-gray-50 dark:bg-gray-800 dark:bg-gray-800 border-gray-200 dark:border-gray-700">

                    <div class="flex items-center justify-between mb-4">
                        <!-- Kiri: Tambah dan Import -->
                        <div class="flex items-center gap-2 md:gap-4 me-2">
                            <button data-modal-target="add-modal" data-modal-toggle="add-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
                                </svg>
                            </button>
                            @include('pages.units.utils.modal-add')
                            <button data-modal-target="import" data-modal-toggle="static-modal"
                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M15.53 10.47a.75.75 0 0 0-1.06 0l-1.72 1.72V4a.75.75 0 0 0-1.5 0v8.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 0 0 0-1.06"
                                        clip-rule="evenodd" />
                                    <path fill="currentColor"
                                        d="M17.748 12c-.448 0-.84.274-1.157.591l-3 3a2.25 2.25 0 0 1-3.182 0l-3-3C7.092 12.274 6.7 12 6.252 12H4a8 8 0 1 0 16 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Kanan: Search -->
                        <form action="{{ route('unit.index') }}" method="GET" class="flex items-center max-w-sm">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="search" value="{{ request('search') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Cari data..." />
                            </div>
                            <button type="submit"
                                class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </form>
                    </div>

                    <div class="relative overflow-x-auto sm:rounded-lg">
                        @include('pages.stocks.table')
                    </div>
                    <div class="md:my-4 flex justify-center" id="stocksTable">
                        {{ $stocks->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('[role="alert"]');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // Hapus elemen setelah animasi
                }, 3000); // Alert hilang setelah 3 detik
            }
        });


        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang berhubungan dengan satuan ini akan ikut dihapus. Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
