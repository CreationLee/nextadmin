<ul class="nav navbar-nav">

@php

    if (AdminFacades::translatable($items)) {

       $items = $items->load('translations');
     }

@endphp

@foreach($items->sortBy('order') as $item)

    @php
        $originalItem = $item;

        if(AdminFacades::translatable($item)) {
            $item = $item->translate($options->locale);
        }

    $listItemClass = [];
    $styles = null;
    $linkAttributes = null;

    if(url($item->link()) == url()->current())
    {
        array_push($listItemClass,'active');
    }


    //子菜单
    if(!$originalItem->children->isEmpty())
    {
        foreach($originalItem->children as $children)
        {
            if(url($children->link()) == url()->current())
            {
                array_push($listItemClass,'active');
            }
        }
        $linkAttributes = 'href="#' . str_slug($item->title, '-') . '-dropdown-element" data-toggle="collapse" aria-expanded="'. (in_array('active', $listItemClass) ? 'true' : 'false').'"';
        array_push($listItemClass,'dropdown');
    }
    else
    {
        $linkAttributes =  'href="' . url($item->link()) .'"';
    }

    //TODO check the auto-generated form permissions


    @endphp

    <li class="{{ implode("",$listItemClass) }}">
        <a {!! $linkAttributes !!} target="{{ $item->target }}">
            <span class="icon {{ $item->icon_class }} " ></span>
            <span class="title">{{ $item->title }}</span>
        </a>
        @if(!$originalItem->children->isEmpty())
        <div id="{{ str_slug($originalItem->title, '-') }}-dropdown-element" class="panel-collapse collapse {{ (in_array('active', $listItemClass) ? 'in' : '') }}">
            <div class="panel-body">
                @include('admin.menu.admin_menu', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
            </div>
        </div>
        @endif
    </li>
@endforeach

</ul>