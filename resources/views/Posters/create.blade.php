<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="bg-base-300 rounded-lg p-5 sm:container sm:mx-auto">
        <x-header>{{ $title }}</x-header>

        <form action="{{ route('posters.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-3">
                <label class="form-control w-full pt-6">
                    <div class="label text-bold"><span class="label-text">JUDUL POSTER</span></div>
                    <input type="text" placeholder="Tuliskan judul poster...."
                        class="@error('title') is-invalid @enderror input input-bordered input-success w-full form-control "
                        name="title" value="{{ old('title') }}" />
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
                    <img src="{{ Storage::url('img/NoPoster.jpg') }}" class="img-image img-preview" style="width: 300px; height:450px; object-fit: cover;">
                </div>

                <input type="file"
                    class="file-input file-input-image file-input-bordered file-input-success w-full form-control @error('image') is-invalid @enderror"
                    name="image" value="{{ old('image') }}" id="image" onchange="previewImg()"/>
                <!-- error message untuk image -->
                @error('image')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">DESKRIPSI</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror textarea textarea-success w-full" name="deskripsi" rows="5" placeholder="Tuliskan deskripsi poster...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="alert alert-error mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('posters.index') }}" class="btn btn-md btn-circle btn-secondary"><i
                    class="fa-solid fa-backward"></i></a>
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
