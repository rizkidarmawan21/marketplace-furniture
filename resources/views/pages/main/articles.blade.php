<x-app-layout :headerSearch="false">
    <div class="w-full h-60 relative flex flex-col items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-cover bg-center bg-no-repeat"
                style="background-image: url('https://hips.hearstapps.com/hmg-prod/images/index-furniture-65f07553eef2f.jpg'); filter: brightness(0.5)">
            </div>
        </div>
        <h1 class="text-2xl text-white font-semibold mb-4 z-10">Cari Artikel Untuk Furniture</h1>
        <div class="w-1/3 relative flex z-10" x-data="{ 'search': '{{ request('search') }}' }">
            {{-- Searching --}}
            <input type="text"
                class="w-full rounded-xl border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                placeholder="Cari Artikel" x-model="search">
            <button
                @click="const url = new URL(window.location.href);
                                url.searchParams.set('search', search);
                                url.searchParams.delete('page');
                                window.location.href = url.href;"
                class="absolute bg-feprimary rounded-lg px-2.5 py-1 right-2 top-1/2 transform -translate-y-1/2 text-white hover:bg-feprimary/70 flex items-center justify-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current"
                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                </svg>
                Cari
            </button>
        </div>
    </div>

    <div class="flex justify-center  mt-10">
        <div class="w-[90%] lg:container ">
            <div class="min-h-[calc(100vh-18rem)] mt-5 flex flex-col gap-5">
                @forelse ($articles as $item)
                    <div onclick="window.location.href = `{{ route('articles.show',$item->id) }}` " class="w-full min-h-50 rounded-xl flex items-center gap-5 hover:cursor-pointer hover:bg-slate-50/60">
                        <img src="{{ asset($item->image_path) }}"
                            alt="" class="w-90 h-50 object-cover rounded-xl">
                        <div>
                            <h1 class="text-xl text-text line-clamp-2 text-black font-medium">
                                {{ $item->title }}
                            </h1>
                            <div class="flex gap-3 text-sm my-2">
                                <p class="text-base text-feprimary">
                                    {{ $item->author->name }}
                                </p>
                                <span aria-hidden="true"> · </span>
                                <time class="text-sm text-feprimary" datetime="{{ $item->created_at }}">
                                    {{ $item->created_at->diffForHumans() }}
                                </time>
                            </div>
                            <p class="line-clamp-3">
                                {{ strip_tags($item->content) }}
                            </p>
                            <br>
                            <a href="{{ route('articles.show',$item->id) }}" class="transition hover:text-feprimary">
                                Selengkapnya ⟶
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="w-full min-h-50 rounded-xl flex justify-center bg-slate-50 items-center gap-5 hover:cursor-pointer hover:bg-slate-50/60">
                        <label for="">
                            Tidak ada data artikel
                        </label>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @include('partials.main.footer')
</x-app-layout>
