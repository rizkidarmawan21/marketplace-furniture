<x-app-layout>
    <div class="flex min-h-[calc(100vh-18rem)] justify-center lg:mx-52 mt-15">
        <div class="card w-full flex justify-between" x-data="{ itemSelected: [] }">
            <div class="w-[75%] border border-[#DCDCDC] rounded-xl">
                {{-- debug itemSelected value --}}
                {{-- <div x-text="itemSelected"></div> --}}
                @forelse ($carts as $item)
                    <div class="item-cart">
                        <div class="mt-5 px-5 mb-5 flex items-center justify-between">
                            <div class="flex w-full gap-4 items-center">
                                <input type="checkbox" class="h-5 w-5 text-feprimary border-gray-300 focus:ring-0"
                                    :value="{{ $item->id }}" x-model="itemSelected"
                                    @change="if (!$event.target.checked) itemSelected = itemSelected.filter(i => i !== {{ $item->id }})">
                                <img src="{{ asset($item->product->productImages[0]->image_path) }}" alt=""
                                    class="w-30 h-25 rounded-lg object-cover border border-[#E5E5E5]">
                                <div class="w-1/2 self-start">
                                    <h3 class="text-lg line-clamp-2">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="mt-3 text-lg text-feprimary font-semibold">
                                        Rp. {{ number_format($item->product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-3">
                                <form action="{{ route('cart.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button>
                                        <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="24" height="24" fill="url(#pattern0_1_2093)" />
                                            <defs>
                                                <pattern id="pattern0_1_2093" patternContentUnits="objectBoundingBox"
                                                    width="1" height="1">
                                                    <use xlink:href="#image0_1_2093" transform="scale(0.01)" />
                                                </pattern>
                                                <image id="image0_1_2093" width="100" height="100"
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg>
                                    </button>
                                </form>
                                <div class="flex items-center p-1 rounded-full bg-feprimary" x-data="{ quantity: {{ $item->quantity }} }">
                                    <div>
                                        <form action="{{ route('cart.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="type" value="decrement">

                                            <button class="bg-slate-100 text-feprimary rounded-full px-2.5"
                                                :type="quantity == 1 ? 'button' : 'submit'">
                                                <span class="text-lg">-</span>
                                            </button>
                                        </form>
                                    </div>
                                    <input type="text"
                                        class="bg-transparent w-10 !p-0 text-lg text-white text-center font-semibold border-0 outline-none focus:ring-0"
                                        min="1" max="{{ $item->product->stock }}" :value="quantity"
                                        readonly>

                                    <div>
                                        <form action="{{ route('cart.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="type" value="increment">
                                            <button
                                                :type="quantity == {{ (int) $item->product->stock }} ? 'button' : 'submit'"
                                                class="bg-slate-100 text-feprimary rounded-full px-2">
                                                <span class="text-lg">+</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="border-[#DCDCDC]">
                    </div>
                @empty
                    <div class="item-cart">
                        <div class="mt-5 px-5 mb-5 flex items-center justify-center h-20">
                            <p class="text-center">
                                Tidak ada produk di keranjang
                            </p>
                        </div>
                        <hr class="border-[#DCDCDC]">
                    </div>
                @endforelse
            </div>
            <div class="detail-cart w-[35%] pl-10">
                <div class="w-full bg-white border border-feprimary rounded-xl">
                    <div>
                        <div class="w-full bg-feprimary rounded-t-lg border border-feprimary">
                            <h1 class="text-xl text-semibold text-center text-white my-2">
                                Rincian Belanja
                            </h1>
                        </div>
                        <div class="m-5">
                            <div class="flex justify-between">
                                <p class="text-base">Harga ({{ count($carts) }}) :</p>
                                <p class="text-base text-feprimary">

                                    @php
                                        $totalPrice = 0;
                                        foreach ($carts as $item) {
                                            $totalPrice += $item->product->price * $item->quantity;
                                        }
                                    @endphp

                                    Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <br>
                        <div class="m-5">
                            <form action="{{ route('checkout.index') }}" method="post">
                                @csrf
                                <input type="text" name="items" :value="JSON.stringify(itemSelected)" hidden>
                                {{-- error --}}
                                @error('items')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror

                                <button
                                    class="w-full bg-feprimary text-white text-lg font-semibold py-2 rounded-lg focus:outline-none">
                                    Buat Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.main.footer')
</x-app-layout>
