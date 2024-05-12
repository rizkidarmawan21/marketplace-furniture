<div x-show="modalCreate" x-cloak>
    <div class="absolute inset-0 z-9999 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 flex items-center justify-center min-h-screen pb-20 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-black bg-opacity-75 transition-opacity"></div>
            </div>
            <div
                class="inline-block align-bottom bg-red-200 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-[32rem] md:w-[50%]">
                <div class="bg-white dark:bg-boxdark p-5 ">
                    <div class="">
                        <div class="flex justify-between items-center">
                            <h3 class="text-2xl font-medium leading-6 text-gray-900 dark:text-white" id="modal-title">
                                Create Product
                            </h3>
                            <button class="hover:bg-slate-100 p-2 rounded-lg" @click="modalCreate = false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-10 overflow-y-auto max-h-[calc(100vh-10rem)]">
                            <form
                                :action="isEdit ? '{{ url('') }}' + '/admin/products/' + selectedValue?.id :
                                    '{{ route('admin.products.store') }}'"
                                method="POST" class="space-y-3" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">
                                <div class="space-y-2 w-1/3">
                                    <x-input-label for="product_images" value="Upload Product Photo" class="!text-lg" />
                                    <x-text-input id="product_images" name="product_images" type="file"
                                        placeholder="Insert File"
                                        x-bind:value="isEdit ? selectedValue.product_images : ''" class="!py-2 !px-3" />
                                    <x-input-error :messages="$errors->get('product_images')" class="mt-2" />
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="space-y-2">
                                        <x-input-label for="category" value="Category" class="!text-lg" />

                                        <select name="category_id" id="category"
                                            class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary !py-2 !px-3">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    x-bind:selected="isEdit ? selectedValue?.category_id == {{ $category->id }} : '{{ old('category_id') }}'">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                    </div>
                                    <div class="space-y-2">
                                        <x-input-label for="name" value="Name" class="!text-lg" />
                                        <x-text-input id="name" name="name" type="text"
                                            placeholder="Insert Name"
                                            x-bind:value="isEdit ? selectedValue.name : '{{ old('name') }}'"
                                            class="!py-2 !px-3" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="space-y-2">
                                        <x-input-label for="price" value="Price" class="!text-lg" />
                                        <x-text-input id="price" name="price" type="number"
                                            placeholder="Insert Price" x-bind:value="isEdit ? selectedValue.price : '{{ old('price') }}'"
                                            class="!py-2 !px-3" />
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>
                                    <div class="space-y-2">
                                        <x-input-label for="stock" value="Stock" class="!text-lg" />
                                        <x-text-input id="stock" name="stock" type="number"
                                            placeholder="Insert Stock" x-bind:value="isEdit ? selectedValue.stock : '{{ old('stock') }}'"
                                            class="!py-2 !px-3" />
                                        <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                                    </div>
                                    <div class="space-y-2">
                                        <x-input-label for="size" value="Size" class="!text-lg" />
                                        <x-text-input id="size" name="size" type="text"
                                            placeholder="Ex: 20cm x 20cm x 20cm"
                                            x-bind:value="isEdit ? selectedValue.size : '{{ old('size') }}'" class="!py-2 !px-3" />
                                        <x-input-error :messages="$errors->get('size')" class="mt-2" />
                                    </div>
                                    <div class="space-y-2">
                                        <x-input-label for="color" value="Color" class="!text-lg" />
                                        <x-text-input id="color" name="color" type="text"
                                            placeholder="Insert color" x-bind:value="isEdit ? selectedValue.color : '{{ old('color') }}'"
                                            class="!py-2 !px-3" />
                                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                                    </div>
                                    <div class="space-y-2 col-span-2">
                                        <x-input-label for="description" value="Description" class="!text-lg" />
                                        <textarea name="description" id="" cols="30" rows="2"
                                            class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary !py-2 !px-3" x-bind:value="isEdit ? selectedValue.description : '{{ old('description') }}'">
                                        </textarea>
                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="pt-10">
                                    <x-primary-button class="!rounded-full !py-3">
                                        <p x-text="isEdit ? 'Update' : 'Create'"></p>
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
