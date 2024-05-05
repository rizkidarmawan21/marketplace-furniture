<x-app-layout :headerSearch="false">
    <div class="min-h-[calc(100vh-18rem)] justify-center lg:mx-52 mt-5">
        <h1 class="text-2xl font-semibold text-black">
            Pesanan Saya
        </h1>
        <hr class="my-5 text-slate-200">
        <div class="w-full grid grid-cols-4">
            <div class="pr-5">
                <div class="flex flex-col rounded-lg">
                    {{-- Menu --}}
                    <a href=""
                        class="flex justify-between text-black p-3 hover:bg-zinc-100 cursor-pointer border-zinc-300 border rounded-t-lg">
                        Belum Dibayar
                        <span
                            class="bg-feprimary text-white w-6 h-6 rounded-full text-sm flex items-center justify-center">
                            10
                        </span>
                    </a>
                    <a href=""
                        class="flex justify-between text-black p-3 hover:bg-zinc-100 cursor-pointer border-zinc-300 border-x">
                        Dikemas
                        <span
                            class="bg-feprimary text-white w-6 h-6 rounded-full text-sm flex items-center justify-center">
                            10
                        </span>
                    </a>
                    <a href=""
                        class="flex justify-between text-black p-3 hover:bg-zinc-100 cursor-pointer border-zinc-300 border-x border-t">
                        Dikirim
                        <span
                            class="bg-feprimary text-white w-6 h-6 rounded-full text-sm flex items-center justify-center">
                            10
                        </span>
                    </a>
                    <a href=""
                        class="text-black p-3 hover:bg-zinc-100 cursor-pointer border-zinc-300 border-x border-t">Selesai</a>
                    <a href=""
                        class="text-black p-3 hover:bg-zinc-100 cursor-pointer border-zinc-300 border rounded-b-lg">Dibatalkan</a>
                </div>
            </div>
            <div class="col-span-3 grid gap-5">
                <div class="item-cart border border-zinc-300 rounded-lg">
                    <div class="mt-3 px-5 flex justify-between">
                        <button class="bg-feprimary px-3 text-xs text-white rounded-md hover:bg-feprimary/50">
                            Hubungi Penjual
                        </button>
                        <h1 class="text-lg">#151-FUR3YD73G91</h1>
                    </div>
                    <div class="mt-3 px-5 mb-5 flex items-center justify-between">
                        <div class="flex w-[80%] gap-4 items-center">
                            <img src="https://res.cloudinary.com/ruparupa-com/image/upload/w_400,h_400/f_auto,q_auto:eco/v1664809960/Products/10447967_1.jpg"
                                alt="" class="w-30 rounded-lg object-cover border border-[#E5E5E5]">
                            <div class="w-1/2 self-start">
                                <h3 class="text-lg line-clamp-2">
                                    Lorem ipsum dolor sit amet consec Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                    amet.
                                </h3>
                                <p class="mt-1 text-sm">
                                    TIPE A
                                </p>
                                <label class="mt-1 text-xs bg-yellow-400 text-white px-3 py-0.5 rounded-[4px]">
                                    Pending
                                </label>
                                <label class="mt-1 text-xs bg-yellow-500 text-white px-3 py-0.5 rounded-[4px]">
                                    On Progress
                                </label>
                                <label class="mt-1 text-xs bg-teal-500 text-white px-3 py-0.5 rounded-[4px]">
                                    Success
                                </label>
                                <label class="mt-1 text-xs bg-rose-400 text-white px-3 py-0.5 rounded-[4px]">
                                    Failed
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-3">
                            <p class="mt-3 text-lg text-feprimary font-semibold">
                                2 x Rp. 1.000.000
                            </p>
                        </div>
                    </div>
                    <div class="bg-slate-50 text-center py-1">
                        <a href="" class="text-xs">
                            Produk Lainnya
                        </a>
                    </div>
                    <div class="py-2 px-5 flex items-center justify-between border-t border-zinc-300">
                        <div>
                            <button class="bg-feprimary px-3 py-2 text-xs text-white rounded-md hover:bg-feprimary/50">
                                Bayar Sekarang
                            </button>
                            <button
                                class="border border-feprimary px-3 py-2 text-xs text-feprimary rounded-md hover:bg-feprimary/20">
                                Lihat Detail
                            </button>
                        </div>
                        <h1 class="text-sm">
                            Total Belanja: <span class="text-sm font-semibold">Rp. 2.000.000</span>
                        </h1>
                    </div>
                </div>
                <div class="item-cart border border-zinc-300 rounded-lg">
                    <div class="mt-3 px-5 flex justify-between">
                        <button class="bg-feprimary px-3 text-xs text-white rounded-md hover:bg-feprimary/50">
                            Hubungi Penjual
                        </button>
                        <h1 class="text-lg">#151-FUR3YD73G91</h1>
                    </div>
                    <div class="mt-3 px-5 mb-5 flex items-center justify-between">
                        <div class="flex w-[80%] gap-4 items-center">
                            <img src="https://res.cloudinary.com/ruparupa-com/image/upload/w_400,h_400/f_auto,q_auto:eco/v1664809960/Products/10447967_1.jpg"
                                alt="" class="w-30 rounded-lg object-cover border border-[#E5E5E5]">
                            <div class="w-1/2 self-start">
                                <h3 class="text-lg line-clamp-2">
                                    Lorem ipsum dolor sit amet consec Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                    amet.
                                </h3>
                                <p class="mt-1 text-sm">
                                    TIPE A
                                </p>

                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-3">
                            <p class="mt-3 text-lg text-feprimary font-semibold">
                                2 x Rp. 1.000.000
                            </p>
                        </div>
                    </div>
                    <div class="py-2 px-5 flex items-center justify-between border-t border-zinc-300">
                        <div>
                            <button class="bg-feprimary px-3 py-2 text-xs text-white rounded-md hover:bg-feprimary/50">
                                Bayar Sekarang
                            </button>
                            <button
                                class="border border-feprimary px-3 py-2 text-xs text-feprimary rounded-md hover:bg-feprimary/20">
                                Lihat Detail
                            </button>
                        </div>
                        <h1 class="text-sm">
                            Total Belanja: <span class="text-sm font-semibold">Rp. 2.000.000</span>
                        </h1>
                    </div>
                </div>
                <div class="item-cart border border-zinc-300 rounded-lg">
                    <div class="mt-3 px-5 flex justify-between">
                        <button class="bg-feprimary px-3 text-xs text-white rounded-md hover:bg-feprimary/50">
                            Hubungi Penjual
                        </button>
                        <h1 class="text-lg">#151-FUR3YD73G91</h1>
                    </div>
                    <div class="mt-3 px-5 mb-5 flex items-center justify-between">
                        <div class="flex w-[80%] gap-4 items-center">
                            <img src="https://res.cloudinary.com/ruparupa-com/image/upload/w_400,h_400/f_auto,q_auto:eco/v1664809960/Products/10447967_1.jpg"
                                alt="" class="w-30 rounded-lg object-cover border border-[#E5E5E5]">
                            <div class="w-1/2 self-start">
                                <h3 class="text-lg line-clamp-2">
                                    Lorem ipsum dolor sit amet consec Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                    amet.
                                </h3>
                                <p class="mt-1 text-sm">
                                    TIPE A
                                </p>

                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-3">
                            <p class="mt-3 text-lg text-feprimary font-semibold">
                                2 x Rp. 1.000.000
                            </p>
                        </div>
                    </div>
                    <div class="py-2 px-5 flex items-center justify-between border-t border-zinc-300">
                        <div>
                            <button class="bg-feprimary px-3 py-2 text-xs text-white rounded-md hover:bg-feprimary/50">
                                Bayar Sekarang
                            </button>
                            <button
                                class="border border-feprimary px-3 py-2 text-xs text-feprimary rounded-md hover:bg-feprimary/20">
                                Lihat Detail
                            </button>
                        </div>
                        <h1 class="text-sm">
                            Total Belanja: <span class="text-sm font-semibold">Rp. 2.000.000</span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.main.footer')
</x-app-layout>
