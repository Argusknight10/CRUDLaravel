<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="bg-base-300 rounded-lg p-5 sm:container sm:mx-auto">
        <x-header>{{ $title }}</x-header>

        <form action="{{ route('beritas.update', $beritas->id) }}" method="POST" enctype="multipart/form-data">
                        
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="form-control w-full pt-6">
                    <div class="label text-bold"><span class="label-text">JUDUL BERITA</span></div>
                    <input type="text" placeholder="Tuliskan judul berita...." class="@error('title') is-invalid @enderror input input-bordered input-success w-full form-control " name="title" value="{{ old('title', $beritas->title) }}" />
                </label>

                <!-- error message untuk title -->
                @error('title')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="image" class="font-weight-bold">IMAGE</label>
                <div class="col-sm-3 mb-5 mt-1">
                    <img src="{{ Storage::url('img/'. old('image', $beritas->image)) }}"  class="img-image img-preview" width="300px">
                </div>

                <input type="file"
                    class="file-input file-input-image file-input-bordered file-input-success w-full form-control @error('image') is-invalid @enderror"
                    name="image" value="" id="image" onchange="previewImg()"/>
                <!-- error message untuk image -->
                @error('image')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="relative inline-block w-52">
                    <select class="cursor-pointer form-select font-semibold bg-success my-1 text-black w-52 p-2 rounded shadow appearance-none @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                        <option value="{{ old('kategori', $beritas->kategori) }}" disabled selected>{{ $beritas->kategori->name }}</option>
                        @foreach ($kategori as $k) 
                            <option value="{{ $k->id }} {{ old('kategori') == $k->id ? 'selected' : '' }}" class="bg-stone-900 text-white" >
                                {{ $k->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-black">
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                </div>

                @error('kategori')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>          


            <div class="form-group mb-3">
                <label class="font-weight-bold">DESKRIPSI</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror textarea textarea-success w-full" name="deskripsi" rows="5" placeholder="Tuliskan isi berita...">{{ old('deskripsi', $beritas->deskripsi) }}</textarea>
            
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

<script>
    function previewImg() {
        const image = document.querySelector('#image');
        const imageLabel = document.querySelector('.file-input-image');
        const imgPreview = document.querySelector('.img-preview');

        // untuk mengganti url
        imageLabel.textContent = image.files[0].name;

        // untuk mengganti preview
        const fileImage = new FileReader();
        fileImage.readAsDataURL(image.files[0]);

        fileImage.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>