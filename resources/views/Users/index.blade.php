<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="overflow-x-auto bg-base-300 p-5 rounded-lg">
        <table class="table">
            <!-- head -->
            <thead>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">NAME</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $id = 1; ?>
                @forelse ($users as $user)
                    <tr class="text-center">
                        <td>{{ $id++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <img src="{{ Storage::url('img/' . $user->image) }}" class="rounded" style="width: 100px; margin:auto;" >
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td class="">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                <a href="{{ route('users.show', $user->id) }}"class="btn btn-circle btn-outline btn-info"><i class="fa-solid fa-eye"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-circle btn-outline btn-error"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-error my-5">
                        Data user belum Tersedia.
                    </div>
                @endforelse
            </tbody>
            <!-- foot -->
            <tfoot>
                <tr class="text-center">
                    <th scope="col">NO</th>
                    <th scope="col">NAME</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">TGL_BUAT</th>
                    <th scope="col">TGL_UBAH</th>
                    <th scope="col" style="width: 20%">ACTIONS</th>
                </tr>
            </tfoot>
        </table>
        <div class="py-10">
            {{-- PAGINATION --}}
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
