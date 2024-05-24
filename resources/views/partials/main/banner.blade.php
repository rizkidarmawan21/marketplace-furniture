<div class="flex justify-center  mt-10">
    {{-- Carousel Banner --}}

    <div class="w-[90%] lg:container">
        <div x-data="carousel()" x-init="init()" class="overflow-hidden relative rounded-2xl">
            <div x-ref="carousel" class="flex transition-transform ease-in-out duration-1000"
                x-bind:style="'width: ' + slides.length * 100 + '%; transform: translateX(-' + curr * (100 / slides.length) + '%)'">
                <template x-for="(slide, index) in slides" :key="index">
                    <img :src="slide" alt="" class="w-full" style="width: calc(100% / slides.length);">
                </template>
            </div>
            <div class="absolute inset-0 flex items-center justify-between p-4">
                <button @click="prev" class="p-2 rounded-full shadow bg-white/80 text-gray-800 hover:bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black fill-current"
                        viewBox="0 0 320 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </button>
                <button @click="next" class="p-2 rounded-full shadow bg-white/80 text-gray-800 hover:bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black fill-current"
                        viewBox="0 0 320 512">
                        <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </button>
            </div>
            <div class="absolute bottom-4 left-5">
                <div class="flex items-center justify-center gap-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div @click="goTo(index)" class="transition-all w-2 h-2 bg-white rounded-full"
                            x-bind:class="{ 'bg-opacity-50': curr !== index }"></div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function carousel() {
        return {
            slides: [],
            curr: 0,
            init() {
                this.slides = {!! json_encode([
                    'https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/4/18/a82eb438-d9c9-4399-818a-e5d77cf7884e.jpg.webp?ect=4g',
                    'https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/3/28/b472a073-f4f7-45bc-aee0-6573d973b2b3.jpg.webp?ect=4g',
                    'https://images.tokopedia.net/img/cache/1208/NsjrJu/2024/4/23/8a7a434c-54aa-4137-b331-3b6e375dd3ac.jpg.webp?ect=4g',
                ]) !!}; // Masukkan daftar gambar Anda di sini
                if (this.slides.length > 0 && this.autoSlide) {
                    setInterval(() => this.next(), this.autoSlideInterval);
                }
            },
            prev() {
                if (this.slides.length > 0) {
                    this.curr = (this.curr === 0) ? this.slides.length - 1 : this.curr - 1;
                }
            },
            next() {
                if (this.slides.length > 0) {
                    this.curr = (this.curr === this.slides.length - 1) ? 0 : this.curr + 1;
                }
            },
            goTo(index) {
                if (this.slides.length > 0) {
                    this.curr = index;
                }
            },
            autoSlide: true, // Atur ke true jika ingin menggunakan autoplay, atau false jika tidak
            autoSlideInterval: 7000 // Atur interval autoplay di sini (dalam milidetik)
        };
    }
</script>
