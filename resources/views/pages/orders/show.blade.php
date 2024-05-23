<x-dashboard-layout>
    <div x-data="{
        modalCreate: false,
        confirmDesc: 'Are you sure you want to delete this data?',
        confirmMethod: 'DELETE',
        confirmUrl: '',
        isEdit: false,
        selectedValue: ''
    }">
        <div class="mb-3 flex items-center gap-3">
            <a href="{{ route('admin.orders.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 fill-current">
                    <path
                        d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM271 135c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-87 87 87 87c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L167 273c-9.4-9.4-9.4-24.6 0-33.9L271 135z" />
                </svg>
            </a>
            <h2 class="text-3xl font-medium">
                Detail Order
            </h2>
        </div>
        <div
            class="rounded-sm border border-stroke bg-white px-5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5">
            <div class="max-w-full overflow-x-auto">

                <div class="my-5 flex gap-5 items-center justify-between">
                    @switch($order->status)
                        @case('pending')
                            <label class="mt-1 text-3xl text-yellow-400">
                                Pending
                            </label>
                        @break

                        @case('onprogress')
                            <label class="mt-1 text-3xl text-yellow-500">
                                On Progress
                            </label>
                        @break

                        @case('sent')
                            <label class="mt-1 text-3xl text-teal-500">
                                Dikirim
                            </label>
                        @break

                        @case('success')
                            <label class="mt-1 text-3xl text-teal-500">
                                Success
                            </label>
                        @break

                        @default
                            <label class="mt-1 text-3xl text-yellow-400">
                                Pending
                            </label>
                        @break
                    @endswitch
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                        class="w-1/4 flex gap-5 items-end justify-end">
                        @csrf
                        @method('PUT')
                        <div class="w-full">
                            <x-input-label for="ctatus" value="Update Status" class="!text-lg" />
                            <select name="status" id="status" required
                                class="w-full rounded-lg border border-stroke bg-transparent pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary !py-1 !px-3">
                                <option value="">Select Category</option>
                                <option value="onprogress">Dikemas</option>
                                <option value="sent">Dikirim</option>
                                <option value="success">Selesai</option>
                            </select>
                        </div>

                        <div>
                            <button class="text-xs px-4 py-2 text-white bg-primary rounded-full">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
                <div class=" p-5 w-full border border-slate-100 rounded-md">
                    <h1 class="text-black text-lg font-semibold">Informasi Produk</h1>

                    <div class="mt-5">
                        <div class="item-cart border border-zinc-300 rounded-lg">
                            <div class="mt-3 px-5 flex justify-end">
                                <h1 class="text-lg">
                                    {{ $order->invoice_code }}
                                </h1>
                            </div>
                            @foreach ($order->details as $detail)
                                <div class="mt-3 px-5 mb-5 flex items-center justify-between">
                                    <div class="flex w-[80%] gap-4 items-center">
                                        <img src="{{ asset($detail->product->productImages[0]->image_path) }}"
                                            alt=""
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
                                            {{ $detail->quantity }} x Rp.
                                            {{ number_format($detail->price, 0, ',', '.') }}
                                            <br>
                                            <span class="text-xs">Subtotal: Rp.
                                                {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="py-2 px-5 flex items-center justify-between border-t border-zinc-300">

                                <table class="text-sm text-left">
                                    <tr>
                                        <th class="pr-2">Total Belanja</th>
                                        <td class="pr-2">:</td>
                                        <td class="pr-2">Rp.
                                            {{ number_format($order->total_price - 5000, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-2">Biaya Aplikasi</th>
                                        <td class="pr-2">:</td>
                                        <td class="pr-2">Rp. {{ number_format(5000, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="pr-2">Total Bayar</th>
                                        <td class="pr-2">:</td>
                                        <td class="pr-2">Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
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
                                    {{ $order->shipping->receiver_name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="pb-3 pr-5">Telepon Penerima</th>
                                <td class="pb-3 pr-5">:</td>
                                <td class="pb-3 pr-5">
                                    {{ $order->shipping->receiver_phone }}
                                </td>
                            </tr>
                            <tr>
                                <th class="pb-3 pr-5">Provinsi Penerima</th>
                                <td class="pb-3 pr-5">:</td>
                                <td class="pb-3 pr-5">
                                    {{ $order->shipping->receiver_province }}
                                </td>
                            </tr>
                            <tr>
                                <th class="pb-3 pr-5">Kota Penerima</th>
                                <td class="pb-3 pr-5">:</td>
                                <td class="pb-3 pr-5">
                                    {{ $order->shipping->receiver_city }}
                                </td>
                            </tr>
                            <tr>
                                <th class="pb-3 pr-5">Alamat Penerima</th>
                                <td class="pb-3 pr-5">:</td>
                                <td class="pb-3 pr-5">
                                    {{ $order->shipping->receiver_address }}
                                </td>
                            </tr>
                            <tr>
                                <th class="pb-3 pr-5">Kode POS</th>
                                <td class="pb-3 pr-5">:</td>
                                <td class="pb-3 pr-5">
                                    {{ $order->shipping->receiver_postal_code }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.confirm')
    </div>
</x-dashboard-layout>
