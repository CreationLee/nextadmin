<ul class="nav navbar-nav">

@php

    if (AdminFacades::translatable($items)) {

        $items = $items->load('translations');
     }

@endphp

@foreach($items->sortBy('order') as $item)

    @php
        $originalitem = $item;
        if(AdminFacades::translatable($item)) {
            $item = $item->translate($options->locale);
        }



    @endphp

@endforeach

</ul>