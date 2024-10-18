<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <section>
        <form action="" >
            <div class="container mx-auto mb-3 space-y-4 max-w-screen-xl sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <input type="text" placeholder="Search..." type="search" id="search" name="search" class="input input-bordered w-full pl-10 pr-4" />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
                <div>
                    <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white btn btn-outline" autocomplete="off">Search</button>
                </div>
            </div>
        </form>
    </section>
    

    <section class="">
        <div class="container px-6 py-10 mx-auto">
            <div class="lg:flex lg:-mx-6">
                <div class="lg:w-3/4 lg:px-6">
                    <img class="object-cover object-center w-full h-80 xl:h-[28rem] rounded-xl" src="{{ Storage::url('img/'. $berita1->image); }}" alt="{{ $berita1->image }}">
    
                    <div>
                        <p class="mt-6 text-sm text-blue-500 uppercase">sedang hangat</p>
    
                        <a href="{{ route('beritas.show', $berita1->id) }}" class="hover:underline">
                            <h1 class="max-w-lg mt-4 text-2xl font-semibold leading-tight text-gray-800 dark:text-white">
                                {{ $berita1->title }}
                            </h1>
                        </a>
                    </div>
                </div>
    
                <div class="mt-8 lg:w-1/4 lg:mt-0 lg:px-6 border-l border-gray-600">
                    @foreach ($berita_baru as $bb)
                            <div>
                            <h3 class="text-blue-500 capitalize">{{ $bb->title }}</h3>
            
                            <a href="{{ route('beritas.show', $bb->id) }}" class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                                    <div>
                                    {!! Str::limit($bb->deskripsi, 100) !!}
                                    </div>
                                </a>
                            </div>
            
                            <hr class="my-6 border-gray-200 dark:border-gray-700">
                        @endforeach
                    <div class="py-5">
                        <a href="{{ url('/berita') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-right"></i>Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>       
        </div>
    </section>

    <section class="">
        <div class="container px-6 py-10 mx-auto">
            <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Berita Kami</h1>
    
                <p class="max-w-lg mx-auto mt-4 text-gray-500">
                    Temukan berita terbaru dari kami dan eksplor berbagai informasi menarik yang ingin anda ketahui!
                </p>
            </div>
    
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
                @foreach ($berita_kami as $bk)
                    <div>
                        <img class="relative z-10 object-cover w-full rounded-md h-96" src="{{ Storage::url('img/'. $bk->image); }}" alt="{{ $bk->image }}">
        
                        <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                            <a href="{{ route('beritas.show', $bk->id) }}" class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                                {{ $bk->title }}
                            </a>
        
                            
                            <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                                <div>
                                    {!! Str::limit($bk->deskripsi, 100) !!}
                                </div>
                            </p>
        
                            <p class="mt-3 text-sm text-blue-500">{{ $bk->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

                <div class="py-5">
                    <a href="{{ url('/berita') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-right"></i>Lihat Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container px-6 py-10 mx-auto">
            <div class="flex justify-between items-center border-b border-gray-600">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">
                    Poster
                </h1>
                <div class="py-5">
                    <a href="{{ url('/poster') }}" class="hover:underline hover:text-blue-500 flex items-center space-x-2">
                        <i class="fa-solid fa-arrow-right"></i>
                        <span>Lihat Selengkapnya</span>
                    </a>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($poster as $p)
                    <div class="lg:flex">
                        <img class="object-cover w-full rounded-lg" style="width: 300px; height:400px;" src="{{ Storage::url('img/'.$p->image); }}" alt="">
        
                        <div class="py-6 lg:mx-6">
                            <a href="{{ route('posters.show', $p->id) }}" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                <h1>{{ $p->title }}</h1>
                            </a>
                            <p class="text-sm text-gray-500">{{ $p->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>