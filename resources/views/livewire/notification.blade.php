@php

    use Carbon\Carbon;
    use App\Models\User;
@endphp
<div class="flex " wire:poll>

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
        <div x-show="dropdownOpen"
            class="absolute left-[-8%] mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20 max-h-[470px] overflow-y-auto"
            style="width:20rem;">
            @if (count($notificationsArray) !== 0)
                <div class="">
                    @foreach ($notificationsArray as $notification)
                        @php
                            $dataNotifications = $notification->data;
                            // $newTimeShape = Carbon::createFromFormat('m/d/Y', $notification->created_at)->diffForHumans();
                            $newTimeShape = date_format($notification->created_at, 'm/d/Y');
                            $result = Carbon::createFromFormat('m/d/Y', $newTimeShape)->diffForHumans();
                            // $img='/storage/'. $notification->user->photo;
                            $user = user::find($dataNotifications['sender_id']);

                            if (isset($user->photo)) {
                                $img = 'storage/' . $user->photo;
                            } else {
                                $img =
                                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKVztexIh8wNm6hDjIwvVAQ73mfzMuWB6yqdviYpcyqQ&s';
                            }

                            if (isset($user->name)) {
                                $name = $user->name;
                            } else {
                                $name = '--';
                            }
                            // dd($img);
                        @endphp
                        <a href="/Admin/notification">
                            <div
                                class="flex flex-row items-center justify-start px-4 w-full py-3 border-b border-2 hover:bg-gray-100  @if ($notification->read_at == null) bg-[#f1fff1] @endif ">
                                <div class="basis-1/4">
                                    <img class=" h-10 w-10 rounded-full object-cover mx-1" src=/{{ $img }}
                                        alt="avatar">
                                </div>

                                <div class="flex basis-3/4 flex-col items-start justify-center">
                                    <p class=" text-sm mx-2 font-bold text-black py-1">
                                        {{ $name }} ارسل لك إشعار جديد
                                    </p>
                                    <p class=" text-sm mx-2 font-bold text-black">
                                        {{ $dataNotifications['Notifications'] }}
                                    </p>
                                    <div class="w-full flex flex-row items-center justify-end">
                                        <p class="font-Flatnormal text-xs text-center">{{ $result }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
                <div class="p-3">
                    <a href="/Admin/notification"
                        class="block bg-[#349A37] hover:bg-[#40b744] text-white text-center flex items-center justify-center h-10 rounded-lg">
                        <span>روية جميع الاشغارات</span>
                    </a>
                </div>
            @else
                <div class="flex flex-row items-center justify-center py-2 min-h-[150px] text-center border-[1px]">
                    <p>
                        لا يوجد لديك اي اشعارات
                    </p>
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
                $dataNotifications = $notification->data;
            @endphp

            <script>
                var notificationsArraycount = {!! json_encode($notificationsArraycount) !!};
                var bool = {!! json_encode($dataNotifications['Notifications']) !!};
                Push.create("Al-Aqsa Association", {
                    body: bool,
                    timeout: notificationsArraycount * 5000,
                    icon: iconPath
                });
            </script>
        @endforeach
    @endif
</div>
{{--
 --}}
