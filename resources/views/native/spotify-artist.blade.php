<native:scroll-view class="w-full h-full bg-[#121212] safe-area">
    <native:column class="w-full gap-0 ">

        {{-- Top Bar --}}
        <native:row class="w-full px-4 py-3 items-center gap-3">
            <native:column @press="back" class="w-[32] h-[32] items-center justify-center">
                <native:icon name="arrow_back" :size="24" color="#FFFFFF" />
            </native:column>
        </native:row>

        {{-- Artist Image --}}
        <native:image
            src="{{ $artist['imageUrl'] }}"
            class="w-full h-[280]"
            :fit="2"
        />

        {{-- Artist Info --}}
        <native:column class="w-full px-4 pt-4 gap-1">
            <native:text class="text-[28] font-bold text-white">{{ $artist['name'] }}</native:text>
            <native:text class="text-[13] text-[#B3B3B3]">{{ $listenersFormatted }} monthly listeners</native:text>
        </native:column>

        {{-- Action Row --}}
        <native:row class="w-full px-4 py-3 items-center gap-4">
            <native:column @press="toggleFollow" class="px-4 py-1 rounded-full {{ $isFollowing ? 'bg-[#1DB954]' : 'bg-transparent' }}" style="border: 1px solid {{ $isFollowing ? '#1DB954' : '#B3B3B3' }}">
                <native:text class="text-[13] font-bold text-{{ $isFollowing ? 'black' : 'white' }}">{{ $isFollowing ? 'Following' : 'Follow' }}</native:text>
            </native:column>
            <native:icon name="more_horiz" :size="24" color="#B3B3B3" />
            <native:spacer />
            <native:icon name="shuffle" :size="24" color="#1DB954" />
            <native:column @press="playTrack(0)" class="w-[48] h-[48] rounded-full bg-[#1DB954] items-center justify-center">
                <native:icon name="play_arrow" :size="28" color="#000000" />
            </native:column>
        </native:row>

        {{-- Popular Tracks --}}
        <native:column class="w-full px-4 pt-2 pb-2">
            <native:text class="text-[16] font-bold text-white">Popular</native:text>
        </native:column>

        <native:column class="w-full px-4 gap-0">
            @foreach ($tracksWithMeta as $trackIndex => $track)
                <native:row @press="playTrack({{ $trackIndex }})" class="w-full py-3 items-center gap-3">
                    <native:column class="w-[24] items-center">
                        <native:text class="text-[14] text-[#B3B3B3]">{{ $trackIndex + 1 }}</native:text>
                    </native:column>
                    <native:column class="w-[240] gap-1">
                        <native:text class="text-[15] text-white" :maxLines="1">{{ $track['title'] }}</native:text>
                        <native:text class="text-[12] text-[#B3B3B3]">{{ $track['playsFormatted'] }} plays</native:text>
                    </native:column>
                    <native:spacer />
                    <native:text class="text-[13] text-[#B3B3B3]">{{ $track['duration'] }}</native:text>
                    <native:icon name="more_vert" :size="18" color="#B3B3B3" />
                </native:row>
            @endforeach
        </native:column>

        <native:divider class="w-full mx-4 my-3" />

        {{-- About --}}
        <native:column class="w-full px-4 gap-2 pb-4">
            <native:text class="text-[16] font-bold text-white">About</native:text>
            <native:text class="text-[14] text-[#B3B3B3]">{{ $artist['bio'] }}</native:text>
            <native:row class="items-center gap-2 pt-1">
                <native:text class="text-[13] text-white font-bold">{{ $followersFormatted }}</native:text>
                <native:text class="text-[13] text-[#B3B3B3]">followers</native:text>
                <native:text class="text-[13] text-[#B3B3B3]">·</native:text>
                <native:text class="text-[13] text-[#B3B3B3]">{{ $artist['genre'] }}</native:text>
            </native:row>
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
