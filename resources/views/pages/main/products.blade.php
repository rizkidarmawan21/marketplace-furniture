<x-app-layout :headerSearch="false">
    <div class="w-full h-60 relative flex flex-col items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-cover bg-center bg-no-repeat"
                style="background-image: url('https://hips.hearstapps.com/hmg-prod/images/index-furniture-65f07553eef2f.jpg'); filter: brightness(0.5)">
            </div>
        </div>
        <h1 class="text-2xl text-white font-semibold mb-4 z-10">Cari Produk Impian Anda</h1>
        <div class="w-1/3 relative flex z-10" x-data="{ 'search': '{{ request('search') }}' }">
            {{-- Searching --}}
            <input type="text"
                class="w-full rounded-xl border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                placeholder="Cari Furnitur" x-model="search">
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
            <div class="min-h-[calc(100vh-18rem)] mt-5">
                <div class="grid grid-cols-5">
                    <div class="p-5" x-data="{ filterCategory: '' }">
                        <h2 class="text-base font-semibold">Kategori</h2>
                        <div class="mt-3">
                            <label class="flex items-center gap-2"
                                @click="window.location.href = window.location.pathname">
                                <input type="checkbox" class="h-5 w-5 text-feprimary border-gray-300 focus:ring-0"
                                    :checked="!(window.location.search.includes('category') && new URL(window.location.href)
                                        .searchParams
                                        .get('category'))">
                                <span class="text-xs">Semua</span>
                            </label>
                        </div>
                        @forelse ($listCategory as $item)
                            <div class="mt-3">
                                <label class="flex items-center gap-2"
                                    @click="
                                    const url = new URL(window.location.href);
                                    const categories = url.searchParams.get('category') ? url.searchParams.get('category').split(',') : [];
                                    if (categories.includes('{{ $item->id }}')) {
                                        categories.splice(categories.indexOf('{{ $item->id }}'), 1);
                                    } else {
                                        categories.push('{{ $item->id }}');
                                    }
                                    url.searchParams.set('category', categories.join(','));
                                    url.searchParams.delete('page');
                                    window.location.href = url.href;
                                ">
                                    <input type="checkbox" class="h-5 w-5 text-feprimary border-gray-300 focus:ring-0"
                                        :checked="window.location.search.includes('{{ $item->id }}')">
                                    <span class="text-xs">
                                        {{ $item->name }}
                                    </span>
                                </label>
                            </div>
                        @empty
                            <div class="mt-3">
                                <label class="flex items-center gap-2">
                                    <span class="text-xs">
                                        Tidak ada kategori
                                    </span>
                                </label>
                            </div>
                        @endforelse
                    </div>
                    <div class="col-span-4">
                        <div class="w-full">
                            <div>
                                <div class="w-full grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 2xl:grid-cols-5 gap-3 place-content-center"
                                    x-data="">

                                    @forelse ($products as $item)
                                        <div @click="
                                              window.location.href = '{{ route('products.show', $item->id) }}'
                                            "
                                            class="card relative lg:w-45 xl:w-50 h-full gap-2  bg-white border border-[#CACACA] rounded-xl hover:cursor-pointer">
                                            <img src="{{ asset($item->productImages[0]->image_path) }}" alt=""
                                                alt="" class="w-full h-[180px] object-cover rounded-t-xl">
                                            <div class="border-t-2 border-feprimary px-5 py-2">
                                                <h2 class="text-md text-black font-medium line-clamp-2">
                                                    {{ $item->name }}
                                                </h2>
                                                <div class="mt-2 flex items-center gap-2">
                                                    <svg width="18" height="17" viewBox="0 0 16 15"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M2.97 0.683374C3.06389 0.573609 3.18044 0.485485 3.31163 0.425065C3.44283 0.364646 3.58556 0.333365 3.73 0.333374H12.27C12.4144 0.333365 12.5572 0.364646 12.6884 0.425065C12.8196 0.485485 12.9361 0.573609 13.03 0.683374L15.639 3.72737C15.8719 3.99921 16 4.34539 16 4.70337V4.95837C16.0001 5.45335 15.8455 5.93598 15.5578 6.3388C15.2702 6.74162 14.8639 7.0445 14.3957 7.20512C13.9275 7.36574 13.4208 7.37606 12.9465 7.23464C12.4721 7.09323 12.0538 6.80715 11.75 6.41637C11.5281 6.70214 11.2438 6.93335 10.9188 7.09229C10.5938 7.25124 10.2368 7.3337 9.875 7.33337C9.51321 7.33378 9.15612 7.25135 8.83112 7.0924C8.50611 6.93345 8.22181 6.7022 8 6.41637C7.77819 6.7022 7.49389 6.93345 7.16888 7.0924C6.84388 7.25135 6.48679 7.33378 6.125 7.33337C5.76321 7.33378 5.40612 7.25135 5.08112 7.0924C4.75611 6.93345 4.47181 6.7022 4.25 6.41637C3.94619 6.80715 3.52788 7.09323 3.05354 7.23464C2.57919 7.37606 2.07252 7.36574 1.60432 7.20512C1.13613 7.0445 0.729823 6.74162 0.442182 6.3388C0.154542 5.93598 -5.45986e-05 5.45335 1.44645e-08 4.95837V4.70337C1.26075e-05 4.34539 0.128057 3.99921 0.361 3.72737L2.971 0.682374L2.97 0.683374ZM4.75 4.95837C4.75 5.32305 4.89487 5.67278 5.15273 5.93065C5.41059 6.18851 5.76033 6.33337 6.125 6.33337C6.48967 6.33337 6.83941 6.18851 7.09727 5.93065C7.35513 5.67278 7.5 5.32305 7.5 4.95837C7.5 4.82577 7.55268 4.69859 7.64645 4.60482C7.74022 4.51105 7.86739 4.45837 8 4.45837C8.13261 4.45837 8.25979 4.51105 8.35355 4.60482C8.44732 4.69859 8.5 4.82577 8.5 4.95837C8.5 5.32305 8.64487 5.67278 8.90273 5.93065C9.16059 6.18851 9.51033 6.33337 9.875 6.33337C10.2397 6.33337 10.5894 6.18851 10.8473 5.93065C11.1051 5.67278 11.25 5.32305 11.25 4.95837C11.25 4.82577 11.3027 4.69859 11.3964 4.60482C11.4902 4.51105 11.6174 4.45837 11.75 4.45837C11.8826 4.45837 12.0098 4.51105 12.1036 4.60482C12.1973 4.69859 12.25 4.82577 12.25 4.95837C12.25 5.32305 12.3949 5.67278 12.6527 5.93065C12.9106 6.18851 13.2603 6.33337 13.625 6.33337C13.9897 6.33337 14.3394 6.18851 14.5973 5.93065C14.8551 5.67278 15 5.32305 15 4.95837V4.70337C15 4.5842 14.9575 4.46895 14.88 4.37837L12.27 1.33337H3.73L1.12 4.37837C1.04255 4.46895 0.999991 4.5842 1 4.70337V4.95837C1 5.32305 1.14487 5.67278 1.40273 5.93065C1.66059 6.18851 2.01033 6.33337 2.375 6.33337C2.73967 6.33337 3.08941 6.18851 3.34727 5.93065C3.60513 5.67278 3.75 5.32305 3.75 4.95837C3.75 4.82577 3.80268 4.69859 3.89645 4.60482C3.99022 4.51105 4.11739 4.45837 4.25 4.45837C4.38261 4.45837 4.50979 4.51105 4.60355 4.60482C4.69732 4.69859 4.75 4.82577 4.75 4.95837ZM1.5 7.83337C1.63261 7.83337 1.75979 7.88605 1.85355 7.97982C1.94732 8.07359 2 8.20077 2 8.33337V14.3334H3V9.33337C3 9.06816 3.10536 8.8138 3.29289 8.62627C3.48043 8.43873 3.73478 8.33337 4 8.33337H7C7.26522 8.33337 7.51957 8.43873 7.70711 8.62627C7.89464 8.8138 8 9.06816 8 9.33337V14.3334H14V8.33337C14 8.20077 14.0527 8.07359 14.1464 7.97982C14.2402 7.88605 14.3674 7.83337 14.5 7.83337C14.6326 7.83337 14.7598 7.88605 14.8536 7.97982C14.9473 8.07359 15 8.20077 15 8.33337V14.3334H15.5C15.6326 14.3334 15.7598 14.3861 15.8536 14.4798C15.9473 14.5736 16 14.7008 16 14.8334C16 14.966 15.9473 15.0932 15.8536 15.1869C15.7598 15.2807 15.6326 15.3334 15.5 15.3334H0.5C0.367392 15.3334 0.240215 15.2807 0.146447 15.1869C0.0526784 15.0932 1.44645e-08 14.966 1.44645e-08 14.8334C1.44645e-08 14.7008 0.0526784 14.5736 0.146447 14.4798C0.240215 14.3861 0.367392 14.3334 0.5 14.3334H1V8.33337C1 8.20077 1.05268 8.07359 1.14645 7.97982C1.24021 7.88605 1.36739 7.83337 1.5 7.83337ZM4 14.3334H7V9.33337H4V14.3334ZM9 9.33337C9 9.06816 9.10536 8.8138 9.29289 8.62627C9.48043 8.43873 9.73478 8.33337 10 8.33337H12C12.2652 8.33337 12.5196 8.43873 12.7071 8.62627C12.8946 8.8138 13 9.06816 13 9.33337V12.3334C13 12.5986 12.8946 12.8529 12.7071 13.0405C12.5196 13.228 12.2652 13.3334 12 13.3334H10C9.73478 13.3334 9.48043 13.228 9.29289 13.0405C9.10536 12.8529 9 12.5986 9 12.3334V9.33337ZM12 9.33337H10V12.3334H12V9.33337Z"
                                                            fill="#C6B38D" />
                                                    </svg>
                                                    <span class="text-base text-feprimary">
                                                        My Product
                                                    </span>
                                                </div>
                                                <div class="mt-3">
                                                    <p>
                                                        <span class="text-base text-black">
                                                            Rp. {{ number_format($item->price, 0, ',', '.') }} / Unit
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="absolute top-2 right-2">
                                                <form action="{{ route('cart.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $item->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button
                                                        class="border border-[#CACACA] bg-white p-2 rounded-full hover:bg-zinc-100">
                                                        <svg width="16" height="16" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.6666 12.3333C12.6666 13.0733 12.0733 13.6666 11.3333 13.6666C10.9797 13.6666 10.6405 13.5262 10.3905 13.2761C10.1404 13.0261 9.99996 12.6869 9.99996 12.3333C9.99996 11.5933 10.5933 11 11.3333 11C11.6869 11 12.0261 11.1405 12.2761 11.3905C12.5261 11.6406 12.6666 11.9797 12.6666 12.3333ZM4.66663 11C3.92663 11 3.33329 11.5933 3.33329 12.3333C3.33329 12.6869 3.47377 13.0261 3.72382 13.2761C3.97387 13.5262 4.313 13.6666 4.66663 13.6666C5.40663 13.6666 5.99996 13.0733 5.99996 12.3333C5.99996 11.5933 5.40663 11 4.66663 11ZM4.79996 8.75331L4.77996 8.83331C4.77996 8.92665 4.85329 8.99998 4.94663 8.99998H12.6666V10.3333H4.66663C4.313 10.3333 3.97387 10.1928 3.72382 9.94279C3.47377 9.69274 3.33329 9.3536 3.33329 8.99998C3.33329 8.76665 3.39329 8.54665 3.49329 8.35998L4.39996 6.72665L1.99996 1.66665H0.666626V0.333313H2.84663L3.47329 1.66665H13.3333C13.7 1.66665 14 1.96665 14 2.33331C14 2.44665 13.9666 2.55998 13.92 2.66665L11.5333 6.97998C11.3066 7.38665 10.8666 7.66665 10.3666 7.66665H5.39996L4.79996 8.75331V8.75331ZM5.66663 6.33331H6.66663V4.99998H5.03996L5.66663 6.33331ZM7.33329 4.99998V6.33331H9.33329V4.99998H7.33329ZM9.33329 4.33331V2.99998H7.33329V4.33331H9.33329ZM11.4066 4.99998H9.99996V6.33331H10.6666L11.4066 4.99998ZM12.52 2.99998H9.99996V4.33331H11.78L12.52 2.99998ZM4.09329 2.99998L4.71996 4.33331H6.66663V2.99998H4.09329Z"
                                                                fill="#C6B38D" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="w-full h-full flex items-center justify-center">
                                            <p class="text-lg text-black">Tidak ada produk</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.main.footer')
</x-app-layout>
