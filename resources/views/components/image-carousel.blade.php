<div x-data="{ slide: 0, totalSlides: {{ count($images) }} - 1 }" class="relative">
    <template x-for="(image, index) in {{ json_encode($images) }}" :key="index">
        <div x-show="slide === index" class="transition-opacity duration-500"
            :class="{ 'opacity-100': slide === index, 'opacity-0': slide !== index }">

            <section class="w-full h-full relative">
                <picture class="rounded w-full aspect-square">
                    <source :srcset="image.url" type="image/webp">
                    <img :src="image.url" :alt="image.alt" class="w-full">
                </picture>
                {{-- Text --}}
                <section class="bg-gothic-50/70 px-4 py-2 absolute bottom-0 text-base md:text-lg backdrop-blur-sm">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima deserunt expedita error veniam
                    architecto
                    ratione consequatur harum possimus atque sed qui quidem reprehenderit, vero natus tempora
                    perferendis. Animi,
                    dolore recusandae!
                </section>
            </section>

        </div>
    </template>

    <button @click="slide = (slide === 0) ? totalSlides : slide - 1"
        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
        </svg>
    </button>

    <button @click="slide = (slide === totalSlides) ? 0 : slide + 1"
        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
        </svg>

    </button>


</div>
