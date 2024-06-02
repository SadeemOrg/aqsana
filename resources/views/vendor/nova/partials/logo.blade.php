@php
$img = 'storage/' . nova_get_setting('logo', 'default_value');
@endphp
<div class="flex justify-center">
<a target="_self" href="/">
    <img class="w-20 h-20 " src="/{{ $img }}" />
</a>
</div>
