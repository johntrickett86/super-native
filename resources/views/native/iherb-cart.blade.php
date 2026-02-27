<native:column class="w-full h-full bg-gray-50 safe-area">

    {{-- Top Bar --}}
    <native:column class="w-full bg-[#507D2A]">
        <native:row class="w-full px-4 py-3 items-center gap-3">
            <native:column @press="back" class="w-[32] h-[32] rounded-full bg-white/20 items-center justify-center">
                <native:icon name="arrow_back" :size="20" color="#FFFFFF" />
            </native:column>
            <native:text class="text-[18] font-bold text-white">Cart ({{ $itemCount }})</native:text>
        </native:row>
    </native:column>

    {{-- Free Shipping Banner --}}
    @if ($freeShipping)
        <native:row class="w-full bg-[#E8F5E9] px-4 py-2 items-center gap-2">
            <native:icon name="check_circle" :size="16" color="#507D2A" />
            <native:text class="text-[13] text-[#507D2A] font-semibold">You qualify for FREE shipping!</native:text>
        </native:row>
    @else
        <native:row class="w-full bg-[#FFF3E0] px-4 py-2 items-center gap-2">
            <native:icon name="local_shipping" :size="16" color="#E8860C" />
            <native:text class="text-[13] text-[#E8860C]">Add more for free shipping (orders over $30)</native:text>
        </native:row>
    @endif

    {{-- Cart Items --}}
    <native:scroll-view class="w-full h-full">
        <native:column class="w-full gap-0">
            @forelse ($items as $item)
                <native:column class="w-full bg-white px-4 py-3">
                    <native:row class="w-full gap-3">
                        {{-- Product Image --}}
                        <native:image
                            src="{{ $item['imageUrl'] }}"
                            class="w-[80] h-[80] rounded-lg bg-gray-100"
                            :fit="2"
                        />

                        {{-- Product Details --}}
                        <native:column class="w-[230] gap-1">
                            <native:text class="text-[11] text-[#507D2A]">{{ $item['brand'] }}</native:text>
                            <native:text class="text-[13] text-[#333333]" :maxLines="2">{{ $item['name'] }}</native:text>
                            <native:text class="text-[15] font-bold text-[#333333]">{{ $item['priceFormatted'] }}</native:text>

                            {{-- Quantity Controls --}}
                            <native:row class="items-center gap-3 pt-1">
                                <native:column @press="decrementItem({{ $item['productIndex'] }})" class="w-[28] h-[28] rounded-full bg-gray-200 items-center justify-center">
                                    <native:icon name="remove" :size="16" color="#333333" />
                                </native:column>
                                <native:text class="text-[14] font-bold text-[#333333]">{{ $item['qty'] }}</native:text>
                                <native:column @press="incrementItem({{ $item['productIndex'] }})" class="w-[28] h-[28] rounded-full bg-gray-200 items-center justify-center">
                                    <native:icon name="add" :size="16" color="#333333" />
                                </native:column>
                                <native:spacer class="w-[20]" />
                                <native:column @press="removeItem({{ $item['productIndex'] }})">
                                    <native:icon name="delete_outline" :size="20" color="#CC0000" />
                                </native:column>
                            </native:row>
                        </native:column>
                    </native:row>
                </native:column>
                <native:divider class="w-full" />
            @empty
                <native:column class="w-full bg-white items-center py-12 gap-3">
                    <native:icon name="shopping_cart" :size="56" color="#CCCCCC" />
                    <native:text class="text-[16] text-[#999999]">Your cart is empty</native:text>
                    <native:text class="text-[13] text-[#999999]">Browse products and add items to get started</native:text>
                </native:column>
            @endforelse
        </native:column>
    </native:scroll-view>

    {{-- Bottom Checkout Bar --}}
    @if (count($items) > 0)
        <native:divider class="w-full" />
        <native:column class="w-full bg-white px-4 py-3 gap-2">
            <native:row class="w-full justify-between items-center">
                <native:text class="text-[14] text-[#666666]">Subtotal ({{ $itemCount }} items)</native:text>
                <native:text class="text-[18] font-bold text-[#333333]">{{ $subtotalFormatted }}</native:text>
            </native:row>
            <native:button
                label="Proceed to Checkout"
                @press="checkout"
                color="#E8860C"
                labelColor="#FFFFFF"
                :fontSize="16"
            />
        </native:column>
    @endif

</native:column>
