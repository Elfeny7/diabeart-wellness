@extends('dashboard.header')

@section('title', 'Admin')

@section('main-content')

<br><br><br><br>
    <!-- notif -->
    <div class="grid sticky top-[100px] justify-items-center z-50">
        <div class="absolute">
            @include('toast.toast')
        </div>
    </div>
    <!-- search -->
    <div class="flex pb-4 bg-white dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <form method="GET">
                    <div class="flex">
                        <div class="mr-4">
                            <!-- Cari/Filter berdasarkan Rating -->
                            <div class="mb-3">
                                <label for="rating">Pilih Rating:</label>
                                <select name="rating" id="rating">
                                    <option value="">Semua Rating</option>
                                    <option value="1">1 Bintang</option>
                                    <option value="2">2 Bintang</option>
                                    <option value="3">3 Bintang</option>
                                    <option value="4">4 Bintang</option>
                                    <option value="5">5 Bintang</option>
                                </select>
                            </div>
                        </div>
                        <div class="mr-4">
                            <!-- Cari/Filter berdasarkan ID Produk -->
                            <div class="mb-3">
                                <label for="id_produk">Pilih ID Produk:</label>
                                <select name="id_produk" id="id_produk">
                                    <option value="">Semua ID Produk</option>
                                    @foreach ($produk as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->id }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="p-2.5 ml-0 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </div>
                        </div>
                </form>
            </div>
    </div>
    <!-- tabel -->
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-green-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Rating
                </th>
                <th scope="col" class="px-6 py-3">
                    Komentar
                </th>
                <th scope="col" class="px-6 py-3">
                    ID User
                </th>
                <th scope="col" class="px-6 py-3">
                    ID Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <!-- Content -->
        <tbody>
            @foreach ($ulasan as $ulasans)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-yellow-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $ulasans->id }}
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $ulasans->rating }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $ulasans->komentar }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $ulasans->id_users }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $ulasans->id_produk }}
                    </td>
                    <td class="px-6 py-4">
                        <!-- Hide Comment -->
                        <form method="POST" action="{{ route('review.update', $ulasans->id) }}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="komentar" value="Berdasarkan kebijakan layanan kami, komentar ini disembunyikan karena berpotensi atau mengandung kata yang menyinggung, tidak sopan, dan/ hal-hal kurang pantas lainnya. (Mohon untuk menuliskan ulasan anda secara bijak - Tim Diabeart Wellness) ">
                                <!-- {{-- modal --}} -->
                                <a class="font-medium text-white dark:white"><button data-modal-target="popup-modal{{$ulasans->id}}" data-modal-toggle="popup-modal{{$ulasans->id}}" class="bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-2 mr-2 mb-2 dark:focus:ring-yellow-900 justify-content-end" type="button">
                                    Hide Comment
                                </button></a>
                                <div id="popup-modal{{$ulasans->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal{{$ulasans->id}}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda Yakin Ingin Menyembunyikan Komentar?</h3>
                                                <button data-modal-hide="popup-modal{{$ulasans->id}}" type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                    Yakin
                                                </button>
                                                <button data-modal-hide="popup-modal{{$ulasans->id}}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                    Tidak
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <!-- Review Details -->
                        <button id="showReviewButton" data-modal-toggle="showReviewModal{{ $ulasans->id }}" class="block text-white bg-green-400 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-10 py-2 mr-2 mb-2 dark:focus:ring-green-900 justify-content-end" type="button">
                            Detail
                        </button>
                        <!-- Modal body -->
                        <div id="showReviewModal{{ $ulasans->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                <!-- Modal content -->
                                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                    <!-- Modal header -->
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Review Details
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="showReviewModal{{ $ulasans->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="flex">
                                        <div class="w-1/2 pr-4">
                                            <label for="idUlasan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Ulasan</label>
                                            <p>{{ $ulasans->id }}</p> <br>
                                            <label for="idProduk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Produk</label>
                                            <p>{{ $ulasans->id_produk }}</p> <br>
                                            <label for="rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                                            <p>{{ $ulasans->rating }}</p> <br>
                                            <label for="komentar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Komentar</label>
                                            <p>{{ $ulasans->komentar }}</p> <br>
                                            <label for="idUser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID User</label>
                                            <p>{{ $ulasans->id_users }}</p> <br>
                                            <label for="namaUser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama User</label>
                                            <p>{{ $ulasans->user->name ?? 'User Telah Dihapus' }}</p> <br>
                                    </div>
                                    <div class="w-1/2 pl-4">
                                        <h4 class="text-lg font-semibold text-black dark:text-white">{{ $ulasans->produk->nama }}</h4>
                                        <img class="w-full h-auto mt-4" src="{{ asset('storage/'.$ulasans->produk->gambar) }}" alt="Gambar Produk">
                                    </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <!-- paginantion -->
    {{$ulasan->links()}}
    
@endsection