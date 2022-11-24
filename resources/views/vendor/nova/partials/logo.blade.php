@php
$img = 'storage/' . nova_get_setting('logo', 'default_value');
@endphp
<div class="w-sidebar flex justify-center">
<a target="_self" href="/">
    <img class="w-16 h-16" src="/{{ $img }}" />
</a>
</div>
