<native:scroll-view class="w-full h-full bg-[#121212]">
    <native:column class="w-full gap-0 safe-area">

        {{-- Top Bar --}}
        <native:row class="w-full px-4 pt-4 pb-2 items-center">
            <native:row class="items-center gap-3">
                <native:column @press="back" class="w-[32] h-[32] items-center justify-center">
                    <native:icon name="arrow_back" :size="24" color="#FFFFFF" />
                </native:column>
                <native:text class="text-[22] font-bold text-white">Search</native:text>
            </native:row>
        </native:row>

        {{-- Search Bar --}}
        <native:column class="w-full px-4 pt-2 pb-4">
            <native:row class="w-full bg-white rounded-lg px-3 py-3 items-center gap-2">
                <native:icon name="search" :size="22" color="#121212" />
                <native:text class="text-[15] text-[#121212] font-semibold">What do you want to listen to?</native:text>
            </native:row>
        </native:column>

        {{-- Top Genres --}}
        <native:column class="w-full px-4 pb-2">
            <native:text class="text-[16] font-bold text-white">Browse all</native:text>
        </native:column>

        <native:column class="w-full px-4 gap-2 pb-4">
            @foreach (array_chunk(array_keys($genres), 2) as $row)
                <native:row class="w-full gap-2">
                    @foreach ($row as $genreName)
                        <native:column class="w-[170] h-[90] rounded-lg px-3 pt-3 bg-[{{ $genres[$genreName] }}]">
                            <native:text class="text-[16] font-bold text-white">{{ $genreName }}</native:text>
                        </native:column>
                    @endforeach
                </native:row>
            @endforeach
        </native:column>

        {{-- Top Results / Popular --}}
        <native:column class="w-full px-4 pt-2 pb-2">
            <native:text class="text-[16] font-bold text-white">Popular playlists</native:text>
        </native:column>

        <native:scroll-view horizontal>
            <native:row class="gap-3 px-4 pb-4">
                @foreach (array_slice($playlists, 0, 4) as $pIndex => $playlist)
                    <native:column @press="viewPlaylist({{ $pIndex }})" class="w-[140] gap-2">
                        <native:image
                            src="{{ $playlist['coverUrl'] }}"
                            class="w-[140] h-[140] rounded"
                            :fit="2"
                        />
                        <native:text class="text-[12] text-[#B3B3B3]" :maxLines="2">{{ $playlist['name'] }}</native:text>
                    </native:column>
                @endforeach
            </native:row>
        </native:scroll-view>

        {{-- Popular Artists --}}
        <native:column class="w-full px-4 pt-2 pb-2">
            <native:text class="text-[16] font-bold text-white">Popular artists</native:text>
        </native:column>

        <native:column class="w-full px-4 gap-0 pb-4">
            @foreach (array_slice($artists, 0, 4) as $aIndex => $artist)
                <native:row @press="viewArtist({{ $aIndex }})" class="w-full py-2 items-center gap-3">
                    <native:image
                        src="{{ $artist['imageUrl'] }}"
                        class="w-[48] h-[48] rounded-full"
                        :fit="2"
                    />
                    <native:column>
                        <native:text class="text-[14] text-white font-semibold">{{ $artist['name'] }}</native:text>
                        <native:text class="text-[12] text-[#B3B3B3]">Artist · {{ $artist['genre'] }}</native:text>
                    </native:column>
                </native:row>
            @endforeach
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
