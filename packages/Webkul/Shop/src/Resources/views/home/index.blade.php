@php
    $channel = core()->getCurrentChannel();
@endphp

<!-- SEO Meta Content -->
@push ('meta')
    <meta
        name="title"
        content="{{ $channel->home_seo['meta_title'] ?? '' }}"
    />

    <meta
        name="description"
        content="{{ $channel->home_seo['meta_description'] ?? '' }}"
    />

    <meta
        name="keywords"
        content="{{ $channel->home_seo['meta_keywords'] ?? '' }}"
    />
@endPush

<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{  $channel->home_seo['meta_title'] ?? '' }}
    </x-slot>

    <!-- Loop over the theme customization -->
    @foreach ($customizations as $customization)
        @php ($data = $customization->options) @endphp

        <!-- Static content -->
        @switch ($customization->type)
            @case ($customization::IMAGE_CAROUSEL)
                <!-- Image Carousel -->
                <x-shop::carousel
                    :options="$data"
                    aria-label="{{ trans('shop::app.home.index.image-carousel') }}"
                />
                @if(auth()->guard('customer')->check())
                    <div class="flex items-center justify-center min-h-screen bg-gray-100">
                        <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full text-center">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Divize:</h2>
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4"> <span class="text-blue-600"> {{ implode(" ",
                            [auth()->guard('customer')->user()->first_name, auth()->guard('customer')->user()->last_name]) }}</span></h2>
                            <div class="mb-2">
                                <span class="text-sm text-gray-500">Kredity</span>
                                <div class="text-xl font-bold text-green-600"> {{ auth()->guard('customer')->user()->credit_points }}</div>
                            </div>

                            <div class="mt-4">
                                <span class="text-sm text-gray-500">Nasbíraný scrap</span>
                                <div class="text-xl font-bold text-orange-500">17 kusů</div>
                            </div>
                        </div>
                    </div>


                @endif
                @break
            @case ($customization::STATIC_CONTENT)
                @if( $customization['name'] !== 'Offer Information')
                <!-- push style -->
                    @if (! empty($data['css']))
                        @push ('styles')
                            <style>
                                {{ $data['css'] }}
                            </style>
                        @endpush
                    @endif

                    <!-- render html -->
                    @if (! empty($data['html']))
                        {!! $data['html'] !!}
                    @endif
                @endif

                @break
            @case ($customization::CATEGORY_CAROUSEL)
                <!-- Categories carousel -->
                <x-shop::categories.carousel
                    :title="$data['title'] ?? ''"
                    :src="route('shop.api.categories.index', $data['filters'] ?? [])"
                    :navigation-link="route('shop.home.index')"
                    aria-label="{{ trans('shop::app.home.index.categories-carousel') }}"
                />

                @break
            @case ($customization::PRODUCT_CAROUSEL)
                <!-- Product Carousel -->
                <x-shop::products.carousel
                    :title="$data['title'] ?? ''"
                    :src="route('shop.api.products.index', $data['filters'] ?? [])"
                    :navigation-link="route('shop.search.index', $data['filters'] ?? [])"
                    aria-label="{{ trans('shop::app.home.index.product-carousel') }}"
                />

                @break
        @endswitch
    @endforeach
</x-shop::layouts>
