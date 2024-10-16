<dropdown-trigger class="h-9 flex items-center">


    <strong class="relative inline-flex items-center rounded  border-gray-200 px-2.5 py-1.5 text-xs font-medium">
        @php
            $id = Auth::id();
            $wordlist = App\Models\Notification::where([['notifiable_id', $id], ['read_at', null]])->get();
            $count = $wordlist->count();
            //    $count=2
        @endphp
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
</dropdown-trigger>

<dropdown-menu slot="menu" width="318" direction="rtl">
    @php
        use Carbon\Carbon;
        $id = Auth::id();
        $notificationsArray = App\Models\Notification::where('notifiable_id', $id)
            ->latest()
            ->take(10)
            ->orderBy('created_at', 'ASC')
            ->with('user')
            ->get();
    @endphp
    <ul class="list-reset overflow-y-auto p-1">
        @foreach ($notificationsArray as $notificationArray)
            @php
                $dataNotifications = $notificationArray->data;
                // $newTimeShape = Carbon::createFromFormat('m/d/Y', $notification->created_at)->diffForHumans();
                $newTimeShape = date_format($notificationArray->created_at, 'm/d/Y');
                $result = Carbon::createFromFormat('m/d/Y', $newTimeShape)->diffForHumans();
                // $img='/storage/'. $notification->user->photo;
                $user = App\Models\user::find($dataNotifications['sender_id']);
                // dd($user->photo);
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
                // $img = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKVztexIh8wNm6hDjIwvVAQ73mfzMuWB6yqdviYpcyqQ&s';
            @endphp
            <li>
                <div
                    class="flex flex-row items-center justify-start px-4 w-full py-3 border-b hover:bg-gray-100  @if ($notificationArray->read_at == null) bg-[#f1fff1] @endif ">
                    <div class="basis-1/4">
                        <img class=" h-10 w-10 rounded-full object-cover mx-1" src=/{{ $img }} alt="avatar">
                    </div>
                    <a href="/Admin/notification" class="text-blue-500 hover:text-blue-700 underline-none">
                        <div class="flex basis-3/4 flex-col items-start justify-center">
                            <p class="text-sm mx-2 font-bold text-black py-1">
                                {{ $name }} ارسل لك إشعار جديد
                            </p>
                            <p class="text-sm mx-2 font-bold text-black">
                                {{ $dataNotifications['Notifications'] }}
                            </p>
                            <div class="w-full flex flex-row items-center justify-end">
                                <p class="font-Flatnormal text-xs text-center">{{ $result }}</p>
                            </div>
                        </div>
                    </a>

                </div>


            </li>
        @endforeach
        <li>
            <a href="/Admin/notification"
                class="btn btn-default btn-primary inline-flex items-center justify-center h-12 relative ml-auto my-3  py-2 w-full text-center">
                <span class="">
                    روية جميع الاشغارات </span>
            </a>
        </li>
    </ul>
</dropdown-menu>
<script type="application/javascript">
    var inverval_timer;

//Time in milliseconds [1 second = 1000 milliseconds ]
// inverval_timer = setInterval(function() {
//     var user = '{{ auth()->user()->name }}';
//     console.log(user);
// }, 5000);

//IF you want to stop above timer

</script>
