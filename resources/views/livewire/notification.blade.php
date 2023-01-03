
<div wire:poll.1000ms class="flex ">

    <div x-data="{ dropdownOpen: false }" class="relative ">

        <button @click="dropdownOpen = !dropdownOpen"
            class=" -top-1.5  relative z-10 block rounded-md bg-white p-2 focus:outline-none">
            <strong class="relative inline-flex items-center rounded  border-gray-200 px-2.5 py-1.5 text-xs font-medium">
                @if (!$count == 0)
                    <span
                        class="text-white absolute -top-1 -right-0 h-5 w-5 rounded-full bg-red-600 flex justify-center items-center items">
                        <span>{{ $count }}</span></span>
                @endif


                <svg class=" ml-1.5  h-7 w-7 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
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
    <script src="{{ asset('assets/js/push.min.js') }}"></script>
<script>
    const iconPath = '{{ asset('alaqsa.PNG') }}';
</script>
@if (!$receiveNotificationcount == 0)

    @foreach ($receiveNotification as $notification)
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
                timeout: bonotificationsArraycountol * 5000,
                icon: iconPath
            });
        </script>
    @endforeach
@endif
</div>
{{--
 --}}
