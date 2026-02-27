<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full gap-0 safe-area">

        {{-- Top Bar --}}
        <native:column class="w-full bg-[#507D2A]">
            <native:row class="w-full px-4 py-3 items-center gap-3">
                <native:column @press="back" class="w-[32] h-[32] rounded-full bg-white/20 items-center justify-center">
                    <native:icon name="arrow_back" :size="20" color="#FFFFFF" />
                </native:column>
                <native:text class="text-[18] font-bold text-white">{{ $category['name'] }}</native:text>
            </native:row>
        </native:column>

        {{-- Search Bar --}}
        <native:column class="w-full bg-[#F5B81C] px-4 py-3">
            <native:row class="w-full bg-white rounded-lg px-3 py-2 items-center gap-2">
                <native:icon name="search" :size="20" color="#999999" />
                <native:text class="text-[14] text-[#999999]">Search in {{ $category['name'] }}</native:text>
            </native:row>
        </native:column>

        {{-- Result Count --}}
        <native:column class="w-full px-4 py-2 bg-gray-50">
            <native:text class="text-[13] text-[#666666]">{{ number_format($category['productCount']) }} results</native:text>
        </native:column>

        {{-- Subcategory Chips --}}
        <native:scroll-view horizontal class="bg-white">
            <native:row class="gap-2 px-4 py-3">
                @foreach ($subcategories as $sub)
                    <native:chip label="{{ $sub['name'] }}" />
                @endforeach
            </native:row>
        </native:scroll-view>

        <native:divider class="w-full" />

        {{-- Product List --}}
        <native:column class="w-full px-4 pt-3 pb-4 gap-4">
            @foreach ($productsWithMeta as $product)
                <native:column @press="viewProduct({{ $product['originalIndex'] }})" class="w-full">
                    <native:row class="w-full gap-3">
                        {{-- Product Image --}}
                        <native:column class="w-[110] h-[110] bg-gray-100 rounded-lg items-center justify-center">
                            <native:image
                                src="{{ $product['imageUrl'] }}"
                                class="w-[100] h-[100] rounded-lg"
                                :fit="2"
                            />
                        </native:column>

                        {{-- Product Info --}}
                        <native:column class="w-[230] gap-1">
                            @if ($product['badge'])
                                <native:row class="items-center">
                                    <native:text class="text-[10] font-bold text-white bg-{{ $product['badge'] === 'Best seller' ? '[#CC0000]' : '[#507D2A]' }} px-2 py-0.5 rounded">{{ $product['badge'] }}</native:text>
                                </native:row>
                            @endif

                            <native:text class="text-[13] text-[#333333]" :maxLines="2">{{ $product['brand'] }}, {{ $product['name'] }}</native:text>

                            <native:row class="items-center gap-1">
                                <native:icon name="star" :size="12" color="#DAA520" />
                                <native:icon name="star" :size="12" color="#DAA520" />
                                <native:icon name="star" :size="12" color="#DAA520" />
                                <native:icon name="star" :size="12" color="#DAA520" />
                                <native:icon name="star_half" :size="12" color="#DAA520" />
                                <native:text class="text-[11] text-[#999999]">{{ $product['reviewFormatted'] }}</native:text>
                            </native:row>

                            <native:text class="text-[11] text-[#666666]">{{ $product['soldIn30Days'] }} sold in 30 days</native:text>

                            <native:row class="items-center gap-2">
                                <native:text class="text-[16] font-bold text-[#333333]">{{ $product['priceFormatted'] }}</native:text>
                                @if ($product['originalPriceFormatted'])
                                    <native:text class="text-[12] text-[#999999] line-through">{{ $product['originalPriceFormatted'] }}</native:text>
                                @endif
                            </native:row>
                        </native:column>
                    </native:row>
                    <native:divider class="w-full mt-3" />
                </native:column>
            @endforeach
        </native:column>

        @if (count($productsWithMeta) === 0)
            <native:column class="w-full items-center py-8">
                <native:icon name="inventory_2" :size="48" color="#CCCCCC" />
                <native:spacer class="h-[8]" />
                <native:text class="text-[15] text-[#999999]">No products found</native:text>
            </native:column>
        @endif

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
