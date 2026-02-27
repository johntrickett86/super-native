<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full gap-0">

        {{-- Hero Image with Navigation --}}
        <native:stack class="w-full h-[300]">
            <native:image
                src="{{ $currentImageUrl }}"
                class="w-full h-[300]"
                :fit="2"
            />
            {{-- Top Bar Overlay --}}
            <native:row class="w-full px-4 pt-[52] items-center justify-between">
                <native:column @press="back" class="w-[34] h-[34] rounded-full bg-white items-center justify-center shadow">
                    <native:icon name="arrow_back" :size="18" color="#222222" />
                </native:column>
                <native:row class="items-center gap-2">
                    <native:column class="w-[34] h-[34] rounded-full bg-white items-center justify-center shadow">
                        <native:icon name="ios_share" :size="18" color="#222222" />
                    </native:column>
                    <native:column @press="toggleWishlist" class="w-[34] h-[34] rounded-full bg-white items-center justify-center shadow">
                        <native:icon
                            name="{{ $isWishlisted ? 'favorite' : 'favorite_border' }}"
                            :size="18"
                            color="{{ $isWishlisted ? '#FF385C' : '#222222' }}"
                        />
                    </native:column>
                </native:row>
            </native:row>
            {{-- Image Arrows --}}
            @if ($imageCount > 1)
                <native:row class="w-full h-[300] px-3 items-center justify-between">
                    <native:column @press="prevImage" class="w-[28] h-[28] rounded-full bg-white items-center justify-center shadow">
                        <native:icon name="chevron_left" :size="18" color="#222222" />
                    </native:column>
                    <native:column @press="nextImage" class="w-[28] h-[28] rounded-full bg-white items-center justify-center shadow">
                        <native:icon name="chevron_right" :size="18" color="#222222" />
                    </native:column>
                </native:row>
            @endif
            {{-- Image Dots --}}
            <native:column class="w-full h-[300] justify-end items-center pb-3">
                <native:row class="items-center gap-1">
                    @for ($d = 0; $d < $imageCount; $d++)
                        <native:column class="w-[6] h-[6] rounded-full {{ $d === $currentImage ? 'bg-white' : 'bg-[#FFFFFF88]' }}" />
                    @endfor
                </native:row>
            </native:column>
        </native:stack>

        {{-- Title --}}
        <native:column class="w-full px-5 pt-5 gap-1">
            <native:text class="text-[24] font-bold text-[#222222]">{{ $listing['title'] }}</native:text>
        </native:column>

        {{-- Rating + Reviews Row --}}
        <native:row class="w-full px-5 pt-2 items-center gap-1">
            <native:icon name="star" :size="14" color="#222222" />
            <native:text class="text-[14] font-semibold text-[#222222]">{{ $listing['rating'] }}</native:text>
            <native:text class="text-[14] text-[#222222]"> · </native:text>
            <native:text class="text-[14] font-semibold text-[#222222]">{{ $listing['reviewCount'] }} reviews</native:text>
            <native:text class="text-[14] text-[#222222]"> · </native:text>
            <native:text class="text-[14] font-semibold text-[#222222]">{{ $listing['location'] }}</native:text>
        </native:row>

        <native:divider class="w-full mx-5 mt-5 mb-0" color="#EBEBEB" />

        {{-- Property Type + Host --}}
        <native:row class="w-full px-5 py-5 items-center justify-between">
            <native:column class="w-[260] gap-1">
                <native:text class="text-[20] font-semibold text-[#222222]">{{ $listing['type'] }} hosted by {{ $listing['host'] }}</native:text>
                <native:row class="items-center gap-0">
                    <native:text class="text-[14] text-[#717171]">{{ $listing['guests'] }} guests · {{ $listing['bedrooms'] }} {{ $listing['bedrooms'] === 1 ? 'bedroom' : 'bedrooms' }} · {{ $listing['beds'] }} {{ $listing['beds'] === 1 ? 'bed' : 'beds' }} · {{ $bathroomsFormatted }} {{ $listing['bathrooms'] == 1 ? 'bath' : 'baths' }}</native:text>
                </native:row>
            </native:column>
            <native:stack class="w-[56] h-[56]">
                <native:image
                    src="{{ $listing['hostAvatarUrl'] }}"
                    class="w-[56] h-[56] rounded-full"
                    :fit="2"
                />
                @if ($listing['hostIsSuperhost'])
                    <native:column class="w-[56] h-[56] items-end justify-end">
                        <native:column class="w-[20] h-[20] rounded-full bg-[#FF385C] items-center justify-center">
                            <native:icon name="verified" :size="14" color="#FFFFFF" />
                        </native:column>
                    </native:column>
                @endif
            </native:stack>
        </native:row>

        <native:divider class="w-full mx-5" color="#EBEBEB" />

        {{-- Highlights --}}
        <native:column class="w-full px-5 py-5 gap-5">
            @foreach ($listing['highlights'] as $highlight)
                <native:row class="w-full items-start gap-4">
                    <native:icon name="{{ $highlight['icon'] }}" :size="26" color="#222222" />
                    <native:column class="w-[280] gap-1">
                        <native:text class="text-[14] font-semibold text-[#222222]">{{ $highlight['title'] }}</native:text>
                        @if ($highlight['subtitle'] !== '')
                            <native:text class="text-[13] text-[#717171]">{{ $highlight['subtitle'] }}</native:text>
                        @endif
                    </native:column>
                </native:row>
            @endforeach
        </native:column>

        <native:divider class="w-full mx-5" color="#EBEBEB" />

        {{-- Description --}}
        <native:column class="w-full px-5 py-5 gap-3">
            <native:text class="text-[14] text-[#222222]" :maxLines="$showFullDescription ? 50 : 4">{{ $listing['description'] }}</native:text>
            <native:column @press="toggleDescription">
                <native:row class="items-center gap-1">
                    <native:text class="text-[14] font-semibold text-[#222222]">{{ $showFullDescription ? 'Show less' : 'Show more' }}</native:text>
                    <native:icon name="{{ $showFullDescription ? 'expand_less' : 'chevron_right' }}" :size="16" color="#222222" />
                </native:row>
            </native:column>
        </native:column>

        <native:divider class="w-full mx-5" color="#EBEBEB" />

        {{-- Amenities --}}
        <native:column class="w-full px-5 py-5 gap-4">
            <native:text class="text-[20] font-semibold text-[#222222]">What this place offers</native:text>
            @foreach (array_slice($listing['amenities'], 0, 6) as $amenity)
                <native:row class="w-full items-center gap-4 py-1">
                    <native:icon name="{{ $amenity['icon'] }}" :size="24" color="#222222" />
                    <native:text class="text-[15] text-[#222222]">{{ $amenity['label'] }}</native:text>
                </native:row>
            @endforeach
            @if (count($listing['amenities']) > 6)
                <native:column class="w-full py-3 rounded-lg items-center border border-[#222222]">
                    <native:text class="text-[14] font-semibold text-[#222222]">Show all {{ count($listing['amenities']) }} amenities</native:text>
                </native:column>
            @endif
        </native:column>

        <native:divider class="w-full mx-5" color="#EBEBEB" />

        {{-- Reviews Section --}}
        <native:column class="w-full px-5 pt-5 pb-2 gap-2">
            <native:row class="items-center gap-2">
                <native:icon name="star" :size="18" color="#222222" />
                <native:text class="text-[20] font-semibold text-[#222222]">{{ $listing['rating'] }} · {{ $listing['reviewCount'] }} reviews</native:text>
            </native:row>
        </native:column>

        <native:scroll-view horizontal>
            <native:row class="gap-3 px-5 pt-2 pb-5">
                @foreach ($listingReviews as $review)
                    <native:column class="w-[280] p-4 rounded-xl gap-3 border border-[#EBEBEB]">
                        <native:text class="text-[14] text-[#222222]" :maxLines="4">{{ $review['text'] }}</native:text>
                        <native:spacer />
                        <native:row class="items-center gap-3">
                            <native:image
                                src="{{ $review['avatarUrl'] }}"
                                class="w-[40] h-[40] rounded-full"
                                :fit="2"
                            />
                            <native:column>
                                <native:text class="text-[14] font-semibold text-[#222222]">{{ $review['username'] }}</native:text>
                                <native:text class="text-[12] text-[#717171]">{{ $review['date'] }}</native:text>
                            </native:column>
                        </native:row>
                    </native:column>
                @endforeach
            </native:row>
        </native:scroll-view>

        <native:divider class="w-full mx-5" color="#EBEBEB" />

        {{-- Where You'll Be --}}
        <native:column class="w-full px-5 py-5 gap-3">
            <native:text class="text-[20] font-semibold text-[#222222]">Where you'll be</native:text>
            <native:column class="w-full h-[180] bg-[#F7F7F7] rounded-xl items-center justify-center">
                <native:icon name="map" :size="48" color="#B0B0B0" />
                <native:text class="text-[13] text-[#717171] pt-2">{{ $listing['location'] }}</native:text>
            </native:column>
        </native:column>

        <native:divider class="w-full mx-5" color="#EBEBEB" />

        {{-- Host Section --}}
        <native:column class="w-full px-5 py-5 gap-4">
            <native:row class="items-center gap-4">
                <native:stack class="w-[56] h-[56]">
                    <native:image
                        src="{{ $listing['hostAvatarUrl'] }}"
                        class="w-[56] h-[56] rounded-full"
                        :fit="2"
                    />
                    @if ($listing['hostIsSuperhost'])
                        <native:column class="w-[56] h-[56] items-end justify-end">
                            <native:column class="w-[20] h-[20] rounded-full bg-[#FF385C] items-center justify-center">
                                <native:icon name="verified" :size="14" color="#FFFFFF" />
                            </native:column>
                        </native:column>
                    @endif
                </native:stack>
                <native:column>
                    <native:text class="text-[18] font-semibold text-[#222222]">Hosted by {{ $listing['host'] }}</native:text>
                    <native:text class="text-[13] text-[#717171]">{{ $listing['hostYears'] }} years hosting</native:text>
                </native:column>
            </native:row>
            @if ($listing['hostIsSuperhost'])
                <native:row class="items-center gap-2">
                    <native:icon name="verified_user" :size="18" color="#222222" />
                    <native:text class="text-[14] text-[#222222]">Superhost</native:text>
                </native:row>
            @endif
        </native:column>

        <native:spacer class="h-[20]" />

        {{-- Reserve Bar --}}
        <native:divider class="w-full" color="#EBEBEB" />
        <native:row class="w-full bg-white px-5 pt-3 pb-6 items-center justify-between">
            <native:column class="gap-0">
                <native:row class="items-center gap-1">
                    <native:text class="text-[17] font-bold text-[#222222]">${{ $listing['price'] }}</native:text>
                    <native:text class="text-[15] text-[#222222]">night</native:text>
                </native:row>
                <native:text class="text-[12] text-[#222222]">{{ $listing['dates'] }}</native:text>
            </native:column>
            <native:column @press="reserve" class="bg-[#FF385C] rounded-lg px-6 py-3">
                <native:text class="text-[16] font-bold text-white">Reserve</native:text>
            </native:column>
        </native:row>

    </native:column>
</native:scroll-view>
