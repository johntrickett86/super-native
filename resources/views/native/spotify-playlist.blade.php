<native:scroll-view class="w-full h-full bg-[#121212]">
    <native:column class="w-full gap-0 safe-area">

        {{-- Top Bar --}}
        <native:row class="w-full px-4 py-3 items-center gap-3">
            <native:column @press="back" class="w-[32] h-[32] items-center justify-center">
                <native:icon name="arrow_back" :size="24" color="#FFFFFF" />
            </native:column>
        </native:row>

        {{-- Cover Art --}}
        <native:column class="w-full items-center py-4">
            <native:image
                src="{{ $playlist['coverUrl'] }}"
                class="w-[200] h-[200] rounded shadow-lg"
                :fit="2"
            />
        </native:column>

        {{-- Playlist Info --}}
        <native:column class="w-full px-4 gap-1">
            <native:text class="text-[22] font-bold text-white">{{ $playlist['name'] }}</native:text>
            <native:text class="text-[13] text-[#B3B3B3]">{{ $playlist['description'] }}</native:text>
            <native:row class="items-center gap-1 pt-1">
                <native:icon name="person" :size="14" color="#1DB954" />
                <native:text class="text-[12] text-[#B3B3B3]">{{ $playlist['creator'] }}</native:text>
                <native:text class="text-[12] text-[#B3B3B3]">· {{ $playlist['trackCount'] }} songs</native:text>
            </native:row>
        </native:column>

        {{-- Action Row --}}
        <native:row class="w-full px-4 py-3 items-center justify-between">
            <native:row class="items-center gap-4">
                <native:icon name="favorite_border" :size="24" color="#B3B3B3" />
                <native:icon name="download" :size="24" color="#B3B3B3" />
                <native:icon name="more_horiz" :size="24" color="#B3B3B3" />
            </native:row>
            <native:row class="items-center gap-3">
                <native:icon name="shuffle" :size="24" color="#1DB954" />
                <native:column @press="shufflePlay" class="w-[48] h-[48] rounded-full bg-[#1DB954] items-center justify-center">
                    <native:icon name="play_arrow" :size="28" color="#000000" />
                </native:column>
            </native:row>
        </native:row>

        {{-- Track List --}}
        <native:column class="w-full px-4 gap-0">
            @foreach ($tracksWithMeta as $trackIndex => $track)
                <native:row @press="playTrack({{ $trackIndex }})" class="w-full py-3 items-center gap-3">
                    <native:column class="w-[24] items-center">
                        <native:text class="text-[14] text-[#B3B3B3]">{{ $trackIndex + 1 }}</native:text>
                    </native:column>
                    <native:column class="w-[250] gap-1">
                        <native:text class="text-[15] text-white" :maxLines="1">{{ $track['title'] }}</native:text>
                        <native:text class="text-[12] text-[#B3B3B3]">{{ $track['artistName'] }} · {{ $track['playsFormatted'] }} plays</native:text>
                    </native:column>
                    <native:spacer />
                    <native:text class="text-[13] text-[#B3B3B3]">{{ $track['duration'] }}</native:text>
                    <native:icon name="more_vert" :size="18" color="#B3B3B3" />
                </native:row>
            @endforeach
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
