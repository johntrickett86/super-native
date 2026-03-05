<native:scroll-view class="w-full h-full bg-[#0F0F0F] safe-area">
    <native:column class="w-full gap-0 ">

        {{-- Video Player Area --}}
        <native:stack class="w-full h-[220] bg-black">
            <native:image
                src="{{ $video['thumbnailUrl'] }}"
                class="w-full h-[220]"
                :fit="2"
            />
            {{-- Play Button Overlay --}}
            <native:column class="w-full h-[220] items-center justify-center">
                <native:column class="w-[56] h-[56] rounded-full bg-[#00000088] items-center justify-center">
                    <native:icon name="play_arrow" :size="36" color="#FFFFFF" />
                </native:column>
            </native:column>
            {{-- Top Bar --}}
            <native:row class="w-full px-3 pt-3 items-center justify-between">
                <native:column @press="back" class="w-[32] h-[32] rounded-full bg-[#00000066] items-center justify-center">
                    <native:icon name="arrow_back" :size="20" color="#FFFFFF" />
                </native:column>
                <native:row class="items-center gap-2">
                    <native:column class="w-[32] h-[32] rounded-full bg-[#00000066] items-center justify-center">
                        <native:icon name="settings" :size="18" color="#FFFFFF" />
                    </native:column>
                </native:row>
            </native:row>
            {{-- Duration --}}
            <native:column class="w-full h-[220] items-end justify-end p-2">
                <native:column class="bg-[#000000CC] rounded px-2 py-[2]">
                    <native:text class="text-[12] font-semibold text-white">{{ $video['duration'] }}</native:text>
                </native:column>
            </native:column>
        </native:stack>

        {{-- Video Title & Info --}}
        <native:column @press="toggleDescription" class="w-full px-3 pt-3 gap-1">
            <native:text class="text-[16] font-bold text-white" :maxLines="$showDescription ? 10 : 2">{{ $video['title'] }}</native:text>
            <native:row class="items-center gap-1">
                <native:text class="text-[12] text-[#AAAAAA]">{{ $viewsFormatted }} views · {{ $video['uploadedAt'] }}</native:text>
                <native:icon name="{{ $showDescription ? 'expand_less' : 'expand_more' }}" :size="16" color="#AAAAAA" />
            </native:row>
        </native:column>

        {{-- Expandable Description --}}
        @if ($showDescription)
            <native:column class="w-full px-3 pt-2 pb-2">
                <native:text class="text-[13] text-[#CCCCCC]">{{ $video['description'] }}</native:text>
            </native:column>
        @endif

        {{-- Action Buttons --}}
        <native:scroll-view horizontal>
            <native:row class="px-3 pt-3 pb-2 gap-2">
                {{-- Like --}}
                <native:row @press="toggleLike" class="bg-[#272727] rounded-full px-4 py-2 items-center gap-2">
                    <native:icon
                        name="{{ $isLiked ? 'thumb_up' : 'thumb_up_off_alt' }}"
                        :size="20"
                        color="{{ $isLiked ? '#FFFFFF' : '#AAAAAA' }}"
                    />
                    <native:text class="text-[13] font-semibold text-white">{{ $likesFormatted }}</native:text>
                    <native:text class="text-[13] text-[#AAAAAA]">|</native:text>
                    <native:column @press="toggleDislike">
                        <native:icon
                            name="{{ $isDisliked ? 'thumb_down' : 'thumb_down_off_alt' }}"
                            :size="20"
                            color="{{ $isDisliked ? '#FFFFFF' : '#AAAAAA' }}"
                        />
                    </native:column>
                </native:row>

                {{-- Share --}}
                <native:row class="bg-[#272727] rounded-full px-4 py-2 items-center gap-2">
                    <native:icon name="share" :size="20" color="#AAAAAA" />
                    <native:text class="text-[13] font-semibold text-white">Share</native:text>
                </native:row>

                {{-- Download --}}
                <native:row class="bg-[#272727] rounded-full px-4 py-2 items-center gap-2">
                    <native:icon name="download" :size="20" color="#AAAAAA" />
                    <native:text class="text-[13] font-semibold text-white">Download</native:text>
                </native:row>

                {{-- Save --}}
                <native:row class="bg-[#272727] rounded-full px-4 py-2 items-center gap-2">
                    <native:icon name="playlist_add" :size="20" color="#AAAAAA" />
                    <native:text class="text-[13] font-semibold text-white">Save</native:text>
                </native:row>
            </native:row>
        </native:scroll-view>

        <native:divider class="w-full" color="#272727" />

        {{-- Channel Info --}}
        <native:row class="w-full px-3 py-3 items-center gap-3">
            <native:column @press="viewChannel({{ $video['channelId'] }})">
                <native:image
                    src="{{ $channel['avatarUrl'] }}"
                    class="w-[40] h-[40] rounded-full"
                    :fit="2"
                />
            </native:column>
            <native:column @press="viewChannel({{ $video['channelId'] }})" class="w-[170] gap-0">
                <native:row class="items-center gap-1">
                    <native:text class="text-[14] font-semibold text-white" :maxLines="1">{{ $channel['name'] }}</native:text>
                    @if ($channel['isVerified'])
                        <native:icon name="verified" :size="14" color="#AAAAAA" />
                    @endif
                </native:row>
                <native:text class="text-[12] text-[#AAAAAA]">{{ $subscribersFormatted }} subscribers</native:text>
            </native:column>
            <native:spacer />
            <native:column
                @press="toggleSubscribe"
                class="px-4 py-2 rounded-full {{ $isSubscribed ? 'bg-[#272727]' : 'bg-white' }}"
            >
                <native:text class="text-[13] font-bold {{ $isSubscribed ? 'text-white' : 'text-black' }}">{{ $isSubscribed ? 'Subscribed' : 'Subscribe' }}</native:text>
            </native:column>
        </native:row>

        <native:divider class="w-full" color="#272727" />

        {{-- Comments Section --}}
        <native:row @press="toggleDescription" class="w-full px-3 pt-3 pb-2 items-center justify-between">
            <native:row class="items-center gap-2">
                <native:text class="text-[15] font-bold text-white">Comments</native:text>
                <native:text class="text-[13] text-[#AAAAAA]">{{ $commentCountFormatted }}</native:text>
            </native:row>
        </native:row>

        {{-- Comment List --}}
        @foreach (array_slice($comments, 0, 4) as $comment)
            <native:row class="w-full px-3 py-2 gap-3">
                <native:image
                    src="{{ $comment['avatarUrl'] }}"
                    class="w-[28] h-[28] rounded-full"
                    :fit="2"
                />
                <native:column class="w-[300] gap-1">
                    <native:row class="items-center gap-2">
                        <native:text class="text-[12] text-[#AAAAAA]">{{ $comment['username'] }}</native:text>
                        <native:text class="text-[11] text-[#717171]">{{ $comment['time'] }}</native:text>
                    </native:row>
                    <native:text class="text-[13] text-white">{{ $comment['text'] }}</native:text>
                    <native:row class="items-center gap-3 pt-1">
                        <native:row class="items-center gap-1">
                            <native:icon name="thumb_up_off_alt" :size="14" color="#AAAAAA" />
                            <native:text class="text-[11] text-[#AAAAAA]">{{ \App\NativeComponents\Concerns\HasYouTubeData::formatYtCount($comment['likes']) }}</native:text>
                        </native:row>
                        <native:icon name="thumb_down_off_alt" :size="14" color="#AAAAAA" />
                        <native:text class="text-[11] text-[#AAAAAA]">{{ $comment['replies'] }} replies</native:text>
                    </native:row>
                </native:column>
            </native:row>
        @endforeach

        <native:divider class="w-full mt-2" color="#272727" />

        {{-- Suggested Videos --}}
        <native:column class="w-full px-3 pt-3 pb-2">
            <native:text class="text-[15] font-bold text-white">Up next</native:text>
        </native:column>

        @foreach ($suggested as $sVideo)
            <native:row @press="viewVideo({{ $sVideo['index'] }})" class="w-full px-3 py-2 gap-3">
                <native:stack class="w-[160] h-[90]">
                    <native:image
                        src="{{ $sVideo['thumbnailUrl'] }}"
                        class="w-[160] h-[90] rounded-lg"
                        :fit="2"
                    />
                    <native:column class="w-[160] h-[90] items-end justify-end p-1">
                        <native:column class="bg-[#000000CC] rounded px-1 py-[1]">
                            <native:text class="text-[10] font-semibold text-white">{{ $sVideo['duration'] }}</native:text>
                        </native:column>
                    </native:column>
                </native:stack>
                <native:column class="w-[170] gap-1">
                    <native:text class="text-[13] font-semibold text-white" :maxLines="2">{{ $sVideo['title'] }}</native:text>
                    <native:row class="items-center gap-1">
                        <native:text class="text-[11] text-[#AAAAAA]">{{ $sVideo['channel']['name'] }}</native:text>
                        @if ($sVideo['channel']['isVerified'])
                            <native:icon name="verified" :size="10" color="#AAAAAA" />
                        @endif
                    </native:row>
                    <native:text class="text-[11] text-[#AAAAAA]">{{ $sVideo['viewsFormatted'] }} views · {{ $sVideo['uploadedAt'] }}</native:text>
                </native:column>
            </native:row>
        @endforeach

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
