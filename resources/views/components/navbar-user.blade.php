<nav class="bg-white shadow dark:bg-gray-800">
    <div class="container flex items-center justify-center p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
        <a href="/" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 {{ request()->is('/') ? 'border-blue-500' : 'border-transparent' }} mx-1.5 sm:mx-6">home</a>

        <a href="/berita" class="border-b-2 {{ request()->is('berita') ? 'border-blue-500' : 'border-transparent' }} hover:text-gray-800 transition-colors duration-300 transform dark:hover:text-gray-200 mx-1.5 sm:mx-6">berita</a>

        <a href="/poster" class="border-b-2 {{ request()->is('poster') ? 'border-blue-500' : 'border-transparent' }} hover:text-gray-800 transition-colors duration-300 transform dark:hover:text-gray-200 mx-1.5 sm:mx-6">poster</a>
    </div>
</nav>
