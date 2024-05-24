<x-app-layout>
    <div class="flex justify-center  mt-5">
        <div class="w-[90%] lg:container">
            <div>
                <span>
                    <a href="" class="text-black">Home</a>
                </span>
                <span class="text-black">
                    /
                </span>
                <span>
                    <a href="" class="text-feprimary">Katalog</a>
                </span>
            </div>


            <div class="mt-5 w-full flex">
                <div class="w-[50%] h-full flex flex-col items-center ">
                    <div class="image-product w-full h-full flex items-center justify-center zoom-container">
                        <img src="{{ asset($product->productImages[0]->image_path) }}" alt=""
                            class="w-full h-full lg:!h-[500px] rounded-xl object-cover !shadow-none xzoom"
                            id="xzoom-default" xoriginal="{{ asset($product->productImages[0]->image_path) }}">
                    </div>
                    {{-- <div class="mt-2 list-gallery w-full h-full overflow-x-auto no-scrollbar flex gap-2 items-center">
                        <a class="flex-shrink-0"
                            href="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg">
                            <img src="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg"
                                alt=""
                                class="xzoom-gallery !m-0 w-25 hover:w-26 transition-all rounded-xl !shadow-none object-cover">
                        </a>
                        <a class="flex-shrink-0"
                            href="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg">
                            <img src="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg"
                                alt=""
                                class="xzoom-gallery !m-0 w-25 hover:w-26 transition-all rounded-xl !shadow-none object-cover">
                        </a>
                        <a class="flex-shrink-0"
                            href="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg">
                            <img src="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg"
                                alt=""
                                class="xzoom-gallery !m-0 w-25 hover:w-26 transition-all rounded-xl !shadow-none object-cover">
                        </a>
                        <a class="flex-shrink-0"
                            href="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg">
                            <img src="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg"
                                alt=""
                                class="xzoom-gallery !m-0 w-25 hover:w-26 transition-all rounded-xl !shadow-none object-cover">
                        </a>
                        <a class="flex-shrink-0"
                            href="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg">
                            <img src="https://mjsfurniture.com/wp-content/uploads/2021/01/Sofa-Modern-Minimalis-Kayu-Solid-Jepara.jpg"
                                alt=""
                                class="xzoom-gallery !m-0 w-25 hover:w-26 transition-all rounded-xl !shadow-none object-cover">
                        </a>
                    </div> --}}
                </div>
                <div class="w-[50%] h-full pl-20" x-data="{ quantity: 1 }">
                    <h1 class="text-4xl text-black font-medium">
                        {{ $product->name }}
                    </h1>
                    <p class="mb-2 mt-3 flex gap-3">
                        <span class="text-lg">Kategori</span>
                        <a href="" class="text-feprimary">
                            <span class="text-lg">
                                {{ $product->category->name }}
                            </span>
                        </a>
                    </p>
                    <p class="">
                        Terjual 1723
                    </p>
                    <div class="my-8">
                        <h2 class="text-3xl font-medium text-feprimary">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            <span class="text-sm !text-black">/ Unit</span>
                        </h2>
                    </div>
                    <p class="flex gap-3">
                        <span class="text-lg">Ukuran</span>
                        <a href="" class="text-feprimary">
                            <span class="text-lg">
                                {{ $product->size }}
                            </span>
                        </a>
                    </p>
                    <p class="flex gap-3">
                        <span class="text-lg">Warna</span>
                        <a href="" class="text-feprimary">
                            <span class="text-lg">
                                {{ $product->color }}
                            </span>
                        </a>
                    </p>
                    <div class="my-8 flex gap-5">
                        <p class="mb-2 text-lg">
                            Kuantitas
                        </p>
                        <div class="flex items-center">
                            <div>
                                <button class="bg-slate-100 rounded-full px-2.5"
                                    @click="quantity > 1 ? quantity-- : quantity = 1">
                                    <span class="text-xl">-</span>
                                </button>
                            </div>

                            <input type="text"
                                class="w-15 text-3xl text-black text-center font-medium border-0 outline-none focus:ring-0"
                                min="1" max="{{ $product->stock }}" :value="quantity" readonly>

                            <div>
                                <button class="bg-slate-100 rounded-full px-2"
                                    @click="quantity < {{ $product->stock }} ? quantity++ : quantity = {{ $product->stock }}">
                                    <span class="text-xl">+</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="my-8 space-x-5">
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                            <input type="text" name="quantity" :value="quantity" hidden>
                            <button type="submit"
                                class="px-5 py-2 border border-feprimary bg-feprimary rounded-lg text-white">
                                Masukkan Keranjang
                            </button>
                        </form>
                        {{-- <button class="px-5 py-2 border border-feprimary bg-transparant rounded-lg text-feprimary">
                            Masukkan Keranjang
                        </button> --}}
                    </div>

                </div>
            </div>
            <div class="mt-10 description-product">
                <h1 class="text-2xl text-black font-medium ">
                    Deskripsi Produk
                </h1>
                <div class="mt-5">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>
    @include('partials.main.footer')
</x-app-layout>
