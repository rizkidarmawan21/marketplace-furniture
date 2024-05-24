<x-app-layout :headerSearch="false">
    <div class="min-h-[calc(100vh-18rem)] justify-center  mt-5">
        <div class="flex items-center gap-3">
            <a href="{{ route('my-orders.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 fill-current">
                    <path
                        d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM271 135c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-87 87 87 87c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L167 273c-9.4-9.4-9.4-24.6 0-33.9L271 135z" />
                </svg>
            </a>
            <h1 class="text-black text-2xl font-semibold">Detail Order</h1>
        </div>
        <div class="mt-10 p-5 w-full border border-slate-100 rounded-md">
            <h1 class="text-black text-lg font-semibold">Informasi Produk</h1>

            <div class="mt-5">
                <div class="item-cart border border-zinc-300 rounded-lg">
                    <div class="mt-3 px-5 flex justify-between">
                        <h1>
                            Status :
                            @switch($transaction->status)
                                @case('pending')
                                    <label class="mt-1 text-xs bg-yellow-400 text-white px-3 py-0.5 rounded-[4px]">
                                        Pending
                                    </label>
                                @break

                                @case('onprogress')
                                    <label class="mt-1 text-xs bg-yellow-500 text-white px-3 py-0.5 rounded-[4px]">
                                        On Progress
                                    </label>
                                @break

                                @case('sent')
                                    <label class="mt-1 text-xs bg-teal-500 text-white px-3 py-0.5 rounded-[4px]">
                                        Sent
                                    </label>
                                @break

                                @case('success')
                                    <label class="mt-1 text-xs bg-teal-500 text-white px-3 py-0.5 rounded-[4px]">
                                        Success
                                    </label>
                                @break

                                @default
                                    <label class="mt-1 text-xs bg-yellow-400 text-white px-3 py-0.5 rounded-[4px]">
                                        Pending
                                    </label>
                                @break
                            @endswitch
                        </h1>
                        <h1 class="text-lg">
                            {{ $transaction->invoice_code }}
                        </h1>
                    </div>
                    @foreach ($transaction->details as $detail)
                        <div class="mt-3 px-5 mb-5 flex items-center justify-between">
                            <div class="flex w-[80%] gap-4 items-center">
                                <img src="{{ asset($detail->product->productImages[0]->image_path) }}" alt=""
                                    class="w-30 max-h-50 rounded-lg object-cover border border-[#E5E5E5]">
                                <div class="w-1/2 self-start">
                                    <h3 class="text-lg line-clamp-2">
                                        {{ $detail->product->name }}
                                    </h3>
                                    <p class="my-1 text-sm">
                                        {{ $detail->product->size }}
                                        <br>
                                        {{ $detail->product->color }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-3">
                                <p class="mt-3 text-lg text-feprimary font-semibold">
                                    {{ $detail->quantity }} x Rp. {{ number_format($detail->price, 0, ',', '.') }}
                                    <br>
                                    <span class="text-xs">Subtotal: Rp.
                                        {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <div class="py-2 px-5 flex items-center justify-between border-t border-zinc-300">
                        @if ($transaction->status == 'pending')
                            <button onclick="window.open('{{ $transaction->payment_url }}', '_blank')"
                                class="bg-feprimary px-3 py-2 text-xs text-white rounded-md hover:bg-feprimary/50">
                                Bayar Sekarang
                            </button>
                        @endif
                        @if ($item->status == 'sent')
                            <form action="{{ route('my-orders.received', $transaction->id) }}" method="post"
                                class="inline-block">
                                @csrf
                                <input type="hidden" name="received" value="1">
                                <button
                                    class="bg-feprimary px-3 py-2 text-xs text-white rounded-md hover:bg-feprimary/50">
                                    Pesanan Diterima
                                </button>
                            </form>
                        @endif

                        <table class="text-sm text-left">
                            <tr>
                                <th class="pr-2">Total Belanja</th>
                                <td class="pr-2">:</td>
                                <td class="pr-2">Rp.
                                    {{ number_format($transaction->total_price - 5000, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="pr-2">Biaya Aplikasi</th>
                                <td class="pr-2">:</td>
                                <td class="pr-2">Rp. {{ number_format(5000, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th class="pr-2">Total Bayar</th>
                                <td class="pr-2">:</td>
                                <td class="pr-2">Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-10 p-5 w-full border border-slate-100 rounded-md">
            <h1 class="text-black text-lg font-semibold">Informasi Pengiriman</h1>

            <div class="mt-5">
                <table class="text-left text-base">
                    <tr>
                        <th class="pb-3 pr-5">Nama Penerima</th>
                        <td class="pb-3 pr-5">:</td>
                        <td class="pb-3 pr-5">
                            {{ $transaction->shipping->receiver_name }}
                        </td>
                    </tr>
                    <tr>
                        <th class="pb-3 pr-5">Telepon Penerima</th>
                        <td class="pb-3 pr-5">:</td>
                        <td class="pb-3 pr-5">
                            {{ $transaction->shipping->receiver_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th class="pb-3 pr-5">Provinsi Penerima</th>
                        <td class="pb-3 pr-5">:</td>
                        <td class="pb-3 pr-5">
                            {{ $transaction->shipping->receiver_province }}
                        </td>
                    </tr>
                    <tr>
                        <th class="pb-3 pr-5">Kota Penerima</th>
                        <td class="pb-3 pr-5">:</td>
                        <td class="pb-3 pr-5">
                            {{ $transaction->shipping->receiver_city }}
                        </td>
                    </tr>
                    <tr>
                        <th class="pb-3 pr-5">Alamat Penerima</th>
                        <td class="pb-3 pr-5">:</td>
                        <td class="pb-3 pr-5">
                            {{ $transaction->shipping->receiver_address }}
                        </td>
                    </tr>
                    <tr>
                        <th class="pb-3 pr-5">Kode POS</th>
                        <td class="pb-3 pr-5">:</td>
                        <td class="pb-3 pr-5">
                            {{ $transaction->shipping->receiver_postal_code }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @include('partials.main.footer')
</x-app-layout>
