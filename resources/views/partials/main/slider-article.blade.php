@if (count($articles) > 0)
    <div class="flex justify-center mt-10">
        {{-- Carousel Banner --}}
        <style>
            .nav-btn {
                color: white;
                height: 40px;
                width: 40px;
                /* margin-inline: -10px; */
            }

            .nav-btn::after,
            .nav-btn::before {
                font-size: 20px !important;
                font-weight: bolder;
            }

            .swiper-pagination-bullet {
                background-color: rgb(198 179 141 / 0.7) !important;
            }
        </style>
        <div class="w-[90%] lg:container">
            <div class="flex justify-between items-end">
                <div class="text-black">
                    <h1 class="text-2xl font-semibold">
                        Artikel Terkini
                    </h1>
                    <p class="text-xs">
                        *Artikel terkini yang bisa membantu anda dalam menambah wawasan
                    </p>
                </div>
                <div class="text-black">
                    <a href="{{ route('articles.index') }}" class="text-lg text-black hover:text-slate-400">
                        Lihat Selanjutnya
                    </a>
                </div>
            </div>
            <div class="mt-5">
                <div class="swiper w-full">
                    <div class="swiper-wrapper">
                        @foreach ($articles as $item)
                            <div class="swiper-slide h-auto">
                                <div class="rounded-2xl border border-[#CACACA] bg-white overflow-hidden flex flex-col"
                                    style="height: 100% !important">
                                    <!-- image -->
                                    <img src="{{ asset($item->image_path) }}" alt=""
                                        class="border-none w-full h-45 object-cover" />
                                    <!-- content -->
                                    <div class="py-5 px-6">
                                        <a href="" class="text-md line-clamp-2">
                                            {{ $item->title }}
                                        </a>
                                        <div class="my-3 flex items-center">
                                            <div class="flex gap-3 text-sm">
                                                <p class="text-sm text-feprimary">
                                                    {{ $item->author->name }}
                                                </p>
                                                <span aria-hidden="true"> · </span>
                                                <time class="text-sm text-feprimary" datetime="{{ $item->created_at }}">
                                                    {{ $item->created_at->diffForHumans() }}
                                                </time>
                                            </div>
                                        </div>
                                        <p class="mt-2 md:text-md text-sm">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100, '...') }}
                                        </p>
                                        <br>
                                        <a href="{{ route('articles.show', $item->id) }}"
                                            class="transition hover:text-feprimary">
                                            Selengkapnya ⟶
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-pagination"></div>

                    <div class="swiper-button-next rounded-full bg-feprimary/70 nav-btn"></div>
                    <div class="swiper-button-prev rounded-full bg-feprimary/70 nav-btn"></div>
                </div>
            </div>


        </div>
    </div>

@endif
