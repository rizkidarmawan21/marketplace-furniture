<header class="flex justify-center ">
    <div class="w-[90%] lg:container py-5 flex justify-between items-center">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/icons/logo.png') }}" class="w-35" alt="">
        </a>
        <div class="w-1/2 relative flex" x-data="{ searching: '' }">

            @if ($headerSearch ?? true)
                {{-- Searching --}}
                <input type="text"
                    class="w-full rounded-xl border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                    placeholder="Yuk mau beli apa ?" x-model="searching">
                <button
                    @click="
                        const url = '{{ route('products.index') }}?search=' + searching;
                        window.location.href = url;
                    "
                    class="absolute bg-feprimary rounded-lg px-2.5 py-2 right-2 top-1/2 transform -translate-y-1/2 text-white hover:bg-feprimary/70">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current"
                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                </button>
            @endif

        </div>
        {{-- <div class="border-l-2 border-zinc-200 pl-3"> --}}
        <div class="">
            {{-- Button --}}
            {{-- Login, Register, Cart, User --}}

            <div class="space-x-2">
                @guest
                    <a href="" class="px-6 text-lg hover:text-feprimary">
                        Artikel
                    </a>
                    <a href="{{ route('login') }}"
                        class="border border-feprimary bg-feprimary text-white px-6 py-2 rounded-xl hover:bg-feprimary/70 transition duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="border border-feprimary text-feprimary px-6 py-2 rounded-xl hover:bg-feprimary/70 transition duration-300">
                        Daftar
                    </a>
                @endguest
            </div>

            @auth
                <div class="space-x-7 flex items-center">
                    <a href="" class="px-6 text-lg hover:text-feprimary">
                        Artikel
                    </a>
                    <div class="relative" x-data="{ show: false }">
                        <button @click="show = !show">
                            <svg width="23" height="31" viewBox="0 0 30 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15" cy="8" r="7" stroke="#626262" stroke-width="2" />
                                <path d="M1 30C2 10 28 10 29 30" stroke="#626262" stroke-width="2" />
                            </svg>
                        </button>
                        <div class="z-99999 absolute right-0 w-40 mt-2 bg-zinc-50 rounded shadow-xl" x-show="show" x-cloak>
                            <a href="{{ route('profile') }}"
                                class="transition-colors text-sm duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-feprimary hover:text-white">
                                Profil Saya
                            </a>
                            <a href="{{ route('my-orders.index') }}"
                                class="transition-colors text-sm duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-feprimary hover:text-white">
                                Pesanan Saya
                            </a>
                            <form action="{{ route('logout') }}" method="POST"
                                class="mt-2 text-center border-t border-slate-200">
                                @csrf
                                <button class="w-full py-2 bg-slate-100 text-sm text-black">Logout</button>
                            </form>
                        </div>
                    </div>
                    <div class="relative" x-data="">
                        <button @click="window.location.href = '{{ route('cart.index') }}'">
                            <svg width="21" height="33" viewBox="0 0 27 33" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="1" y="10.5" width="25" height="21" stroke="#626262" stroke-width="2" />
                                <path d="M6 9.74997C8.5 -1.25002 20 -1.25 22.5 9.74997" stroke="#626262" stroke-width="2" />
                            </svg>

                        </button>
                        <label for="" class="absolute w-6 h-6 text-xs">
                            {{ $cartCount }}
                        </label>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</header>
