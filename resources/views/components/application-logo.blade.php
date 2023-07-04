<a href="{{ url('/') }}" class="flex items-center">
  @switch(config('app.env'))
    @case('local')
      <span class="inline-block px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-500 rounded-full">LOCAL</span>
      @break
    @case('testing')
      <span class="inline-block px-2 py-1 text-xs font-bold leading-none text-yellow-100 bg-yellow-500 rounded-full">TESTING</span>
      @break
    @case('staging')
      <span class="inline-block px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-500 rounded-full">STAGING</span>
      @break
    @case('demo')
      <span class="inline-block px-2 py-1 text-xs font-bold leading-none text-blue-100 bg-blue-400 rounded-full">DEMO</span>
      @break
    @case('production')
      @break
    @default
      <span class="inline-block px-2 py-1 text-xs font-bold leading-none text-gray-100 bg-gray-700 rounded-full">UNKNOWN ENV</span>
  @endswitch
  <span class="app-name ml-1">{{ config('app.name', 'Laravel') }}</span>
</a>