<div class="flex justify-center lg:mx-52 mt-10">
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
                <a href="{{ route('products.index') }}" class="text-lg text-black hover:text-slate-400">
                    Lihat Selanjutnya
                </a>
            </div>
        </div>
        <div class="mt-5">
            <div class="swiper w-full">
                <div class="swiper-wrapper">
                    <div class="swiper-slide h-auto">
                        <div class="rounded-2xl border border-[#CACACA] bg-white overflow-hidden flex flex-col"
                            style="height: 100% !important">
                            <!-- image -->
                            <img src="https://unair.ac.id/wp-content/uploads/2021/09/21.-Penulisan-Artikel-Ilmiah-Populer-Mudah-dan-Menyenangkan.jpeg"
                                alt="" class="border-none w-full h-40 object-cover" />
                            <!-- content -->
                            <div class="py-5 px-6">
                                <a href="" class="text-xl font-bold">
                                    {{-- {{ \Illuminate\Support\Str::limit($article['title'], 20, '...') }} --}}
                                </a>
                                <div class="flex items-center">
                                    <div class="flex gap-3 text-sm">
                                        <span aria-hidden="true"> · </span>
                                    </div>
                                </div>
                                <p class="mt-2 md:text-md text-sm">
                                    {{-- {{ \Illuminate\Support\Str::limit($article['title'], 100, '...') }} --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>

                <div class="swiper-button-next rounded-full bg-feprimary/70 nav-btn"></div>
                <div class="swiper-button-prev rounded-full bg-feprimary/70 nav-btn"></div>
            </div>
        </div>


    </div>
</div>
