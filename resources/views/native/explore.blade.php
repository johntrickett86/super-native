@include('native.partials.demo-nav', ['title' => 'AirBNB'])

<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full gap-0 ">

        {{-- Search Bar --}}
        <native:column class="w-full px-5 pt-3 pb-2">
            <native:row class="w-full bg-white rounded-full shadow-lg px-4 py-3 items-center gap-4">
                <native:icon name="search" :size="22" color="#222222" />
                <native:column class="gap-0">
                    <native:text class="text-[14] font-semibold text-[#222222]">Where to?</native:text>
                    <native:text class="text-[12] text-[#717171]">Anywhere · Any week · Add guests</native:text>
                </native:column>
                <native:spacer />
                <native:column class="w-[36] h-[36] rounded-full bg-white items-center justify-center shadow">
                    <native:icon name="tune" :size="18" color="#222222" />
                </native:column>
            </native:row>
        </native:column>

        {{-- Category Icons --}}
        <native:scroll-view horizontal>
            <native:row class="gap-0 px-3 pt-2 pb-2">
                @foreach ($categories as $catIndex => $cat)
                    <native:column @press="selectCategory({{ $catIndex }})" class="items-center gap-1 px-3 pb-2">
                        <native:icon
                            name="{{ $cat['icon'] }}"
                            :size="24"
                            color="{{ $selectedCategory === $catIndex ? '#222222' : '#717171' }}"
                        />
                        <native:text class="text-[10] {{ $selectedCategory === $catIndex ? 'font-semibold text-[#222222]' : 'text-[#717171]' }}">{{ $cat['name'] }}</native:text>
                        @if ($selectedCategory === $catIndex)
                            <native:column class="w-full h-[2] bg-[#222222]" />
                        @endif
                    </native:column>
                @endforeach
            </native:row>
        </native:scroll-view>

        <native:divider class="w-full" />

        {{-- Listing Cards --}}
        <native:column class="w-full gap-6 px-5 pt-4 pb-4">
            @foreach ($listings as $listing)
                <native:column class="w-full gap-0">
                    {{-- Image with Heart --}}
                    <native:stack class="w-full h-[320] rounded-xl">
                        <native:column @press="viewListing({{ $listing['originalIndex'] }})" class="w-full h-[320]">
                            <native:image
                                src="{{ $listing['imageUrl'] }}"
                                class="w-full h-[320] rounded-xl"
                                :fit="2"
                            />
                        </native:column>
                        {{-- Wishlist Heart --}}
                        <native:row class="w-full p-3 items-start justify-end">
                            <native:column @press="toggleWishlist({{ $listing['originalIndex'] }})" class="w-[32] h-[32] items-center justify-center">
                                <native:icon
                                    name="{{ $listing['isWishlisted'] ? 'favorite' : 'favorite_border' }}"
                                    :size="24"
                                    color="{{ $listing['isWishlisted'] ? '#FF385C' : '#FFFFFF' }}"
                                />
                            </native:column>
                        </native:row>
                        {{-- Guest Favorite Badge --}}
                        @if ($listing['rating'] >= 4.9)
                            <native:column class="w-full h-[320] justify-start items-start p-3">
                                <native:row class="bg-white rounded-full px-3 py-1 items-center shadow">
                                    <native:text class="text-[11] font-bold text-[#222222]">Guest favorite</native:text>
                                </native:row>
                            </native:column>
                        @endif
                    </native:stack>

                    {{-- Info Below Image --}}
                    <native:column @press="viewListing({{ $listing['originalIndex'] }})" class="w-full pt-3 gap-1">
                        <native:row class="w-full items-start justify-between">
                            <native:text class="text-[15] font-semibold text-[#222222] w-[280]" :maxLines="1">{{ $listing['location'] }}</native:text>
                            <native:row class="items-center gap-1">
                                <native:icon name="star" :size="13" color="#222222" />
                                <native:text class="text-[14] text-[#222222]">{{ $listing['rating'] }}</native:text>
                            </native:row>
                        </native:row>
                        <native:text class="text-[14] text-[#717171]">{{ $listing['distance'] }}</native:text>
                        <native:text class="text-[14] text-[#717171]">{{ $listing['dates'] }}</native:text>
                        <native:row class="items-center gap-1 pt-1">
                            <native:text class="text-[15] font-semibold text-[#222222]">${{ $listing['price'] }}</native:text>
                            <native:text class="text-[14] text-[#222222]">night</native:text>
                        </native:row>
                    </native:column>
                </native:column>
            @endforeach
        </native:column>

        {{-- Bottom Navigation --}}
        <native:divider class="w-full" />
        <native:row class="w-full bg-white px-2 pt-2 pb-6 items-center justify-around">
            <native:column class="items-center gap-1 px-3">
                <native:icon name="search" :size="24" color="#FF385C" />
                <native:text class="text-[10] font-semibold text-[#FF385C]">Explore</native:text>
            </native:column>
            <native:column class="items-center gap-1 px-3">
                <native:icon name="favorite_border" :size="24" color="#717171" />
                <native:text class="text-[10] text-[#717171]">Wishlists</native:text>
            </native:column>
            <native:column class="items-center gap-1 px-3">
                <native:icon name="luggage" :size="24" color="#717171" />
                <native:text class="text-[10] text-[#717171]">Trips</native:text>
            </native:column>
            <native:column class="items-center gap-1 px-3">
                <native:icon name="chat_bubble_outline" :size="24" color="#717171" />
                <native:text class="text-[10] text-[#717171]">Inbox</native:text>
            </native:column>
            <native:column class="items-center gap-1 px-3">
                <native:icon name="person_outline" :size="24" color="#717171" />
                <native:text class="text-[10] text-[#717171]">Profile</native:text>
            </native:column>
        </native:row>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
