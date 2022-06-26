@foreach ($items as $item)

    @if(empty($item['children']))
        @include('website.partials.navbar-dropdown-item', compact('item'))
    @else
    @include('website.partials.navbar-dropdown-item', compact('item'))
    @include('website.partials.navbar-dropdown', ['items' => $item['children']])
        <dropdown align="end" dropdown-style="-mt-2">
            <template #trigger>
                @include('website.partials.navbar-dropdown-item', compact('item'))
            </template>

            <template #content>
                <div class="py-1 z-10">
                    @include('website.partials.navbar-dropdown', ['items' => $item['children']])
                </div>
            </template>
        </dropdown>
    @endif
@endforeach
