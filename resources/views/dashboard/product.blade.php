@extends('dashboard.header')

@section('title', 'Admin')

@section('main-content')
<div class="grid sticky top-[100px] justify-items-center z-50">
    <div class="absolute">
        @include('toast.toast')
    </div>
</div>
<div class="p-4 border-1 rounded-lg mt-14 bg-white">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form action="{{route('product.index')}}" method="get">
            <div class="flex flex-row pb-4 bg-white">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <input type="text" id="table-search" name="search" class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama produk">
                </div>
                <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
            <div class="py-2">
                <button data-modal-target="authentication-modal1" data-modal-toggle="authentication-modal1" class="focus:outline-none text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 justify-content-end" type="button">
                    Add Produk
                </button>
            </div>
        </form>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gambar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        kategori
                    </th>
                    <th scope="col" class="px-12 py-3">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Komposisi
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Karbo
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Protein
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Kalori
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Serat
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Hidden
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Produk as $produk)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $produk->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $produk->nama }}
                    </th>
                    <td class="px-6 py-4">
                        <img src="{{asset('storage/'. $produk->gambar)}}" alt="gambar" class="w-[80px]">
                    </td>
                    <td class="px-6 py-4">
                        @foreach($produk->Kategori as $ktg)
                        {{ $ktg->nama_kategori }}
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        {{ $produk->deskripsi }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $produk->harga }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $produk->komposisi }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $produk->karbo }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $produk->protein }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $produk->kalori }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $produk->serat }}
                    </td>
                    <td class="px-2 py-4">
                        {{ $produk->hidden ?? 'Belum diset' }}
                    </td>
                    <td class="px-6 py-4">
                        <button data-modal-target="authentication-modal{{$produk->id}}" data-modal-toggle="authentication-modal{{$produk->id}}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900 justify-content-end w-[80px]" type="button">
                            Edit
                        </button>
                        <div id="authentication-modal{{$produk->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <form method="post" action="{{ route('product.update', $produk->id) }}" class="relative w-full max-w-md max-h-full" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="authentication-modal{{$produk->id}}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="px-6 py-6 lg:px-8">
                                        <h3 class="mb-4 text-xl font-medium text-gray-900">Masukkan Data Produk</h3>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="nama">Nama</label>
                                            <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-2" value="{{$produk->nama}}">
                                        </div>
                                        <div class="field mb-4">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="kategori">Kategori</label>
                                            <div class="control">
                                                @foreach ($kategori as $kat)
                                                <label class="checkbox">
                                                    <input type="checkbox" name="kategoris[]" value="{{ $kat->id }}" @if(in_array($kat->id, $produk->kategori->pluck('id')->toArray())) checked @endif>
                                                    {{ $kat->nama_kategori }}
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Gambar</label>
                                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mb-4" name="gambar" id="file_input" type="file" value="{{$produk->gambar}}">
                                            <img src="{{asset('storage/'. $produk->gambar)}}" alt="gambar" class="w-[100px] mb-4">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="Deskripsi">{{$produk->deskripsi}}</textarea>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="harga">Harga</label>
                                            <input type="number" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="Harga" value="{{$produk->harga}}">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="komposisi">Komposisi</label>
                                            <input type="text" name="komposisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="Komposisi" value="{{$produk->komposisi}}">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="karbo">Karbo</label>
                                            <input type="text" name="karbo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Karbo" value="{{$produk->karbo}}">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="protein">Protein</label>
                                            <input type="text" name="protein" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Protein" value="{{$produk->protein}}">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="kalori">Kalori</label>
                                            <input type="text" name="kalori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Kalori" value="{{$produk->kalori}}">
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="serat">Serat</label>
                                            <input type="text" name="serat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Serat" value="{{$produk->serat}}">
                                        </div>
                                        <button type="submit" class="w-full text-white bg-oranye hover:bg-oranyet focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" data-modal-hide="authentication-modal{{$produk->id}}">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('product.destroy', $produk->id) }}">
                            <button data-modal-target="popup-modal{{$produk->id}}" data-modal-toggle="popup-modal{{$produk->id}}" class="focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 justify-content-end w-[80px]" type="button">
                                Delete
                            </button>
                            @csrf
                            @method('DELETE')
                            <div id="popup-modal{{$produk->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal{{$produk->id}}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Anda yakin ingin menghapus produk {{$produk->nama}}?</h3>
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Ya
                                            </button>
                                            <button data-modal-hide="popup-modal{{$produk->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if($produk->hidden=="no")
                        <form action="{{ route('dashboard.product.hidden', $produk->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="focus:outline-none text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 mr-2 mb-2 justify-content-end w-[80px]" type="submit">
                                Hidden
                            </button>
                        </form>
                        @else
                        <form action="{{ route('dashboard.product.visible', $produk->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="focus:outline-none text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 mr-2 mb-2 justify-content-end w-[80px]" type="submit">
                                Visible
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$Produk->links()}}
    </div>
</div>
<div id="authentication-modal1" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <form method="post" action="{{ route('product.store') }}" class="relative w-full max-w-md max-h-full" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="authentication-modal1">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900">Masukkan Data Produk</h3>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="nama">Nama</label>
                    <input type="text" name="nama" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5" placeholder="Nama Produk">
                </div>
                <div class="field mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                    <div class="control">
                        @foreach ($kategori as $kat)
                        <label class="checkbox mr-2">
                            <input type="checkbox" name="kategoris[]" value="{{ $kat->id }}">
                            {{ $kat->nama_kategori }}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Gambar</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mb-4" name="gambar" id="file_input" type="file">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="Deskripsi"></textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="harga">Harga</label>
                    <input type="number" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="Harga">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="komposisi">Komposisi</label>
                    <input type="text" name="komposisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="Komposisi">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="karbo">Karbo</label>
                    <input type="text" name="karbo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Karbo">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="protein">Protein</label>
                    <input type="text" name="protein" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Protein">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="kalori">Kalori</label>
                    <input type="text" name="kalori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Kalori">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="serat">Serat</label>
                    <input type="text" name="serat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-[100px] p-2.5 mb-4" placeholder="Serat">
                </div>
                <button type="submit" class="w-full text-white bg-oranye hover:bg-oranyet focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" data-modal-hide="authentication-modal1">Simpan</button>
            </div>
        </div>
    </form>
</div>

@endsection