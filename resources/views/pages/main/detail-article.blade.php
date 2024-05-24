<x-app-layout :headerSearch="false">
    <div class="flex justify-center">
        <div class="w-[90%] lg:container ">
            <div class="min-h-[calc(100vh-18rem)] mt-5 flex flex-col gap-5">

                <div class="flex flex-col md:flex-row gap-5">
                    <div class="col-1 w-full md:flex-grow">
                        <a href="{{ route('articles.index') }}" class="text-feprimary hover:text-feprimary/55">
                            Back
                        </a>
                        <h1 class="text-3xl font-bold text-feprimary">{{ $article->title }}</h1>
                        <div class="flex gap-3 text-sm my-3">
                            <p class="text-lg text-black">
                                {{ $article->author->name }}
                            </p>
                            <span aria-hidden="true"> · </span>
                            <time class="text-lg text-black" datetime="{{ $article->created_at }}">
                                {{ $article->created_at->diffForHumans() }}
                            </time>
                        </div>
                    </div>
                    <div class="col-2 w-full md:w-1/3">
                    </div>
                </div>
                <div class="flex flex-col md:flex-row gap-10">
                    <div class="col-1 w-full md:flex-grow">
                        <img src="{{ asset($article->image_path) }}" alt=""
                            class="w-full max-h-125 object-cover rounded-xl">
                        <div>
                            <p class="text-lg text-black my-5">
                                {!! $article->content !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-2 h-180 w-full md:w-1/3">
                        <h1 class="text-xl font-medium text-feprimary mb-5">Artikel Lainnya</h1>
                        <div class="h-full flex flex-col gap-3 overflow-y-auto">
                            @forelse ($anotherArticles as $item)
                                <div class="bg-slate-50 rounded-lg hover:cursor-pointer">
                                    <div class="p-2">
                                        <img src="{{ asset($item->image_path) }}"
                                            class="rounded-lg w-full h-50 object-cover">
                                        <h2
                                            class="mt-2 text-sm font-semibold text-black hover:text-feprimary line-clamp-2">
                                            {{ $item->title }}
                                        </h2>
                                        <div class="flex gap-3 text-sm my-2">
                                            <p class="text-sm text-black">
                                                {{ $item->author->name }}
                                            </p>
                                            <span aria-hidden="true"> · </span>
                                            <time class="text-sm text-black" datetime="{{ $item->created_at }}">
                                                {{ $item->created_at->diffForHumans() }}
                                            </time>
                                        </div>
                                        <p class="text-sm line-clamp-3 mb-3">
                                            {{ strip_tags($item->content) }}
                                        </p>
                                        <a href="{{ route('articles.show', $item->id) }}"
                                            class="transition text-sm hover:text-feprimary">
                                            Selengkapnya ⟶
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-slate-50 rounded-lg hover:cursor-pointer">
                                    <div class="p-2">
                                        <h2>
                                            <a class="text-sm text-slate-500 hover:text-feprimary line-clamp-1">
                                                Tidak ada artikel lainnya
                                            </a>
                                        </h2>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('partials.main.footer')
</x-app-layout>
