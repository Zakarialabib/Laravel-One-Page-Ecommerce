@props(['product'])
<div>
    <div class="mb-5 bg-white rounded-xl shadow-lg">
        <div class="relative text-center">
            <img src="{{ asset('images/products/' . $product->image) }}" onerror="this.onerror=null; this.remove();"
                alt="{{ $product->name }}" loading="lazy">

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
                            loading="lazy" class="w-full h-[300px] object-cover rounded-t-lg py-5">
                    </div>

                    @if ($product->gallery)
                        @foreach (json_decode($product->gallery) as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('images/products/' . $image) }}"
                                    class="w-full h-[300px] object-cover rounded-t-lg py-5" alt="{{ $product->name }}"
                                    loading="lazy">
                            </div>
                        @endforeach
                    @endif

                    @if ($product->embeded_video)
                        <div class="swiper-slide">
                            {!! $product->embeded_video !!}
                        </div>
                    @endif
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            @if ($product->old_price && $product->discount != 0)
                <div class="absolute top-0 right-0 mb-3 p-2 bg-red-500 rounded-bl-lg">
                    @auth
                        <span class="text-white font-bold text-sm">
                            - {{ $product->discount }}
                        </span>
                    @endauth
                    %
                </div>
            @endif
        </div>
        <div class="px-2 pb-4 pt-10 text-center">
            <div class="block mb-2 text-md font-bold font-heading hover:text-green-400">
                {{ $product->name }}
            </div>
            <span class="hover:text-orange-900 font-bold text-md mt-2">{{ $product->price }}
                DH</span>
            @if ($product->old_price && $product->discount != 0)
                <p class="text-black font-bold text-sm block my-2">
                    <del>{{ $product->old_price }} DH </del>
                </p>
            @endif
            @if ($product->category_id)
                <div class="flex justify-center">
                    <button wire:click="selectProduct({{ $product->id }})" type="button"
                        class="bg-green-500 py-2 px-4 my-2 mx-auto rounded-md">
                        {{ __('Choose this') }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>


@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush
