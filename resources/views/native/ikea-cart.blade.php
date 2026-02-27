<native:column class="w-full h-full bg-gray-50 safe-area">

    {{-- Top Bar --}}
    <native:column class="w-full bg-[#003399]">
        <native:row class="w-full px-4 py-3 items-center gap-3">
            <native:column @press="back" class="w-[32] h-[32] rounded-full bg-white/20 items-center justify-center">
                <native:icon name="arrow_back" :size="20" color="#FFFFFF" />
            </native:column>
            <native:text class="text-[18] font-bold text-white">Shopping bag ({{ $itemCount }})</native:text>
        </native:row>
    </native:column>

    {{-- Delivery Banner --}}
    @if ($freeDelivery)
        <native:row class="w-full bg-[#E8F5E9] px-4 py-2 items-center gap-2">
            <native:icon name="check_circle" :size="16" color="#0A8A00" />
            <native:text class="text-[13] text-[#0A8A00] font-semibold">You qualify for FREE delivery!</native:text>
        </native:row>
    @else
        <native:row class="w-full bg-[#FFF8E1] px-4 py-2 items-center gap-2">
            <native:icon name="local_shipping" :size="16" color="#E8860C" />
            <native:text class="text-[13] text-[#E8860C]">Add more for free delivery (orders over $500)</native:text>
        </native:row>
    @endif

    {{-- Cart Items --}}
    <native:scroll-view class="w-full h-full">
        <native:column class="w-full gap-0">
            @forelse ($items as $item)
                <native:column class="w-full bg-white px-4 py-3">
                    <native:row class="w-full gap-3">
                        {{-- Product Image --}}
                        <native:column class="w-[80] h-[80] bg-[#F5F5F5] rounded-lg items-center justify-center">
                            <native:image
                                src="{{ $item['imageUrl'] }}"
                                class="w-[70] h-[70] rounded-lg"
                                :fit="2"
                            />
                        </native:column>

                        {{-- Product Details --}}
                        <native:column class="w-[230] gap-1">
                            <native:text class="text-[13] font-bold text-[#111111]">{{ $item['seriesName'] }}</native:text>
                            <native:text class="text-[12] text-[#484848]" :maxLines="1">{{ $item['name'] }}</native:text>
                            <native:text class="text-[11] text-[#484848]">{{ $item['color'] }}</native:text>
                            <native:text class="text-[15] font-bold text-[#111111]">{{ $item['priceFormatted'] }}</native:text>

                            {{-- Quantity Controls --}}
                            <native:row class="items-center gap-3 pt-1">
                                <native:column @press="decrementItem({{ $item['productIndex'] }})" class="w-[28] h-[28] rounded-full bg-[#F5F5F5] items-center justify-center">
                                    <native:icon name="remove" :size="16" color="#111111" />
                                </native:column>
                                <native:text class="text-[14] font-bold text-[#111111]">{{ $item['qty'] }}</native:text>
                                <native:column @press="incrementItem({{ $item['productIndex'] }})" class="w-[28] h-[28] rounded-full bg-[#F5F5F5] items-center justify-center">
                                    <native:icon name="add" :size="16" color="#111111" />
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
                    <native:icon name="shopping_bag" :size="56" color="#CCCCCC" />
                    <native:text class="text-[16] text-[#999999]">Your shopping bag is empty</native:text>
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
                <native:text class="text-[13] text-[#484848]">Subtotal ({{ $itemCount }} items)</native:text>
                <native:text class="text-[14] text-[#111111]">{{ $subtotalFormatted }}</native:text>
            </native:row>
            <native:row class="w-full justify-between items-center">
                <native:text class="text-[13] text-[#484848]">Delivery</native:text>
                <native:text class="text-[14] text-{{ $freeDelivery ? '[#0A8A00]' : '[#111111]' }}">{{ $deliveryFeeFormatted }}</native:text>
            </native:row>
            <native:divider class="w-full" />
            <native:row class="w-full justify-between items-center">
                <native:text class="text-[16] font-bold text-[#111111]">Total</native:text>
                <native:text class="text-[18] font-bold text-[#111111]">{{ $totalFormatted }}</native:text>
            </native:row>
            <native:button
                label="Continue to checkout"
                @press="checkout"
                color="#003399"
                labelColor="#FFFFFF"
                :fontSize="16"
            />
        </native:column>
    @endif

</native:column>
