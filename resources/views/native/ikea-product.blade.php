<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full gap-0 safe-area">

        {{-- Top Bar --}}
        <native:column class="w-full bg-[#003399]">
            <native:row class="w-full px-4 py-3 items-center justify-between">
                <native:column @press="back" class="w-[32] h-[32] rounded-full bg-white/20 items-center justify-center">
                    <native:icon name="arrow_back" :size="20" color="#FFFFFF" />
                </native:column>
                <native:row class="items-center gap-3">
                    <native:column @press="toggleFavorite">
                        <native:icon
                            name="{{ $isFavorited ? 'favorite' : 'favorite_border' }}"
                            :size="22"
                            color="{{ $isFavorited ? '#CC0000' : '#FFFFFF' }}"
                        />
                    </native:column>
                    <native:icon name="share" :size="22" color="#FFFFFF" />
                </native:row>
            </native:row>
        </native:column>

        {{-- Product Image --}}
        <native:column class="w-full items-center bg-[#F5F5F5] py-6">
            <native:image
                src="{{ $product['imageUrl'] }}"
                class="w-[280] h-[280]"
                :fit="1"
            />
        </native:column>

        {{-- Badge --}}
        @if ($product['badge'])
            <native:column class="w-full bg-[#CC0000] px-4 py-2">
                <native:text class="text-[12] font-bold text-white">{{ $product['badge'] }}</native:text>
            </native:column>
        @endif

        {{-- Product Info --}}
        <native:column class="w-full px-4 pt-4 gap-1">
            {{-- Series Name --}}
            <native:text class="text-[22] font-bold text-[#111111]">{{ $product['seriesName'] }}</native:text>

            {{-- Product Name --}}
            <native:text class="text-[14] text-[#484848]">{{ $product['name'] }}, {{ $product['color'] }}</native:text>

            {{-- Price --}}
            <native:row class="items-center gap-3 pt-2">
                <native:text class="text-[28] font-bold text-[#111111]">{{ $priceFormatted }}</native:text>
                @if ($originalPriceFormatted)
                    <native:text class="text-[16] text-[#999999] line-through">{{ $originalPriceFormatted }}</native:text>
                @endif
            </native:row>

            {{-- Rating --}}
            <native:row class="items-center gap-2 pt-1">
                <native:row class="items-center gap-0">
                    <native:icon name="star" :size="16" color="#111111" />
                    <native:icon name="star" :size="16" color="#111111" />
                    <native:icon name="star" :size="16" color="#111111" />
                    <native:icon name="star" :size="16" color="#111111" />
                    <native:icon name="star_half" :size="16" color="#111111" />
                </native:row>
                <native:text class="text-[13] text-[#484848]">{{ $product['rating'] }} ({{ $reviewFormatted }})</native:text>
            </native:row>
        </native:column>

        <native:divider class="w-full mx-4 my-3" />

        {{-- Availability --}}
        <native:column class="w-full px-4 gap-2">
            <native:row class="items-center gap-2">
                @if ($product['inStock'])
                    <native:icon name="check_circle" :size="18" color="#0A8A00" />
                    <native:text class="text-[14] text-[#0A8A00] font-semibold">In stock</native:text>
                @else
                    <native:icon name="cancel" :size="18" color="#CC0000" />
                    <native:text class="text-[14] text-[#CC0000] font-semibold">Out of stock</native:text>
                @endif
            </native:row>
            <native:row class="items-center gap-2">
                <native:icon name="local_shipping" :size="16" color="#484848" />
                <native:text class="text-[13] text-[#484848]">Delivery available</native:text>
            </native:row>
            <native:row class="items-center gap-2">
                <native:icon name="store" :size="16" color="#484848" />
                <native:text class="text-[13] text-[#484848]">Check store availability</native:text>
            </native:row>
        </native:column>

        <native:divider class="w-full mx-4 my-3" />

        {{-- Product Details --}}
        <native:column class="w-full px-4 gap-2">
            <native:text class="text-[16] font-bold text-[#111111]">Product details</native:text>
            <native:text class="text-[14] text-[#484848]">{{ $product['description'] }}</native:text>

            <native:spacer class="h-[4]" />

            <native:row class="items-center gap-2">
                <native:icon name="straighten" :size="16" color="#484848" />
                <native:text class="text-[13] text-[#484848]">{{ $product['dimensions'] }}</native:text>
            </native:row>
            <native:row class="items-center gap-2">
                <native:icon name="texture" :size="16" color="#484848" />
                <native:text class="text-[13] text-[#484848]">{{ $product['material'] }}</native:text>
            </native:row>
            <native:row class="items-center gap-2">
                <native:icon name="palette" :size="16" color="#484848" />
                <native:text class="text-[13] text-[#484848]">{{ $product['color'] }}</native:text>
            </native:row>
            <native:row class="items-center gap-2">
                <native:icon name="tag" :size="16" color="#484848" />
                <native:text class="text-[13] text-[#484848]">Article no. {{ $product['articleNumber'] }}</native:text>
            </native:row>
        </native:column>

        <native:divider class="w-full mx-4 my-4" />

        {{-- Quantity & Add to Bag --}}
        <native:column class="w-full items-center px-4 pb-4 gap-3">
            {{-- Quantity Selector --}}
            <native:row class="items-center gap-4 w-full">
                <native:column @press="decrementQty" class="w-[40] h-[40] rounded-full bg-[#F5F5F5] items-center justify-center">
                    <native:icon name="remove" :size="20" color="#111111" />
                </native:column>
                <native:text class="text-[18] font-bold text-[#111111]">{{ $quantity }}</native:text>
                <native:column @press="incrementQty" class="w-[40] h-[40] rounded-full bg-[#F5F5F5] items-center justify-center">
                    <native:icon name="add" :size="20" color="#111111" />
                </native:column>
                <native:spacer class="w-[20]" />
                <native:text class="text-[14] text-[#484848]">Total: {{ $totalFormatted }}</native:text>
            </native:row>

            {{-- Add to Bag Button --}}
            <native:button @press="addToCart" class="w-full rounded bg-[#003399] text-white text-lg">Add to shopping bag</native:button>

            {{-- Favorite Button --}}
            <native:row @press="toggleFavorite" class="w-full py-3 rounded-lg items-center justify-center gap-2 bg-[#F5F5F5]">
                <native:icon
                    name="{{ $isFavorited ? 'favorite' : 'favorite_border' }}"
                    :size="20"
                    color="{{ $isFavorited ? '#CC0000' : '#484848' }}"
                />
                <native:text class="text-[14] text-[#111111]">{{ $isFavorited ? 'Saved to favorites' : 'Save to favorites' }}</native:text>
            </native:row>
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
