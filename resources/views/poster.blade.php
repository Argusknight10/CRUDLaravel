<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <section>
        <form action="">
            @if (request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <div class="container mx-auto mb-3 space-y-4 max-w-screen-xl sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <input type="text" placeholder="Search..." type="search" id="search" name="search"
                        class="input input-bordered w-full pl-10 pr-4" />
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
                <div>
                    <button type="submit"
                        class="py-3 px-5 w-full text-sm font-medium text-center text-white border rounded-lg autocomplete="off">Search</button>
                </div>
            </div>
        </form>
    </section>

    <section class="">
        <div class="container px-6 py-10 mx-auto">
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
                @foreach ($konten_poster as $kp)
                    <div class="lg:flex">
                        <img class="object-cover w-full rounded-lg" style="width: 300px; height:400px;"
                            src="{{ Storage::url('img/' . $kp->image) }}" alt="">

                        <div class="py-6 lg:mx-6">
                            <a href="{{ route('posters.show', $kp->id) }}"
                                class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                <h1>{{ $kp->title }}</h1>
                            </a>
                            <p class="text-sm text-gray-500">{{ $kp->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

                {{ $konten_poster->links() }}
            </div>
        </div>
    </section>
</x-layout>
