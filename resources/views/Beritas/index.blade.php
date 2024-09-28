<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA BERITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #D2E0FB">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tutorial Laravel 11 untuk Pemula</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('beritas.create') }}" class="btn btn-md btn-success mb-3">ADD BERITA</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">TGL_BUAT</th>
                                    <th scope="col">TGL_UBAH</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1 ?>
                                @forelse ($beritas as $berita)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $berita->title }}</td>
                                        <td class="text-center">
                                            <img src="{{ Storage::url('img/'.$berita->image) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ Str::limit($berita->deskripsi,150) }}</td>
                                        <td>{{ $berita->created_at }}</td>
                                        <td>{{ $berita->updated_at }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('beritas.destroy', $berita->id) }}" method="POST">
                                                <a href="{{ route('beritas.show', $berita->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('beritas.edit', $berita->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data beritas belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- PAGINATION --}}
                        {{ $beritas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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