<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="bg-base-300 rounded-lg p-5 sm:container sm:mx-auto">
        <x-header>{{ $title }}</x-header>

        <form action="{{ route('kategoris.update', $kategoris->id) }}" method="POST" enctype="multipart/form-data">
                        
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="form-control w-full pt-6">
                    <div class="label text-bold"><span class="label-text">NAMA KATEGORI</span></div>
                    <input type="text" placeholder="Tuliskan nama kategori...." class="@error('name') is-invalid @enderror input input-bordered input-success w-full form-control " name="name" value="{{ old('name', $kategoris->name) }}" />
                </label>

                <!-- error message untuk kategori -->
                @error('kategori')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('kategoris.index') }}" class="btn btn-md btn-circle btn-secondary"><i class="fa-solid fa-backward"></i></a>
            <button type="submit" class="btn btn-md btn-circle btn-info"><i class="fa-solid fa-check"></i></button>
            <button type="reset" class="btn btn-md btn-circle btn-warning"><i class="fa-solid fa-xmark"></i></button>
        </form> 
    </div>
</x-layout>