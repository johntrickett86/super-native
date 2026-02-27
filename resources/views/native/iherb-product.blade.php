<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full gap-0 safe-area">

        {{-- Top Bar --}}
        <native:column class="w-full bg-[#507D2A]">
            <native:row class="w-full px-4 py-3 items-center justify-between">
                <native:column @press="back" class="w-[32] h-[32] rounded-full bg-white/20 items-center justify-center">
                    <native:icon name="arrow_back" :size="20" color="#FFFFFF" />
                </native:column>
                <native:row class="items-center gap-3">
                    <native:column @press="toggleWishlist">
                        <native:icon
                            name="{{ $isWishlisted ? 'favorite' : 'favorite_border' }}"
                            :size="22"
                            color="#FFFFFF"
                        />
                    </native:column>
                    <native:icon name="share" :size="22" color="#FFFFFF" />
                </native:row>
            </native:row>
        </native:column>

        {{-- Product Image --}}
        <native:column class="w-full items-center bg-gray-50 py-6">
            <native:image
                src="{{ $product['imageUrl'] }}"
                class="w-[250] h-[250]"
                :fit="1"
            />
        </native:column>

        {{-- Product Info --}}
        <native:column class="w-full px-4 pt-4 gap-2">
            {{-- Brand --}}
            <native:text class="text-[13] text-[#507D2A] font-semibold">{{ $product['brand'] }}</native:text>

            {{-- Name --}}
            <native:text class="text-[18] font-bold text-[#333333]">{{ $product['name'] }}</native:text>

            {{-- Rating --}}
            <native:row class="items-center gap-2">
                <native:row class="items-center gap-0">
                    <native:icon name="star" :size="16" color="#DAA520" />
                    <native:icon name="star" :size="16" color="#DAA520" />
                    <native:icon name="star" :size="16" color="#DAA520" />
                    <native:icon name="star" :size="16" color="#DAA520" />
                    <native:icon name="star_half" :size="16" color="#DAA520" />
                </native:row>
                <native:text class="text-[13] text-[#507D2A]">{{ $reviewFormatted }}</native:text>
            </native:row>

            {{-- Stock & Popularity --}}
            <native:row class="items-center justify-between">
                @if ($product['inStock'])
                    <native:text class="text-[13] text-[#507D2A] font-semibold">In stock</native:text>
                @else
                    <native:text class="text-[13] text-[#CC0000] font-semibold">Out of stock</native:text>
                @endif
                <native:row class="items-center gap-1">
                    <native:icon name="trending_up" :size="14" color="#CC0000" />
                    <native:text class="text-[12] text-[#CC0000]">{{ $product['soldIn30Days'] }} sold in 30 days</native:text>
                </native:row>
            </native:row>
        </native:column>

        <native:divider class="w-full mx-4 my-3" />

        {{-- Details --}}
        <native:column class="w-full px-4 gap-2">
            <native:row class="items-center gap-2">
                <native:icon name="verified" :size="16" color="#507D2A" />
                <native:text class="text-[13] text-[#333333]">100% authentic</native:text>
            </native:row>
            @if ($product['bestBy'])
                <native:row class="items-center gap-2">
                    <native:icon name="event" :size="16" color="#666666" />
                    <native:text class="text-[13] text-[#333333]">Best by: {{ $product['bestBy'] }}</native:text>
                </native:row>
            @endif
            <native:row class="items-center gap-2">
                <native:icon name="local_shipping" :size="16" color="#666666" />
                <native:text class="text-[13] text-[#333333]">Shipping weight: {{ $product['shippingWeight'] }}</native:text>
            </native:row>
        </native:column>

        <native:divider class="w-full mx-4 my-3" />

        {{-- Product Rankings --}}
        <native:column class="w-full px-4 gap-1">
            <native:text class="text-[14] font-semibold text-[#E8860C]">Product rankings</native:text>
            @foreach ($product['rankings'] as $ranking)
                <native:text class="text-[13] text-[#507D2A]">{{ $ranking }}</native:text>
            @endforeach
        </native:column>

        <native:divider class="w-full mx-4 my-3" />

        {{-- Description --}}
        <native:column class="w-full px-4 gap-2">
            <native:text class="text-[15] font-semibold text-[#333333]">Description</native:text>
            <native:text class="text-[14] text-[#666666]">{{ $product['description'] }}</native:text>
        </native:column>

        <native:divider class="w-full mx-4 my-4" />

        {{-- Price & Add to Cart --}}
        <native:column class="w-full px-4 pb-4 gap-3">
            {{-- Price --}}
            <native:row class="items-center gap-2">
                <native:text class="text-[24] font-bold text-[#333333]">{{ $priceFormatted }}</native:text>
                @if ($originalPriceFormatted)
                    <native:text class="text-[15] text-[#999999] line-through">{{ $originalPriceFormatted }}</native:text>
                @endif
            </native:row>
            @if ($product['servingInfo'])
                <native:text class="text-[12] text-[#666666] mt-[-4]">{{ $product['servingInfo'] }}</native:text>
            @endif

            {{-- Free Shipping --}}
            <native:row class="items-center gap-1">
                <native:icon name="local_shipping" :size="14" color="#507D2A" />
                <native:text class="text-[12] text-[#507D2A]">FREE shipping over $30</native:text>
            </native:row>

            {{-- Quantity Selector --}}
            <native:row class="items-center gap-4">
                <native:column @press="decrementQty" class="w-[36] h-[36] rounded-full bg-gray-200 items-center justify-center">
                    <native:icon name="remove" :size="20" color="#333333" />
                </native:column>
                <native:text class="text-[18] font-bold text-[#333333]">{{ $quantity }}</native:text>
                <native:column @press="incrementQty" class="w-[36] h-[36] rounded-full bg-gray-200 items-center justify-center">
                    <native:icon name="add" :size="20" color="#333333" />
                </native:column>
                <native:spacer class="w-[20]" />
                <native:text class="text-[14] text-[#666666]">Total: {{ $totalFormatted }}</native:text>
            </native:row>

            {{-- Add to Cart Button --}}
            <native:button
                label="Add to Cart"
                @press="addToCart"
                color="#E8860C"
                labelColor="#FFFFFF"
                :fontSize="16"
            />

            {{-- Wishlist Button --}}
            <native:row @press="toggleWishlist" class="w-full py-3 rounded-lg items-center justify-center gap-2 bg-gray-100">
                <native:icon
                    name="{{ $isWishlisted ? 'favorite' : 'favorite_border' }}"
                    :size="20"
                    color="{{ $isWishlisted ? '#CC0000' : '#666666' }}"
                />
                <native:text class="text-[14] text-[#333333]">{{ $isWishlisted ? 'Saved to List' : 'Add to Lists' }}</native:text>
            </native:row>
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
