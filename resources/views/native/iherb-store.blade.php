<native:scroll-view class="w-full h-full bg-gray-50">
    <native:column class="w-full gap-0 safe-area">

        {{-- Top Bar --}}
        <native:column class="w-full bg-[#507D2A] px-4 pt-3 pb-3">
            <native:row class="w-full items-center justify-between">
                <native:text class="text-[22] font-bold text-white">iHerb</native:text>
                <native:column @press="viewCart" class="w-[36] h-[36] rounded-full bg-white/20 items-center justify-center">
                    <native:icon name="shopping_cart" :size="20" color="#FFFFFF" />
                </native:column>
            </native:row>
        </native:column>

        {{-- Search Bar --}}
        <native:column class="w-full bg-[#F5B81C] px-4 py-3">
            <native:row class="w-full bg-white rounded-lg px-3 py-2 items-center gap-2">
                <native:icon name="search" :size="20" color="#999999" />
                <native:text class="text-[14] text-[#999999]">Search all of iHerb</native:text>
            </native:row>
        </native:column>

        {{-- Promo Banner --}}
        <native:column class="w-full bg-[#C62828] px-5 py-5">
            <native:text class="text-[22] font-bold text-white">Probiotics</native:text>
            <native:text class="text-[22] font-bold text-white">for Every Body</native:text>
            <native:spacer class="h-[4]" />
            <native:text class="text-[14] text-white/80">Trusted formulas, guaranteed quality</native:text>
            <native:spacer class="h-[8]" />
            <native:button label="Shop Now" color="#FFFFFF" labelColor="#C62828" :fontSize="13" />
        </native:column>

        {{-- Shop by Category --}}
        <native:column class="w-full bg-white px-4 pt-4 pb-2">
            <native:text class="text-[18] font-bold text-[#333333]">Shop by category</native:text>
        </native:column>
        <native:scroll-view horizontal class="bg-white">
            <native:row class="gap-4 px-4 pb-4">
                @foreach ($categories as $catIndex => $cat)
                    <native:column @press="viewCategory({{ $catIndex }})" class="items-center gap-2 w-[72]">
                        <native:column class="w-[56] h-[56] rounded-full bg-[#E8F5E9] items-center justify-center">
                            <native:icon name="{{ $cat['icon'] }}" :size="26" color="#507D2A" />
                        </native:column>
                        <native:text class="text-[11] text-[#333333] text-center">{{ $cat['name'] }}</native:text>
                    </native:column>
                @endforeach
            </native:row>
        </native:scroll-view>

        {{-- Health Topics --}}
        <native:scroll-view horizontal class="bg-white">
            <native:row class="gap-2 px-4 pb-3">
                @foreach ($healthTopics as $topic)
                    <native:chip label="{{ $topic }}" />
                @endforeach
            </native:row>
        </native:scroll-view>

        <native:divider class="w-full" />

        {{-- Trending Now --}}
        <native:column class="w-full bg-white px-4 pt-4 pb-2">
            <native:text class="text-[18] font-bold text-[#333333]">Trending now</native:text>
        </native:column>
        <native:scroll-view horizontal class="bg-white">
            <native:row class="gap-3 px-4 pb-4">
                @foreach ($trending as $product)
                    <native:column @press="viewProduct({{ $product['originalIndex'] }})" class="w-[160] gap-2">
                        <native:column class="w-[160] h-[160] bg-gray-100 rounded-lg items-center justify-center">
                            @if ($product['badge'])
                                <native:badge
                                    :count="0"
                                    color="{{ $product['badge'] === 'Best seller' ? '#CC0000' : '#507D2A' }}"
                                />
                            @endif
                            <native:image
                                src="{{ $product['imageUrl'] }}"
                                class="w-[140] h-[140] rounded-lg"
                                :fit="2"
                            />
                        </native:column>
                        <native:text class="text-[12] text-[#333333]" :maxLines="2">{{ $product['brand'] }}, {{ $product['name'] }}</native:text>
                        <native:row class="items-center gap-1">
                            <native:icon name="star" :size="12" color="#DAA520" />
                            <native:text class="text-[11] text-[#DAA520]">{{ $product['rating'] }}</native:text>
                            <native:text class="text-[11] text-[#999999]">{{ $product['reviewFormatted'] }}</native:text>
                        </native:row>
                        <native:row class="items-center gap-2">
                            <native:text class="text-[14] font-bold text-[#333333]">{{ $product['priceFormatted'] }}</native:text>
                            @if ($product['originalPriceFormatted'])
                                <native:text class="text-[12] text-[#999999] line-through">{{ $product['originalPriceFormatted'] }}</native:text>
                            @endif
                        </native:row>
                    </native:column>
                @endforeach
            </native:row>
        </native:scroll-view>

        <native:divider class="w-full" />

        {{-- Best Sellers --}}
        <native:column class="w-full bg-white px-4 pt-4 pb-2">
            <native:text class="text-[18] font-bold text-[#333333]">Best sellers</native:text>
        </native:column>
        <native:scroll-view horizontal class="bg-white">
            <native:row class="gap-2 px-4 pb-3">
                @foreach (['Supplements', 'Sports', 'Bath & Care', 'Beauty', 'Grocery'] as $cat)
                    <native:chip
                        label="{{ $cat }}"
                        :selected="$selectedBestSellerCategory === $cat"
                        color="#507D2A"
                        @change="selectBestSellerCategory({{ $cat }})"
                    />
                @endforeach
            </native:row>
        </native:scroll-view>

        {{-- Best Seller Product List --}}
        <native:column class="w-full bg-white px-4 pb-4 gap-3">
            @foreach ($bestSellers as $product)
                <native:column @press="viewProduct({{ $product['originalIndex'] }})" class="w-full">
                    <native:row class="w-full gap-3">
                        <native:column class="w-[100] h-[100] bg-gray-100 rounded-lg items-center justify-center">
                            <native:image
                                src="{{ $product['imageUrl'] }}"
                                class="w-[90] h-[90] rounded-lg"
                                :fit="2"
                            />
                        </native:column>
                        <native:column class="w-[240] gap-1">
                            @if ($product['badge'])
                                <native:text class="text-[10] font-bold text-{{ $product['badge'] === 'Best seller' ? '[#CC0000]' : '[#507D2A]' }}">{{ $product['badge'] }}</native:text>
                            @endif
                            <native:text class="text-[13] text-[#333333]" :maxLines="2">{{ $product['brand'] }}, {{ $product['name'] }}</native:text>
                            <native:row class="items-center gap-1">
                                <native:icon name="star" :size="12" color="#DAA520" />
                                <native:text class="text-[11] text-[#333333]">{{ $product['rating'] }}</native:text>
                                <native:text class="text-[11] text-[#999999]">{{ $product['reviewFormatted'] }}</native:text>
                            </native:row>
                            <native:text class="text-[11] text-[#999999]">{{ $product['soldIn30Days'] }} sold in 30 days</native:text>
                            <native:row class="items-center gap-2">
                                <native:text class="text-[15] font-bold text-[#333333]">{{ $product['priceFormatted'] }}</native:text>
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

        {{-- Free Shipping Banner --}}
        <native:column class="w-full bg-[#E8F5E9] px-4 py-4 items-center">
            <native:row class="items-center gap-2">
                <native:icon name="local_shipping" :size="20" color="#507D2A" />
                <native:text class="text-[14] font-semibold text-[#507D2A]">Free Shipping over $30</native:text>
            </native:row>
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
