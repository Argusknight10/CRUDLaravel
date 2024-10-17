<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <section class="overflow-hidden rounded-lg">
        <div class="container px-6 py-10 mx-auto">
            <div class="card-actions py-5">
                @if (Gate::denies('admin'))
                    <a href="/" class="btn btn-sm btn-outline"><i class="fa-solid fa-arrow-left"></i> BACK</a>
                @else
                    <a href="{{ route('beritas.index') }}" class="btn btn-sm btn-outline"><i class="fa-solid fa-arrow-left"></i> BACK</a>
                @endif
            </div>
            <div class="lg:flex lg:-mx-6">
                <div class="lg:w-3/4 lg:px-6">
                    <figure>
                        <img class="object-cover w-full h-90" src="{{ Storage::url('img/' . $beritas->image) }}" alt="BeritaImage">
                    </figure>
    
                    <div class="">
                        <h1 class="py-3 mt-4 text-2xl font-semibold leading-tight text-gray-800 dark:text-white">
                            {{ $beritas->title }}
                        </h1>
                        <code class="block max-w-full overflow-auto break-words rounded">
                            <p class="mt-2 text-sm">{!! $beritas->deskripsi !!}</p>
                        </code>
                    </div>
                </div>
    
                @if (Gate::denies('admin'))
                    <div class="mt-8 lg:w-1/4 lg:mt-0 lg:px-6">
                            @foreach ($beritaLain as $bl)
                                <div>
                                    <h3 class="text-blue-500 capitalize">{{ $bl->title }}</h3>
                
                                    <a href="{{ route('beritas.show', $bl->id) }}" class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                                        <code>
                                            {!! Str::limit($bl->deskripsi, 100) !!}
                                        </code>
                                    </a>
                                </div>
                
                                <hr class="my-6 border-gray-200 dark:border-gray-700">
                            @endforeach
                        {{-- PAGINATION --}}
                        {{ $beritaLain->links() }}
                    </div>
                @endif
            </div>       
        </div>
    </section>
</x-layout>
