@extends('layouts.app')

@section('title', 'Tìm kiếm: ' . $q . ' - Robot Store')

@section('content')
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-magnifying-glass text-2xl text-gray-700"></i>
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                        Kết quả tìm kiếm cho "{{ $q }}"
                    </h1>
                </div>
                <p class="mt-2 text-sm text-gray-600">
                    Tìm thấy <span class="font-semibold text-gray-900">{{ $products->total() }}</span> sản phẩm phù hợp
                </p>
            </div>

            @if ($products->isNotEmpty())
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $product)
                        @php
                            $detail = $product->detailProducts->first();
                            $price = $detail?->price ?? 0;
                            $salePrice = $detail?->sale_price ?? 0;
                            $displayPrice = $salePrice > 0 ? $salePrice : $price;
                            $hasSale = $salePrice > 0 && $salePrice < $price;
                        @endphp

                        <article class="group flex flex-col justify-between overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-lg">
                            <a href="{{ route('product.detail', $product->slug) }}" class="flex h-full flex-col justify-between">
                                <div>
                                    <div class="relative aspect-square overflow-hidden bg-gray-100">
                                        @if ($product->thumbnail)
                                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}"
                                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                        @else
                                            <div class="flex h-full items-center justify-center">
                                                <i class="fa-solid fa-robot text-4xl text-gray-300"></i>
                                            </div>
                                        @endif

                                        @if ($hasSale)
                                            <span class="absolute left-3 top-3 rounded-full bg-red-500 px-3 py-1 text-xs font-bold text-white">SALE</span>
                                        @endif
                                    </div>

                                    <div class="p-5">
                                        @if ($product->category)
                                            <p class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500">
                                                {{ $product->category->name }}
                                            </p>
                                        @endif

                                        <h2 class="min-h-[3rem] text-lg font-semibold text-gray-900 transition group-hover:text-blue-600">
                                            {{ $product->name }}
                                        </h2>

                                        <div class="mt-4">
                                            @if ($displayPrice > 0)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xl font-bold text-gray-900">
                                                        {{ number_format($displayPrice, 0, ',', '.') }}đ
                                                    </span>

                                                    @if ($hasSale)
                                                        <span class="text-sm text-gray-400 line-through">
                                                            {{ number_format($price, 0, ',', '.') }}đ
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-xl font-bold text-gray-400">Liên hệ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 p-5 pt-4 text-right">
                                    <span class="text-xs font-semibold text-blue-600 transition group-hover:underline">
                                        Xem chi tiết →
                                    </span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                @if ($products->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm">
                    <i class="fa-solid fa-box-open text-4xl text-gray-300"></i>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Không tìm thấy sản phẩm nào</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Không có sản phẩm nào phù hợp với từ khóa "{{ $q }}". Vui lòng thử từ khóa khác.
                    </p>
                    <a href="{{ route('products') }}" class="mt-6 inline-flex rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                        Xem tất cả sản phẩm
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
