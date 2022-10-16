
{{-- @extends('layout.app', ['hasHeader' => false, 'hasFooter' => false])
@section('content')

@php
use App\Models\Book;
 $Books = Book::all();
@endphp
    @livewire('type', ['Books' => $Books])


    @livewireScripts
</body>
</html>
@endsection --}}
@php
    // dd($books);
@endphp
<div class="bg-[#F2FFF285] py-8 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative xl:mt-8 mb-7 lg:mb-0">
            <p class="font-FlatBold text-3xl text-center xl:text-right"> المكتبة </p>
            <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
        </div>
        <!--Search and Book Type -->
        <div class="relative mt-7 flex sm:flex-row flex-col items-center justify-end gap-y-2 sm:gap-y-0 gap-x-2">
            <div class="mt-1 w-60 ">
                <input type="searchLibrary" name="searchLibrary" id="searchLibrary"
                    class="block w-full search-bar rounded-md border-[1px] text-[16px] border-gray-300 py-4 shadow-sm focus:border-[#349A37] px-4 focus:outline-none focus:ring-[#349A37]  "
                    placeholder="ابحث الان...">
                <div id="librarySearchListId"
                    class="card absolute bg-green-50 search-card z-10 my-2 min-h-[50px] h-auto max-h-40 overflow-y-visible  sm:w-[485px] w-60 top-[100%] sm:top-[90%] sm:left-[0%] rounded shadow hidden">
                    <div class="card-body p-3 w-full text-center search-result-box flex flex-col items-start justify-start gap-x-2 gap-y-3"
                        style="">
                    </div>
                </div>
            </div>
            @if (count($book_type))
                <div class="selectdiv w-60 flex flex-row justify-between items-center relative">
                    <select pla  wire:model="goal" name="goal"
                    class="mt-1 text-[16px] text-[#8F9BB3] block w-full rounded-md border-gray-300 py-4 pl-3 px-4 text-base focus:border-[#349A37] focus:outline-none focus:ring-[#349A37] ">
                    <option value="">تصنيفات المكتبة</option>
                    <option value="0">all</option>
                    @foreach($book_type as $type)
                    <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                    @endforeach
                </select>
                </div>
            @else
                <></>
            @endif

        </div>
        @if (empty($books[0]))
            <p class="text-[24px] text-center text-black font-FlatBold w-full pt-16 pl-4">لا يوجد اي
                <span class="text-[#349A37]">كتب </span>
                للعرض
            </p>
        @endif
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-x-8 gap-y-6 text-center lg:text-right">
            <!--first card -->
            @if (!empty($books))
                @foreach ($books as $book)
                    @php
                        $img = 'storage/' . $book['cover_photo'];
                    @endphp
                    <div onclick="location.href='{{ route('libraryDetail', ['id' => $book->id]) }}'"
                        class="p-3 bg-white Card_shadow mt-4 lg:mt-16 relative inline-block iphone13:flex sm:inline-block lg:flex flex-col items-center justify-start rounded-[5px]">
                        <div class="absolute leftline"></div>
                        <div class="bg-[#E4FFE585] rounded-[5px] py-3 px-4 max-h-[432px] h-full w-full">
                            <div class="">
                                <img src="{{ asset($img) }}" alt="people_on_Mousq"
                                    class="lg:w-[360px] w-full aspect-auto  sm:h-72 max-h-72 rounded-[5px]">
                                <p class="text-[#349A37] text-[22px] pt-4 text-center max-w-none pl-4 ">
                                    {{ Illuminate\Support\Str::limit($book['name'], 113) }}
                                </p>
                                <p
                                    class="text-[20px] block sm:hidden md:block text-[#101426] font-noto_Regular pl-4 pt-2 text-center slider-paragraph">
                                    {{ $book['author'] }}
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
