<x-app-layout>
    <div class="flex min-h-[calc(100vh-18rem)] justify-center lg:mx-52 mt-5" x-data="checkout">
        <div class="card w-full flex justify-between">
            <div class="w-full bg-feprimary h-35 rounded-lg">
                <div class="flex justify-center items-center h-full">
                    <h1 class="flex items-center gap-3">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="48" height="48" fill="url(#pattern0_1_2386)" />
                            <defs>
                                <pattern id="pattern0_1_2386" patternContentUnits="objectBoundingBox" width="1"
                                    height="1">
                                    <use xlink:href="#image0_1_2386" transform="scale(0.0111111)" />
                                </pattern>
                                <image id="image0_1_2386" width="90" height="90"
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAABmJLR0QA/wD/AP+gvaeTAAAEbUlEQVR4nO2cz4tWVRjHP09BI6SOqwqy39PGiVpmucvAjZAum6AWRe6iheAmKlqN2B+gLgNdVPQDbFdSQZg7pRIkpBa1y0odtSL7trh3GJt5z7z3/Lhneu88HxgG7pnznOd+5/s+77n33HvAcRzHcRzHcRzHcRxnOFiJIJI2APuAOWAWuL1E3DXkKvAtcBw4YmZ/5gbMFlrSVuAT4NHcWP9TzgK7zeynnCBZQrdOPs1wRV7kLPB4jrNvyUxgH8MXGeAx4OWcALlCz2X2nySyzjW3dFwBNubEmCAWzGxTaudkR0vaTJrI14DXgRlgqv39BnA9NZdKY21sz7kukrYpnquStgfiPSHpWkLMmmNtS9Urp0bfk9Bn3sy+HtVgZqeAgxn51Bgr5ZyBPKG3JvQ5Pqb9WEoiFcdKOWegvqN/HtP+Q0oiAX4c0z4ul1FMjKMfWK3RzG4k5pISa9VcAkyMo5/PGK80LyT0WROhUwZ9VdLOjDGLIOlp4JWErhNTOjYAJyQdyhg3i3bsE20usSQ7OunKUNI08HvqoABmNnJsScqJWyH+tJldju2U6ujk/+wASDr3VKGTa9UASDr3NXO0pNsCTQu5sYGRH21JUwViV3V0idKxJXA85UKia4zQmDFUdXSJ0vFg4PiXBWJ/ETg+UyB2VUffndjvZnYEjr9bIPZ7geNPFohdVeh7E/vdzJ5RB83sU+BkRtzPzSzUf29G3EXqTQQkXcq/Xay/Jd0RiP+wpIsJMX+R9FAg5l2SbhTI+1KKZtGOVrPKUGKl4VZg/6gGM/uexvG/RsS7COwxswuB9v3kr5ECbFaNlRZJswVcsch1ScEyJGlG0skOcT5TwMltnPsl/VEw79l+1P1v0rsKJixJH0ha9VaApJ2Sjkg6J+lK+/OdpMOSnhrT1yR9VDjnXWVVHZ34S4WTlqTXesz3zR7yfTE2j5Sa1cd9jrckPVs6qKTnaFbBSxM980gRuo/pjQHHJM1Lyv7CUlMuDgDvUOhBzmVEmy3lpEpcrIzCgAPA+1rlC3Icku4DPgTmKTPLGEUVofuesO8Fzks6JOnOrp3UzJPfBs4Dz/SWXUO0BtEfKzUT9lpP7PwDnAI+Br4CLgC/0eS9hebexQ4aYbfTn4OXc9nMpmM6RAmtAisrAyJqpSXWAev5hv9yorSIFXo9L2EtJ0oLFzodF7oSvZYOr9FLuKMr0avQ7uglfNZRiX6Ebi9Wkl+WGSCbFLHSEuNoLxsr6axJjNBeNlbSWRMXOg8XuhK9lA6v0StxR1eiF6Hd0SvxWUclygrtFytBOl+0dHW0l40wnbTpKrSXjTCdtHFH51PU0X09NDME3NGVKCq01+gwLnQlitZoLx1higrdx6OvQ6HTS/xdhT6XkcjQ6aRNV6FLbio1NDpp06kkqHlZ/TTNHp3OEmdoNof9a9wfdnJ0u8vsbppdZ52GMzTbHY8VGeKfj56i2XV2DniE9bMv6SILwDc0e+od7Sqy4ziO4ziO4ziO4zjO0PgXESy+bJ6T9koAAAAASUVORK5CYII=" />
                            </defs>
                        </svg>

                        <span class="text-3xl font-semibold text-white">Checkout</span>
                    </h1>
                </div>

                <div class="mt-10">
                    <form action="{{ route('checkout.store') }}" method="post">
                        @csrf
                        <div class="card w-full flex justify-between">
                            <div class="w-[75%]">
                                <h1 class="text-feprimary text-xl">
                                    Informasi Pengiriman
                                </h1>

                                <hr class="my-5 text-slate-200">

                                <div>
                                    <div class="grid grid-cols-2 gap-5">
                                        <div class="flex flex-col gap-2">
                                            <label for="name" class="text-base text-[#515151] font-semibold">Nama
                                                Penerima</label>
                                            <input type="text" name="receiver_name"
                                                class="w-full rounded-lg border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                                                placeholder="Masukkan Nama Penerima">

                                            @error('receiver_name')
                                                <span class="text-red-500 text-xs my-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="phone_number"
                                                class="text-base text-[#515151] font-semibold">Nomor Telepon</label>
                                            <input type="number" name="receiver_phone"
                                                class="w-full rounded-lg border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                                                placeholder="Masukkan Nomor Telepon">

                                            @error('receiver_phone')
                                                <span class="text-red-500 text-xs my-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="provincy"
                                                class="text-base text-[#515151] font-semibold">Provinsi</label>
                                            <select name="receiver_province"
                                                class="w-full rounded-lg border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                                                @change="getCity($event)">
                                                <option value="">Pilih Provinsi</option>
                                                <template x-for="province in provinces" :key="province.id">
                                                    <option x-text="province.name" :value="province.name"></option>
                                                </template>
                                            </select>

                                            @error('receiver_province')
                                                <span class="text-red-500 text-xs my-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="city"
                                                class="text-base text-[#515151] font-semibold">Kota/Kabupaten</label>
                                            <select name="receiver_city"
                                                class="w-full rounded-lg border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0">
                                                <option value="">Pilih Kota/Kabupaten</option>
                                                <template x-for="city in cities" :key="city.id">
                                                    <option x-text="city.name" :value="city.name"></option>
                                                </template>
                                            </select>

                                            @error('receiver_city')
                                                <span class="text-red-500 text-xs my-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="postal_code" class="text-base text-[#515151] font-semibold">Kode
                                                Pos</label>
                                            <input type="number" name="receiver_postal_code"
                                                class="w-full rounded-lg border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                                                placeholder="Masukkan Kode Pos">

                                            @error('receiver_postal_code')
                                                <span class="text-red-500 text-xs my-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <label for="postal_code"
                                                class="text-base text-[#515151] font-semibold">Alamat Lengkap</label>
                                            <textarea name="receiver_address" id="" rows="1"
                                                class="w-full rounded-lg border-2 text-black border-zinc-200 focus:border-feprimary focus:ring-0"
                                                placeholder="Masukkan Alamat Lengkap/Pesan"></textarea>

                                            @error('receiver_address')
                                                <span class="text-red-500 text-xs my-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
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
                                                <p class="text-base">Total Harga :</p>
                                                <p class="text-base text-feprimary">
                                                    {{-- get Cache from php laravel --}}
                                                    @php
                                                        $total = 0;
                                                        $userKey = 'items_' . Auth::user()->id;
                                                        $carts = Cache::get($userKey);
                                                        $carts = $carts ? $carts : [];
                                                        foreach ($carts as $cartId) {
                                                            $cart = App\Models\Cart::find($cartId);
                                                            $total += $cart->product->price * $cart->quantity;
                                                        }
                                                        echo 'Rp. ' . number_format($total, 0, ',', '.');
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="flex justify-between">
                                                <p class="text-base">Biaya Aplikasi :</p>
                                                <p class="text-base text-feprimary">
                                                    {{-- get Cache from php laravel --}}
                                                    Rp. 5.000
                                                </p>
                                            </div>
                                            <hr class="my-2 border-slate-200">
                                            <div class="flex justify-between">
                                                <p class="text-base font-semibold">Total Bayar :</p>
                                                <p class="text-base text-feprimary font-semibold">
                                                    {{-- get Cache from php laravel --}}
                                                    @php
                                                        echo 'Rp. ' . number_format($total + 5000, 0, ',', '.');
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="m-5">
                                            <button type="submit"
                                                class="w-full bg-feprimary text-white text-lg font-semibold py-2 rounded-lg focus:outline-none disabled:bg-feprimary/40 disabled:cursor-not-allowed">
                                                Buat Pesanan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('partials.main.footer')
    <script>
        // alpine js
        function checkout() {
            return {
                isDisabled: true,
                provinces: [],
                cities: [],
                selectedProvince: null,

                init() {
                    this.isDisabled = true;
                    this.getProvince();
                },

                getProvince() {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
                        .then(response => response.json())
                        .then(data => {
                            this.provinces = data;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan dalam data wilayah, silahkan coba lagi');
                        });
                },

                getCity(event) {
                    console.log('asas', event.target.value);
                    let provinceName = event.target.value;
                    let provinceId = this.provinces.find(province => province.name === provinceName).id;

                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                        .then(response => response.json())
                        .then(data => {
                            this.cities = data;
                            console.log(data);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan dalam data wilayah, silahkan coba lagi');
                        });
                },

                submit() {
                    this.isDisabled = false;
                }
            }
        }
    </script>
</x-app-layout>
