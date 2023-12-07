<x-home-layout>
    <div class="flex justify-center w-full bg-kuning min-h-screen h-max">
        <div class="mt-24 mx-20">
            <h1 class="font-bebas text-white text-[50px] tracking-[.20em]">Product / {{$detail->nama ?? 'None'}}</h1>
            <hr class="h-2 bg-white">
            <div class="flex my-10">
                <img src="{{asset('storage/'. $detail->gambar)}}" alt="produk" class="object-cover h-[500px] w-[500px] rounded-2xl">
                <div class="flex flex-col flex-1 ml-10">
                    <div>
                        <h1 class="font-bebas text-white text-[60px] tracking-[.20em]">{{$detail->nama}}</h1>
                        <p class="font-bebas text-black text-[20px] tracking-[.20em]">{{$detail->deskripsi}}</p>

                        <div class="flex items-center mt-12">
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Rating star</title>
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <p class="ml-2 mr-2 text-sm font-bold text-gray-900 dark:text-white">{{$avgrating}}</p>
                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                            <a href="#ulasann" class="ml-2 text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{$creview}} reviews</a>
                        </div>

                    </div>
                    <hr class="h-1 bg-oranye mt-3">
                    <div class="grid grid-cols-2">
                        <div class="grid grid-rows-2">
                            <p class="mt-3 font-bebas text-black text-[20px] tracking-[.20em]">quantity</p>
                            <div class="flex flex-rows mb-3">
                                <button class="kurang mr-3">
                                    <img src="{{asset('img/Minus.png')}}" alt="Kurangi" />
                                </button>
                                <span class="quantity text-lg pt-1">1</span>
                                <button class="tambah ml-3">
                                    <img src="{{asset('img/Plus.png')}}" alt="Tambah" />
                                </button>
                            </div>
                        </div>
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="justify-self-end self-center block text-black hover:text-oranye font-bebas font-medium text-[20px] text-center tracking-[.20em]" type="button">
                            Tambahkan Catatan
                        </button>
                    </div>
                    <hr class="h-1 bg-oranye">
                    <div class="grow"></div>
                    <div class="grid grid-cols-2">
                        <p class="font-bebas text-black text-[25px] tracking-[.20em] self-center" id="harga">Rp {{$detail->harga}}</p>
                        <form action="{{ route('storeProduk', ['harga' => $detail->harga, 'idproduk' => $detail->id])  }}" method="POST" class="place-self-end">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="data" name="jumlah" value="1">
                            <input type="hidden" id="status" name="status" value="process">
                            <input type="hidden" id="ulasan" name="ulasan" value="process">
                            <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="authentication-modal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="px-6 py-6 lg:px-8">
                                            <h3 class="mb-4 text-xl font-medium text-gray-900">Masukkan Catatan</h3>
                                            <div>
                                                <input type="text" name="catatan" id="catatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-oranye focus:border-oranye block w-full p-2.5 mb-4" placeholder="e.g. Tambahkan banyak bawang">
                                            </div>
                                            <button type="button" class="w-full text-white bg-oranye hover:bg-oranyet focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" data-modal-hide="authentication-modal">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::check())
                            <button type="submit" class="focus:outline-none text-sm text-white bg-oranye hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-md text-xl px-5 py-2.5 font-bebas tracking-[.20em]">
                                Add to cart
                            </button>
                            @else
                            <p class="mt-3 font-bebas text-oranye text-[15px] tracking-[.20em]">Anda harus Login</p>
                            <button type="button" class="focus:outline-none text-sm text-white bg-oranye hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-md text-xl px-5 py-2.5 font-bebas tracking-[.20em] cursor-not-allowed">
                                Add to cart
                            </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <hr class="h-2 bg-white">
            <h1 class="font-bebas text-white text-[50px] tracking-[.20em] mt-2">Detail Gizi</h1>
            <div class="grid grid-cols-6 mt-5">
                <div class="grid grid-rows-2 col-span-2">
                    <p class="font-bebas text-black text-[20px] tracking-[.20em] mb-4">Komposisi :</p>
                    <p class="font-bebas text-black text-[20px] tracking-[.20em]">{{$detail->komposisi ?? '-'}}</p>
                </div>
                <div class="grid grid-rows-2">
                    <p class="font-bebas text-black text-[20px] tracking-[.20em] mb-4">Karbo :</p>
                    <p class="font-bebas text-black text-[20px] tracking-[.20em]">{{$detail->karbo ?? '-'}}</p>
                </div>
                <div class="grid grid-rows-2">
                    <p class="font-bebas text-black text-[20px] tracking-[.20em] mb-4">Protein :</p>
                    <p class="font-bebas text-black text-[20px] tracking-[.20em]">{{$detail->protein ?? '-'}}</p>
                </div>
                <div class="grid grid-rows-2">
                    <p class="font-bebas text-black text-[20px] tracking-[.20em] mb-4">Kalori :</p>
                    <p class="font-bebas text-black text-[20px] tracking-[.20em]">{{$detail->kalori ?? '-'}}</p>
                </div>
                <div class="grid grid-rows-2">
                    <p class="font-bebas text-black text-[20px] tracking-[.20em] mb-4">Serat :</p>
                    <p class="font-bebas text-black text-[20px] tracking-[.20em]">{{$detail->serat ?? '-'}}</p>
                </div>
            </div>
            <h1 id="ulasann" class="font-bebas text-white text-[50px] tracking-[.20em] mt-6 mb-4">Ulasan :</h1>
            @if($ulasan->isEmpty())
            <div class="grid">
                <h1 class="font-bebas text-black justify-self-center text-[40px] tracking-[.20em] my-20">Belum ada ulasan</h3>
            </div>
            @elseif($ulasan->count()>1)
            <div class="flex flex-col justify-self-center overflow-y-scroll h-[390px] p-6 mb-10">
                @else
                <div class="flex flex-col justify-self-center mb-10">
                    @endif
                    @foreach($ulasan as $ul)
                    <div class="flex justify-self-center mt-6">
                        <div class="flex w-full h-[150px] bg-white rounded-xl px-10 py-6 drop-shadow-lg">
                            <img src="{{ isset($ul->user->image_user) ? asset('storage/'.$ul->user->image_user) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png' }}" alt="gambar" class="w-[90px] h-fit rounded-full self-center">
                            <div class="flex flex-col self-center ml-10">
                                <p class="mb-2">{{$ul->user->name ?? 'User telah dihapus'}}</p>
                                <div class="mb-2">
                                    @if($ul->rating=='1')
                                    @include('layouts.star.1star')
                                    @elseif($ul->rating=='2')
                                    @include('layouts.star.2star')
                                    @elseif($ul->rating=='3')
                                    @include('layouts.star.3star')
                                    @elseif($ul->rating=='4')
                                    @include('layouts.star.4star')
                                    @else
                                    @include('layouts.star.5star')
                                    @endif
                                </div>
                                <p class="">{{$ul->komentar}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-home-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var kurangButton = document.querySelector('.kurang');
        var tambahButton = document.querySelector('.tambah');
        var quantitySpan = document.querySelector('.quantity');
        var hargaParagraph = document.getElementById('harga');
        const dataInput = document.getElementById('data');


        // var hargaAwal = {{$detail->harga}}; //menggunakan ini juga bisa
        var hargaAwal = <?php echo $detail->harga; ?>;
        var quantity = parseInt(quantitySpan.innerText);

        function updateHarga() {
            var harga = hargaAwal * quantity;
            hargaParagraph.innerText = 'Rp ' + harga;
        }

        kurangButton.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                quantitySpan.innerText = quantity;
                updateHarga();
                dataInput.value = quantity;
            }
        });

        tambahButton.addEventListener('click', function() {
            quantity++;
            quantitySpan.innerText = quantity;
            updateHarga();
            dataInput.value = quantity;
        });
    });
</script>