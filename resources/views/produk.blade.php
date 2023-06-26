<x-home-layout>
    <div class="grid sticky top-[100px] justify-items-center z-50">
        <div class="absolute">
            @include('toast.toast')
        </div>
    </div>
    <div class="flex flex-col justify-center w-full bg-kuning min-h-screen h-max">
        <div class="flex flex-col mt-24 mx-auto">
            <h1 class="font-bebas text-white text-[70px] tracking-[.20em] mx-auto">Pilihan Makanan Sehat</h1>
            <h3 class="font-bebas text-oranyet text-[40px] tracking-[.20em] mx-auto">Healthy Lifestyle Meal Plan</h3>
            <div class="grid grid-cols-4 gap-x-10 gap-y-10 my-20">
                @foreach($produk as $Produk)
                @if($Produk->hidden=="no")
                <div class="bg-gray-100 w-fit h-fit hover:bg-gray-200 shadow-lg rounded-2xl duration-500 hover:scale-105 hover:shadow-2xl">
                    <a href="{{route('detail', ['nama' => $Produk->nama])}}" class="mt-6">
                        <img src="{{asset('storage/'. $Produk->gambar)}}" alt="produk" class="object-cover h-[240px] w-[300px] rounded-t-2xl">
                        <div class="px-6 py-3">
                            @if($Produk->kategori->isEmpty())
                            <span class="text-gray-400 text-xs">Tidak ada kategori</span> 
                            @else
                            @foreach($Produk->kategori as $p)
                            <span class="text-gray-400 text-xs">{{$p->nama_kategori ?? 'None'}} </span>                                 
                            @endforeach
                            @endif
                            
                            <p class="text-lg font-bold text-black truncate block capitalize">{{$Produk->nama}}</p>
                            <div class="flex items-center">
                                <p class="text-lg font-semibold text-black cursor-auto my-3">Rp {{$Produk->harga}}</p>
                                <del>
                                    <p class="text-sm text-gray-600 cursor-auto ml-2"></p>
                                </del>
                                <div class="ml-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @else
                @endif
                @endforeach
            </div>
        </div>
    </div>
</x-home-layout>