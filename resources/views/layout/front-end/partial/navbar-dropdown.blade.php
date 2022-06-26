@foreach ($items as $item)

    @if(empty($item->children))
    <li>
        <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="our-project/1">{{$item->data->name}}</a>
    </li>

    @else
    <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200" href="our-project/1">{{$item->data->name}}</a>

    @include('layout.front-end.partial.navbar-dropdown', ['items' => $item->children])

    @endif
@endforeach
