<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="bg-base-300 rounded-lg p-5 sm:container sm:mx-auto">
        <x-header>{{ $title }}</x-header>

        <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data">
                        
            @csrf

            <div class="form-group mb-3">
                <label class="form-control w-full pt-6">
                    <div class="label text-bold"><span class="label-text">JUDUL BERITA</span></div>
                    <input type="text" placeholder="Tuliskan judul berita...." class="@error('title') is-invalid @enderror input input-bordered input-success w-full form-control " name="title" value="{{ old('title') }}" />
                </label>

                <!-- error message untuk title -->
                @error('title')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">IMAGE</label>
                <input type="file" class="file-input file-input-bordered file-input-success w-full form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"/>
                <!-- error message untuk image -->
                @error('image')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            {{-- <div class="form-group mb-3">
                <label class="font-weight-bold">KATEGORI</label>

                <div class="dropdown dropdown-bottom">
                    <div tabindex="0" role="button" class="btn m-1">Kategori</div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>

                @error('kategori')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}

            <div class="row mb-3">
                <label for="kategori" class="text-primary col-sm-2 col-form-label">KATEGORI</label>
                <div class="col-sm-10">
                    <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                        @foreach ($kategori as $k) 
                            <option value="{{ $k->id }}" {{ (old('kategori') == $k->id) ? 'selected' : ''; }} >
                                {{ $k->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('name')
                        <div class="alert alert-error mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">DESKRIPSI</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror textarea textarea-success w-full" name="deskripsi" rows="5" placeholder="Tuliskan isi berita...">{{ old('deskripsi') }}</textarea>
            
                <!-- error message untuk deskripsi -->
                @error('deskripsi')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('beritas.index') }}" class="btn btn-md btn-circle btn-secondary"><i class="fa-solid fa-backward"></i></a>
            <button type="submit" class="btn btn-md btn-circle btn-info"><i class="fa-solid fa-check"></i></button>
            <button type="reset" class="btn btn-md btn-circle btn-warning"><i class="fa-solid fa-xmark"></i></button>
        </form> 
    </div>
</x-layout>