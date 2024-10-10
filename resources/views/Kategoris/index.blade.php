<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="overflow-x-auto bg-base-300 p-5 rounded-lg">
        <a href="{{ route('kategoris.create') }}" class="btn btn-square btn-success"><i class="fa-solid fa-plus"></i></a>
        <table class="table">
            <!-- head -->
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 1; ?>
                @forelse ($kategoris as $kategori)
                    <tr class="text-center">
                        <td>{{ $id++ }}</td>
                        <td>{{ $kategori->name }}</td>
                        <td>{{ $kategori->created_at }}</td>
                        <td>{{ $kategori->updated_at }}</td>
                        <td class="">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST">
                                <a href="{{ route('kategoris.edit', $kategori->id) }}"
                                    class="btn btn-circle btn-outline btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-circle btn-outline btn-error"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-error my-5">
                        Data kategori belum Tersedia.
                    </div>
                @endforelse
            </tbody>
            <!-- foot -->
            <tfoot>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </tfoot>
        </table>
        {{-- PAGINATION --}}
        {{ $kategoris->links() }}
    </div>
</x-layout>
