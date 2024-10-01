<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="overflow-x-auto bg-base-300 p-5 rounded-lg">
        <a href="{{ route('beritas.create') }}" class="btn btn-square btn-success"><i class="fa-solid fa-plus"></i></a>
        <table class="table">
            <!-- head -->
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $id = 1; ?>
                @forelse ($beritas as $berita)
                {{-- {{ dd($berita) }} --}}
                    <tr class="text-center">
                        <td>{{ $id++ }}</td>
                        <td>{{ $berita->title }}</td>
                        <td>
                            <img src="{{ Storage::url('img/' . $berita->image) }}" class="rounded" style="width: 300px">
                        </td>
                        <td>{{ $berita->kategori->name}}</td>
                        <td><code>{!! Str::limit($berita->deskripsi, 150) !!}</code></td>
                        <td>{{ $berita->created_at }}</td>
                        <td>{{ $berita->updated_at }}</td>
                        <td class="">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('beritas.destroy', $berita->id) }}" method="POST">
                                <a href="{{ route('beritas.show', $berita->id) }}"
                                    class="btn btn-circle btn-outline btn-info"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('beritas.edit', $berita->id) }}"
                                    class="btn btn-circle btn-outline btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-circle btn-outline btn-error"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-error my-5">
                        Data berita belum Tersedia.
                    </div>
                @endforelse
            </tbody>
            <!-- foot -->
            <tfoot>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </tfoot>
        </table>
        {{-- PAGINATION --}}
        {{ $beritas->links() }}
    </div>
</x-layout>
