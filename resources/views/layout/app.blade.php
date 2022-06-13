@php
  $id = Auth::id();
  $areas = DB::table('areas')->where('admin_id', $id)
  ->join('cities', 'cities.area_id', '=', 'areas.id')
  ->join('alhisalats', 'alhisalats.city_id', '=', 'cities.id')
  ->select('alhisalats.name')->get();
  $stack = array();
foreach ( $areas as $key => $value) {
    array_push($stack, $value->name);
    // echo $value->name;
}
// dd($stack);
$end= DB::table('alhisalats')->whereIn('name', $stack)


                        ->get();

dd($end);


            // ->join('areas', 'areas.admin_id', 'like',$id )

            // ->select('areas.name')
            // ->get();

            // $users = DB::table('users')  ->join('users', 'users.id', '=', 'areas.admin_id')
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            // ->select('users.*', 'contacts.phone', 'orders.price')
            // ->get();

// areas
            // cities
//   $id=1;
    //     $area = DB::table('areas')->where('admin_id', $id)->get();

    //    $ff= DB::table('alhisalats')->whereIn('city_id', $ids)->get();
    //             //   ->whereNotIn('id', $not_ids)
    //             //   ->where('status', 1)

    //     dd($ff);

//         $ids = [1,2,3,4];
// $not_ids = [5,6,7,8];
// DB::table('table')->whereIn('id', $ids)
//                   ->whereNotIn('id', $not_ids)
//                   ->where('status', 1)
//                   ->get();
    //     $user = Auth::user();
    //   if( $user  == 'admin' ){
    //     return $query->where('name', 'saed');
    //   }
    // return $query->where('city_id', 'saed');

@endphp

<!DOCTYPE html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    
    <style>
        @layer base {
            @font-face {
                font-family: "alfont_com_JF-Flat-Bold";
                font-weight: 700px;
                src: url('/public/assets/front-end/fonts/alfont_com_JF-Flat-Bold.ttf')
            }

            @font-face {
                font-family: "alfont_com_JF-Flat-regular";
                font-weight: 400px;
                src: url('/public/assets/front-end/fonts/alfont_com_JF-Flat-regular.ttf')
            }

            .font-FlatBold {
                font-family: 'alfont_com_JF-Flat-Bold' !important
            }
        }
    </style>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('assets/front-end/css/main.css') }}">    
</head>

<body dir="rtl">


    @include('layout.front-end.partial._header')
    @yield('content')
    @include('layout.front-end.partial._footer')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/front-end/js/main.js') }}"></script>
</body>
<!-- <script src="{{ mix('/js/app.js') }}"></script> -->
</html>
