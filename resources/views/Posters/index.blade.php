<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="overflow-x-auto bg-base-300 p-5 rounded-lg">
        <div class="flex py-5">
            <a href="{{ route('posters.create') }}" class="btn btn-square btn-success"><i class="fa-solid fa-plus"></i></a>
            <h1 class="text-2xl uppercase py-1 px-5">dashboard poster</h1>
        </div>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 1; ?>
                @forelse ($posters as $poster)
                {{-- {{ dd($poster) }} --}}
                    <tr class="text-center">
                        <td>{{ $id++ }}</td>
                        <td>{{ $poster->title }}</td>
                        <td class="text-center">
                            <img src="{{ Storage::url('img/' . $poster->image) }}" class="rounded mx-auto" style="width: 200px; height:300px; object-fit: cover;">
                        </td>
                        <td class="text-left w-20"><div class="block max-w-full overflow-auto break-words rounded">{!! $poster->deskripsi ? Str::limit($poster->deskripsi, 50) : 'Tidak ada deskripsi apapun' !!}</div></td>
                        <td>{{ $poster->created_at }}</td>
                        <td>{{ $poster->updated_at }}</td>
                        <td class="">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('posters.destroy', $poster->id) }}" method="POST">
                                <a href="{{ route('posters.show', $poster->id) }}"
                                    class="btn btn-circle btn-outline btn-info"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('posters.edit', $poster->id) }}"
                                    class="btn btn-circle btn-outline btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-circle btn-outline btn-error"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-error my-5">
                        Data poster belum Tersedia.
                    </div>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </tfoot>
        </table>
        <div class="py-10">
            {{-- PAGINATION --}}
            {{ $posters->links() }}
        </div>
    </div>
</x-layout>
