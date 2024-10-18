<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="container mx-auto p-10 w-3/4">
        <div class="card card-side bg-base-100 shadow-xl">
            <figure class="w-2/4">
                <img src="{{ Storage::url('img/'.$posters->image) }}" style="height: 700px" alt="{{ $posters->image }}" />
            </figure>
            <div class="card-body w-2/4">
                <h1 class="card-title font-bold text-2xl">{{ $posters->title }}</h1>
                <div class="block max-w-full overflow-auto break-words rounded">
                    {!! $posters->deskripsi ? $posters->deskripsi : 'Tidak ada deskripsi apapun' !!}
                </div>
                <div class="card-actions justify-end">
                    @if (Gate::denies('admin'))
                        <a href="/" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> BACK</a>
                    @else
                        <a href="{{ route('posters.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> BACK</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
