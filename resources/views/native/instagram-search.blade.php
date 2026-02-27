<native:scroll-view class="w-full h-full bg-white">
    <native:column class="w-full gap-0 safe-area">

        {{-- Search Bar --}}
        <native:column class="w-full px-4 pt-3 pb-2">
            <native:row class="w-full bg-[#EFEFEF] rounded-lg px-3 py-2 items-center gap-2">
                <native:icon name="search" :size="20" color="#8E8E8E" />
                <native:text class="text-[15] text-[#8E8E8E]">Search</native:text>
            </native:row>
        </native:column>

        {{-- Category Chips --}}
        <native:scroll-view horizontal>
            <native:row class="gap-2 px-4 pb-3">
                @foreach (['IGTV', 'Travel', 'Architecture', 'Food', 'Art', 'Nature', 'Fitness', 'Style'] as $tag)
                    <native:chip label="{{ $tag }}" />
                @endforeach
            </native:row>
        </native:scroll-view>

        {{-- Explore Grid --}}
        <native:column class="w-full gap-1">
            @foreach (array_chunk($posts, 3) as $rowIndex => $row)
                @if ($rowIndex % 2 === 0)
                    {{-- Standard 3-column row --}}
                    <native:row class="w-full gap-1 justify-start">
                        @foreach ($row as $index => $post)
                            <native:column @press="viewPost({{ array_search($post, $posts) }})">
                                <native:image
                                    src="{{ $post['imageUrl'] }}"
                                    class="w-[125] h-[125]"
                                    :fit="2"
                                />
                            </native:column>
                        @endforeach
                    </native:row>
                @else
                    {{-- Featured layout: 1 large + 2 stacked --}}
                    <native:row class="w-full gap-1 justify-start">
                        @if (isset($row[0]))
                            <native:column @press="viewPost({{ array_search($row[0], $posts) }})">
                                <native:image
                                    src="{{ $row[0]['imageUrl'] }}"
                                    class="w-[250] h-[251]"
                                    :fit="2"
                                />
                            </native:column>
                        @endif
                        <native:column class="gap-1">
                            @if (isset($row[1]))
                                <native:column @press="viewPost({{ array_search($row[1], $posts) }})">
                                    <native:image
                                        src="{{ $row[1]['imageUrl'] }}"
                                        class="w-[125] h-[125]"
                                        :fit="2"
                                    />
                                </native:column>
                            @endif
                            @if (isset($row[2]))
                                <native:column @press="viewPost({{ array_search($row[2], $posts) }})">
                                    <native:image
                                        src="{{ $row[2]['imageUrl'] }}"
                                        class="w-[125] h-[125]"
                                        :fit="2"
                                    />
                                </native:column>
                            @endif
                        </native:column>
                    </native:row>
                @endif
            @endforeach
        </native:column>

        <native:spacer class="h-[20]" />

    </native:column>
</native:scroll-view>
