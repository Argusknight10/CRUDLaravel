<div class="drawer-side">
    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 min-h-full w-80 p-4">
        <!-- Sidebar content here -->
        @cannot('admin')
            <li class="border-b-2 py-1"><a href="/">Home</a></li>
        @endcannot

        @can('admin')
            <li class="border-b-2 py-1"><a href="/users">User</a></li>
            <li class="border-b-2 py-1"><a href="/beritas">Berita</a></li>
            <li class="border-b-2 py-1"><a href="/kategoris">Kategori</a></li>
        @endcan

        <li class="border-b-2 py-1"><a href="">Logout</a></li>
    </ul>
</div>