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

<body class="h-full">
    @if(Gate::allows('admin'))
        <div class="min-h-full drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <x-navbar></x-navbar>

                <!-- Page content here -->
                <div class="p-8">
                    {{ $slot }}
                </div>
            </div>
            <x-sidebar></x-sidebar>
        </div>
    @else
        <!-- Navbar -->
        <x-navbar></x-navbar>
        <x-navbar-user></x-navbar-user>

        <!-- Page content here -->
        <div class="p-8">
            {{ $slot }}
        </div>
    @endif
    <x-footer></x-footer>


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

    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'deskripsi' ); 
    </script>
</body>

</html>
