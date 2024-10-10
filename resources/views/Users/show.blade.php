<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="flex max-w-2xl overflow-hidden rounded-lg shadow-lg bg-base-300 card-md mx-auto">
        <div class="w-2/4 bg-cover border"><figure><img src="{{Storage::url('img/'. $users->image)}}" /></figure></div>
    
        <div class="card-body w-2/4 p-5">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">{{ $users->username }}</h1>
            <ul>
                <li class="text-sm py-2">{{ $users->name }}</li>
                <li class="text-sm py-2"">{{ $users->email }}</li>
            </ul>

            <div class="card-actions justify-end align-bottom">
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-success"><i class="fa-solid fa-backward"></i> BACK</a>
            </div>
        </div>
    </div>
</x-layout>
