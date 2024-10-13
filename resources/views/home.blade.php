<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <section>
        <form action="/berita" >
            <div class="container mx-auto mb-3 space-y-4 max-w-screen-xl sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <input type="text" placeholder="Search..." type="search" id="search" name="search" class="input input-bordered w-full pl-10 pr-4" />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
                <div>
                    <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white border rounded-lg autocomplete="off">Search</button>
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
    
                <div class="mt-8 lg:w-1/4 lg:mt-0 lg:px-6">
                        @foreach ($berita3 as $b3)
                            <div>
                                <h3 class="text-blue-500 capitalize">{{ $b3->title }}</h3>
            
                                <a href="{{ route('beritas.show', $b3->id) }}" class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                                    <code>
                                        {!! Str::limit($b3->deskripsi, 100) !!}
                                    </code>
                                </a>
                            </div>
            
                            <hr class="my-6 border-gray-200 dark:border-gray-700">
                        @endforeach
                    {{-- PAGINATION --}}
                    {{ $berita3->links() }}
                </div>
            </div>       
        </div>
    </section>

    <section class="">
        <div class="container px-6 py-10 mx-auto">
            <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">From the blog</h1>
    
                <p class="max-w-lg mx-auto mt-4 text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure veritatis sint autem nesciunt, laudantium
                    quia tempore delect
                </p>
            </div>
    
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
                @foreach ($berita2 as $b2)
                    <div>
                        <img class="relative z-10 object-cover w-full rounded-md h-96" src="{{ Storage::url('img/'. $b2->image); }}" alt="{{ $b2->image }}">
        
                        <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                            <a href="{{ route('beritas.show', $b2->id) }}" class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                                {{ $b2->title }}
                            </a>
        
                            
                            <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                                <code>
                                    {!! Str::limit($b2->deskripsi, 100) !!}
                                </code>
                            </p>
        
                            <p class="mt-3 text-sm text-blue-500">{{ $b2->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

                {{ $berita2->links() }}
            </div>
        </div>
    </section>

    <section class="">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">From the blog</h1>
    
            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($berita2 as $b2)
                    <div class="lg:flex">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="{{ Storage::url('img/'.$b2->image); }}" alt="">
        
                        <div class="flex flex-col justify-between py-6 lg:mx-6">
                            <a href="{{ route('beritas.show', $b2->id) }}" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                <code>
                                    {!! $b2->title !!}
                                </code>
                            </a>
                            
                            <span class="text-sm text-gray-500 dark:text-gray-300">{{ $b2->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach

                {{ $berita2->links() }}
            </div>
        </div>
    </section>
</x-layout>