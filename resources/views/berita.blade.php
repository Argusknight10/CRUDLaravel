<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <section>
        <form action="" >
            @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
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
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
                @foreach ($konten_berita as $kb)
                    <div>
                        <img class="relative z-10 object-cover w-full rounded-md h-96" src="{{ Storage::url('img/'. $kb->image); }}" alt="{{ $kb->image }}">
        
                        <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                            <a href="{{ route('beritas.show', $kb->id) }}" class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                                {{ $kb->title }}
                            </a>
        
                            
                            <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                                <code>
                                    {!! Str::limit($kb->deskripsi, 100) !!}
                                </code>
                            </p>
        
                            <p class="mt-3 text-sm text-blue-500">{{ $kb->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

                {{ $konten_berita->links() }}
            </div>
        </div>
    </section>
</x-layout>