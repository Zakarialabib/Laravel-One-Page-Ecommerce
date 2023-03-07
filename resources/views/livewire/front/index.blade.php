<div>
    <div class="relative mx-auto">
        <div class="w-full mx-auto">
            @foreach ($this->sections as $section)
                <div class="flex flex-wrap h-auto px-4" id="{{ $section->id }}" wire:loading.class.delay="opacity-50"
                    wire:key="col-{{ $section->id }}"
                    style="background-image: url({{ asset('images/sections/' . $section->image) }});background-size: cover;background-position: center;
                          background-color: {{ $section->bg_color }};color:{{ $section->text_color }};">
                    <div class="w-full px-4 py-10">
                        <div class="w-full text-center lg:py-5 py-10 rounded-md px-2"
                            style="background-color: {{ $section->bg_color }};color:{{ $section->text_color }};">
                            <h5 class="text-2xl lg:text-xl sm:text-lg font-bold mb-2">
                                {{ $section->subtitle }}
                            </h5>
                            <h2 class="lg:text-6xl sm:text-xl font-semibold font-heading">
                                {{ $section->title }}
                            </h2>
                            <p class="py-10 lg:text-lg sm:text-sm">
                                {!! $section->description !!}
                            </p>
                            @if ($section->is_category)
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-4 gap-4">
                                    @foreach ($this->categories as $category)
                                        <div class="flex items-start font-bold p-4 rounded-xl shadow-lg bg-gradient-to-r from-gray--100 via-violet-200 to-purple-200 hover:bg-purple-200 hover:text-gray-800">
                                            <button type="button" wire:click="selectCategory({{ $category->id }})">
                                                {{ $category->name }}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($section->is_product)
                                <div class="grid gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 px-4 my-4">
                                    @foreach ($this->products as $product)
                                        <x-product-card :product="$product" />
                                    @endforeach
                                </div>
                            @endif
                            @if ($section->is_form && $this->selectedProduct)
                                <livewire:front.order-form :product="$product" />
                            @endif
                            @if ($section->link)
                                <a class="hover:bg-red-400 text-white font-bold font-heading p-4 rounded-full uppercase transition duration-200 bg-red-500"
                                    href="{{ $section->link }}">
                                    {!! $section->label !!}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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
