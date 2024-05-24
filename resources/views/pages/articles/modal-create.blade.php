<div x-show="modalCreate" x-cloak>
    <div class="absolute inset-0 z-9999 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 flex items-center justify-center min-h-screen pb-20 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-black bg-opacity-75 transition-opacity"></div>
            </div>
            <div
                class="inline-block align-bottom bg-red-200 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-[32rem] md:w-[50%] lg:w-[35%]">
                <div class="bg-white dark:bg-boxdark p-5 ">
                    <div class="">
                        <div class="flex justify-between items-center">
                            <h3 class="text-2xl font-medium leading-6 text-gray-900 dark:text-white" id="modal-title">
                                Create Artcile
                            </h3>
                            <button class="hover:bg-slate-100 p-2 rounded-lg"
                                @click="modalCreate = false, isEdit = false , selectedValue = {} ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-10 overflow-y-auto max-h-[calc(100vh-10rem)]">
                            <form
                                :action="isEdit ? '{{ url('') }}' + '/admin/articles/' + selectedValue?.id :
                                    '{{ route('admin.articles.store') }}'"
                                method="POST" class="space-y-3" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">
                                <div class="space-y-2">
                                    <x-input-label for="image_path" value="Upload Image" class="!text-lg" />
                                    <img :src="selectedValue.image" width="200">
                                    <x-text-input id="image_path" name="image_path" type="file"
                                        placeholder="Insert File" x-bind:value="isEdit ? selectedValue.image_path : ''"
                                        class="!py-2 !px-3" />
                                    <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                                </div>
                                <div class="space-y-2">
                                    <x-input-label for="title" value="Title" class="!text-lg" />
                                    <x-text-input id="title" name="title" type="text"
                                        placeholder="Insert Title"
                                        x-bind:value="isEdit ? selectedValue.title : '{{ old('title') }}'"
                                        class="!py-2 !px-3" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="space-y-2 col-span-2">
                                    <x-input-label for="content" value="Content" class="!text-lg" />
                                    <div x-init="$watch('selectedValue.content', value => {
                                        const trixEditor = $refs.trixEditor;
                                        if (trixEditor.editor) {
                                            trixEditor.editor.loadHTML(value);
                                        } else {
                                            trixEditor.addEventListener('trix-initialize', () => {
                                                trixEditor.editor.loadHTML(value);
                                            });
                                        }
                                    });
                                    // Initialize the editor content
                                    $nextTick(() => {
                                        const trixEditor = $refs.trixEditor;
                                        if (trixEditor.editor) {
                                            trixEditor.editor.loadHTML(selectedValue.content);
                                        }
                                    });">
                                        <input id="content" type="hidden" name="content"
                                            x-bind:value="selectedValue.content" x-ref="contentInput">
                                        <trix-editor input="content" x-ref="trixEditor"></trix-editor>
                                    </div>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
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
