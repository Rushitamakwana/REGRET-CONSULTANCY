<div class="rounded-xl overflow-hidden border border-transparent hover:border-[#03adce] transition-all duration-300">
  <div id="header{{$index}}" onclick="toggleAccordion({{$index}})" class="bg-[#00181d] rounded-xl px-5 sm:px-8 py-4 sm:py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6 transition-all duration-300 cursor-pointer">
    <div class="flex flex-col gap-2">
      <span class="text-[#03adce] font-semibold text-sm sm:text-base">{{ $career->title }}</span>
      <div class="flex items-center gap-3 sm:gap-4 flex-wrap">
        <span class="border border-gray-600 text-white text-xs px-3 py-1 rounded-full">
          @switch($career->type)
            @case('full_time') Full-time @break
            @case('part_time') Part-time @break
            @case('remote') Remote @break
            @case('hybrid') Hybrid @break
            @case('contract') Contract @break
            @default Type @endswitch
        </span>
        <span class="flex items-center gap-1 text-white text-xs opacity-70">
          <i class="fa-solid fa-location-dot text-[#03adce] text-xs"></i>
          {{ $career->location ?? 'Ahmedabad/Remote' }}
        </span>
      </div>
    </div>
    <div class="flex items-center gap-3 self-end sm:self-auto">
      <span class="text-white text-xs sm:text-sm opacity-80 whitespace-nowrap">View Details</span>
      <div class="w-8 h-8 rounded-full border border-gray-600 flex items-center justify-center flex-shrink-0">
        <i id="arrow{{$index}}" class="fa-solid fa-chevron-down text-white text-xs transition-transform duration-300"></i>
      </div>
    </div>
  </div>
  <div id="accordion{{$index}}" class="grid grid-rows-[0fr] transition-all duration-500 ease-in-out">
    <div class="overflow-hidden bg-[#00181d] px-5 sm:px-8 rounded-b-xl">
      <div class="py-5">
        <h4 class="text-white font-semibold mb-2">Role Overview</h4>
        <p class="text-gray-300 text-sm mb-3">{{ $career->details }}</p>
      </div>
    </div>
  </div>
</div>
