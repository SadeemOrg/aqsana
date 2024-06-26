@foreach ($items as $item)
    @if (empty($item->children) )
        <li>
            @if ($item->data->link->resource == 'App\Nova\project')
                <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200"
                    href="{{ route('getprojectDetail', ['id' => $item->data->link->id]) }}"
                    target="_self">{{ $item->data->name }}</a>
            @else
                @if ($itemName == 'الحصاد')
                    <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200"
                        href="{{ $item->data->link->id }}" target="_blank">{{ $item->data->name }}</a>
                @else
                @if( $item->data->external_link ==  true )
                <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200"
                href="{{ $item->data->link->id }}" >{{ $item->data->name }}</a>
                @else
                <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200"
                href="{{ $item->data->link->id }}" target="_self">{{ $item->data->name }}</a>
                @endif
                @endif
            @endif
        </li>
    @else
        @php
        @endphp
        <a class="py-2 border-b border-[#CCDDFF] block hover:bg-[#349A37] hover:text-white px-3 duration-200"
            href="{{ $item->data->link->id }}" target="_self">{{ $item->data->name }}</a>

        @include('layout.front-end.partial.navbar-dropdown', ['items' => $item->children])
    @endif
@endforeach
