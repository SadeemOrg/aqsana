{{-- wire:poll.75ms --}}
{{-- <script src="{{ asset('assets/js/push.min.js') }}"></script>
<script>
    const iconPath = '{{ asset('alaqsa.PNG') }}';
</script>
@if (!$count == 0)

    @foreach ($notificationsArray as $notification)
        @php
          $notificationsArraycount = $notificationsArray->count();
            $dataNotifications = json_decode($notification->data);
        @endphp

        <script>
            var bool = {!! json_encode($dataNotifications->Notifications) !!};
            var bonotificationsArraycountol = {!! json_encode($notificationsArraycount) !!};
            // toastr.error(bool);

            // Loading button plugin (removed from BS4)

            Push.create("Al-Aqsa Association", {
                body: bool,
                timeout: bonotificationsArraycountol*5000,
                icon: iconPath
            });
        </script>
    @endforeach
@endif --}}
<div wire:poll.75ms class="flex ">


    <div x-data="{ dropdownOpen: false }" class="relative ">

        <button @click="dropdownOpen = !dropdownOpen"
            class=" -top-1.5  relative z-10 block rounded-md bg-white p-2 focus:outline-none">
            <strong class="relative inline-flex items-center rounded  border-gray-200 px-2.5 py-1.5 text-xs font-medium">
                @if (!$count == 0)
                    <span
                        class="text-white absolute -top-1 -right-0 h-5 w-5 rounded-full bg-red-600 flex justify-center items-center items">
                        <span>{{ $count }}</span></span>
                @endif
                <svg class=" ml-1.5  h-7 w-7" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.4346 19.3279C23.3999 19.3279 23.3679 19.3333 23.3333 19.3333C17.4519 19.3333 12.6667 14.5481 12.6667 8.66675C12.6667 6.35596 13.4133 4.22144 14.6667 2.47192V1.33325C14.6667 0.595947 14.0693 0 13.3333 0C12.5974 0 12 0.595947 12 1.33325V2.77344C7.48389 3.42407 4 7.30811 4 12V15.7173C4 18.356 2.84399 20.8467 0.815918 22.5613C0.297363 23.0054 0 23.6506 0 24.3333C0 25.6201 1.04663 26.6667 2.33325 26.6667H24.3333C25.6201 26.6667 26.6667 25.6201 26.6667 24.3333C26.6667 23.6506 26.3694 23.0054 25.8374 22.5508C24.7866 21.6614 23.9761 20.5547 23.4346 19.3279Z" fill="#101426"/>
                    </svg>


            </strong>
        </button>

        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

        <div x-show="dropdownOpen" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20"
            style="width:20rem;">
            @if ($notificationsArray)


                <div class="">

                    @foreach ($notificationsArray as $notification)
                        @php
                            $dataNotifications = json_decode($notification->data);
                            // $img='/storage/'. $notification->user->photo;
                            $img = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKVztexIh8wNm6hDjIwvVAQ73mfzMuWB6yqdviYpcyqQ&s';
                            // dd($img );
                        @endphp


                        <a href=""
                            class="flex justify-end   px-4 py-3 border-b hover:bg-gray-100  @if ($notification->read_at == null) bg-indigo-300 @endif ">
                            <div>
                                <p class="text-gray-600 text-sm mx-2">
                                    <span class="font-bold text-black">{{ $dataNotifications->Notifications }}</span>
                                    <br>
                                    <span>{{ $notification->created_at }} </span>
                                    <br>

                                </p>
                            </div>
                            <div class="flex">

                                {{-- <span class="font-bold" href="#">{{ $notification->user->name }}</span> --}}
                                <img class="h-8 w-8 rounded-full object-cover mx-1" src={{ $img }}
                                    alt="avatar">
                            </div>

                        </a>
                    @endforeach

                </div>
                <a href="/Admin/notification" class="block bg-gray-800 text-white text-center font-bold">See all
                    notifications</a>
            @else
                <div class="py-2 text-black">

                    no not

                </div>

            @endif
        </div>
    </div>
</div>
