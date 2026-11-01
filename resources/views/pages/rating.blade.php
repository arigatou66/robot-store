<div class="mt-8 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
    <div class="flex flex-col gap-5 border-b border-gray-200 pb-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Đánh giá sản phẩm
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                {{ $reviewCount }} đánh giá
            </p>
        </div>

        @if ($reviewCount > 0)
            <div class="sm:text-right">
                <div class="flex items-center gap-3 sm:justify-end">
                    <span class="text-3xl font-bold text-gray-900">
                        {{ number_format($averageRating, 1) }}
                    </span>

                    <span class="text-sm text-gray-500">
                        / 5
                    </span>
                </div>

                <div class="mt-1 text-yellow-400">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star {{ $i <= round($averageRating) ? '' : 'text-gray-300' }}"></i>
                    @endfor
                </div>
            </div>
        @endif
    </div>

    @if ($reviews->count())
        <div class="mt-6 space-y-6">
            @foreach ($reviews as $review)
                <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ $review->detailOrder?->order?->customer_name ?? 'Khách hàng' }}
                            </p>

                            <div class="mt-1 flex items-center gap-1 text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star text-sm {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                                @endfor

                                <span class="ml-2 text-sm font-medium text-gray-600">
                                    {{ $review->rating }}/5
                                </span>
                            </div>
                        </div>

                        <span class="text-sm text-gray-400">
                            {{ $review->created_at?->format('d/m/Y') }}
                        </span>
                    </div>

                    @if ($review->content)
                        <p class="mt-4 leading-7 text-gray-600">
                            {{ $review->content }}
                        </p>
                    @else
                        <p class="mt-4 text-sm italic text-gray-400">
                            Khách hàng không để lại nhận xét.
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="mt-6 rounded-xl bg-gray-50 px-5 py-10 text-center">
            <i class="fa-regular fa-comment-dots text-4xl text-gray-300"></i>

            <p class="mt-4 font-medium text-gray-600">
                Sản phẩm chưa có đánh giá nào.
            </p>

            <p class="mt-1 text-sm text-gray-400">
                Hãy là người đầu tiên đánh giá sản phẩm này.
            </p>
        </div>
    @endif
</div>
