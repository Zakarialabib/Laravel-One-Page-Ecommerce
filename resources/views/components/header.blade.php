<div>
    <nav class="flex items-center justify-center bg-gray-50 border-b px-4 lg:px-12 py-5 shadow-md">
        <div class="2xl:mr-20">
            <a class="lg:text-3xl sm:text-xl font-bold font-heading text-black" href="{{ route('front.index') }}">
                <img class="w-auto h-10" src="{{ asset('images/' . Helpers::settings('site_logo')) }}" loading="lazy"
                    alt="{{ Helpers::settings('site_title') }}" />
            </a>
        </div>
    </nav>
</div>