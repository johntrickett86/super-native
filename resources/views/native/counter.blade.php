<native:column class="w-full h-full items-center justify-center bg-white pt-[64] gap-4">
    <native:text class="text-[30] font-bold text-red-200">COUNTER</native:text>
    <native:text class="text-4xl font-bold text-orange-500">{{$count *7}}</native:text>
    <native:row class="gap-4 justify-center">
        <native:column @press="decrement" class="w-[100] h-[50] shadow-lg rounded-lg bg-blue-500" center>
            <native:text  class="text-center text-2xl text-white">👇</native:text>
        </native:column>
        <native:column @press="increment" class="w-[100] h-[50] shadow-lg rounded-lg bg-red-500" center>
            <native:text class="text-center font-bold text-2xl text-white">👆</native:text>
        </native:column>
    </native:row>
</native:column>
