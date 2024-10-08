<div class="navbar bg-success w-full text-stone-950">
    <div class="navbar-start">
        <div class="flex-none">
            <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-natural">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block h-6 w-6 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
        </div>
    </div>
    
    <div class="navbar-center lg:flex">
        <a class="mx-2 flex-1 px-2 text-xl" style="font-weight: bold" href="/">BeritaBagus</a>
    </div>

    <div class="navbar-end flex items-center gap-4">
        <div class="form-control">
            <div class="relative w-48 md:w-64">
                <input type="text" placeholder="Search..." class="input input-bordered w-full pl-10 pr-4" />
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            </div>
        </div>
        @auth
            <h1 class="font-bold text-sm">{{ auth()->user()->name }}</h1 class="font-bold text-md">
            <div class="dropdown dropdown-end">
                <label tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Foto Profil"
                            src="{{ Storage::url('img/'.auth()->user()->image) }}" />
                    </div>
                </label>

                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow text-white">
                    <li><a href="">Profile</a></li>

                    <form action="/logout" method="post">
                        <li>
                            @csrf
                            <button type="submit">Logout</button>
                        </li>
                    </form>
                    @csrf
                </ul>
            </div>
        @else
            <label tabindex="0" role="button">
                <a href="{{ route('login') }}" class="btn"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            </label>    
        @endauth    
    </div>
</div>