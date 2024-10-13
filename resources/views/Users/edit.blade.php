<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="flex overflow-hidden rounded-lg shadow-lg bg-base-300 card-md mx-auto">
        <div class="w-1/4 bg-cover"><figure><img src="{{ Storage::url('img/'. old('image', $users->image)) }}"  class="img-image img-preview"></figure></div>
        {{-- DISINI --}}
    
        <div class="card-body w-3/4 p-5">
            <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                        
                @csrf
                @method('PUT')

                <div class="form-group">
                    <div class="form-group mb-3 flex items-center">
                        <label class="text-bold mr-4 w-1/4"><span class="label-text">USERNAME</span></label>
                        <input type="text" placeholder="username...." class="@error('username') is-invalid @enderror input input-bordered input-success w-full h-10" name="username" value="{{ old('username', $users->username) }}" />
                    </div>
                    
                    @error('username')
                        <div class="alert alert-error mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <div class="form-group mb-3 flex items-center">
                        <label class="text-bold mr-4 w-1/4"><span class="label-text">NAME</span></label>
                        <input type="text" placeholder="name...." class="@error('name') is-invalid @enderror input input-bordered input-success w-full h-10" name="name" value="{{ old('name', $users->name) }}" />
                    </div>
    
                    @error('name')
                        <div class="alert alert-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <div class="form-group mb-3 flex items-center">
                        <label class="text-bold mr-4 w-1/4"><span class="label-text">EMAIL</span></label>
                        <input type="text" placeholder="email...." class="@error('email') is-invalid @enderror input input-bordered input-success w-full h-10" name="email" value="{{ old('email', $users->email) }}" />
                    </div>
    
                    @error('email')
                        <div class="alert alert-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3 flex items-center">
                    <label class="text-bold mr-4 w-1/4"><span class="label-text">CHANGE PICT</span></label>
                    <input type="file" class="file-input file-input-image file-input-bordered file-input-success w-full h-10 form-control @error('image') is-invalid @enderror" name="image" value="" id="image" onchange="previewImg()"/>
                    @error('image')
                        <div class="alert alert-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3 flex items-center">
                    <label class="text-bold mr-4 w-1/4"><span class="label-text">CHANGE PASSWORD</span></label>
                    <input type="password" placeholder="password lama..." class="@error('old_password') is-invalid @enderror input input-bordered input-success w-full h-10" name="old_password" />
                </div>
                @error('old_password')
                    <div class="alert alert-error">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3 flex items-center">
                    <label class="text-bold mr-4 w-1/4"><span class="label-text"></span></label>
                    <input type="password" placeholder="password baru..." class="@error('new_password') is-invalid @enderror input input-bordered input-success w-full h-10" name="new_password" />
                </div>
                @error('new_password')
                    <div class="alert alert-error">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3 flex items-center">
                    <label class="text-bold mr-4 w-1/4"><span class="label-text"></span></label>
                    <input type="password" placeholder="konfirmasi password baru..." class="@error('new_password_confirmation') is-invalid @enderror input input-bordered input-success w-full h-10" name="new_password_confirmation" />
                </div>
                @error('new_password_confirmation')
                    <div class="alert alert-error">{{ $message }}</div>
                @enderror

                <div class="mt-5">
                    <button type="submit" class="btn btn-md btn-circle btn-info"><i class="fa-solid fa-check"></i></button>
                    <button type="reset" class="btn btn-md btn-circle btn-warning"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </form>
        </div>
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