@php
    $menu = bootstrap()->getHorizontalMenu();
    \App\Core\Adapters\Menu::filterMenuPermissions($menu->items);
@endphp

