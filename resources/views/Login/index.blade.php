
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="h-full bg-stone-900 m-20">
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center">
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url({{ Storage::url('img/LogRes.jpg') }})">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-2xl font-bold text-white sm:text-3xl">BeritaBagus</h2>
    
                        <p class="max-w-xl mt-3 text-gray-300">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. In
                            autem ipsa, nulla laboriosam dolores, repellendus perferendis libero suscipit nam temporibus
                            molestiae
                        </p>
                    </div>
                </div>
            </div>
    
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6 py-20">
                <div class="flex-1">
                    <div class="text-center">
                        <div class="flex justify-center mx-auto">
                            <img class="w-auto h-7 sm:h-8" src="https://merakiui.com/images/logo.svg" alt="">
                        </div>
    
                        <p class="mt-3 text-gray-500 dark:text-gray-300">Log in to access your account</p>
                    </div>
    
                    <div class="mt-8">
                        <form action="{{ route('login') }}" method="post">

                            @csrf

                            <div>
                                <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200" >Email Address</label>
                                <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="example@example.com" autofocus class="@error('email') is-invalid @enderror block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                @error('email')
                                    <div class="alert alert-error mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600 dark:text-gray-200">Password</label>
                                    <a href="#" class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">Forgot password?</a>
                                </div>
    
                                <input type="password" name="password" id="password" placeholder="Your Password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>
    
                            <div class="mt-6">
                                <button class="w-full px-4 py-2 tracking-wide btn btn-success">Log in</button>
                            </div>
    
                        </form>
    
                        <p class="mt-6 text-sm text-center text-gray-400">Don't have an account yet? <a href="/register" class="text-blue-500 focus:outline-none focus:underline hover:underline">Register Now</a> !!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- JS --}}
    <script src="https://kit.fontawesome.com/c6537cca0a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>

</html>

    
