@extends('admin.layouts.app')

@section('title', 'Tồn kho - Robot Store')

@section('header', 'Quản lý tồn kho')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Quản lý tồn kho
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Phiên bản sản phẩm ID: #{{ $detailID }}
            </p>
        </div>

        <a
            href="javascript:history.back()"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            ← Quay lại
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <form action="{{ route('admin.detail-products.in-stock.update', $detailID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Số lượng trong kho
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $inStock->stock ?? 0) }}"
                        min="0"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900"
                    >
                    @error('stock')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button
                        type="submit"
                        class="rounded-lg bg-gray-900 px-6 py-2.5 text-sm font-medium text-white hover:bg-gray-800 transition">
                        Cập nhật tồn kho
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection
