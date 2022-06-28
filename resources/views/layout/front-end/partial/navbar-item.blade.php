
    @if (empty($item->children))

    <li class="nav-item relative">
        <a class=" w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"  href="{{ $item->data->link->id }}">{{$item->data->name}}</a>
    </li>



    @else

    <li class="nav-item relative"  >
        <a   class="stop-link w-[250px] xl:w-auto mb-3 xl:mb-0 xl:hover:text-[#349A37] bg-[#349A37] xl:bg-transparent text-white xl:text-[#000] block py-3 px-4 xl:py-0 xl:px-0  xl:inline-block relative xl:static"   href=""> {{$item->data->name}}</a>

    <div class="dropdown-menu drop-shadow-lg bg-white rounded-[5px] right-[110%] xl:right-[0] top-[100%]">
        <ul>



    @include('layout.front-end.partial.navbar-dropdown', ['items' => $item->children])
</ul>
</div>
</li>
    @endif
