@props(['active' => false])

<a {{ $attributes->merge(['class' => 
    $active 
        ? 'text-white lg:bg-transparent dark:text-white block py-2 pr-4 pl-3 rounded lg:p-0'
        : 'block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:opacity-50 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:opacity-100 lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700'
    ]) }}
    aria-current="{{ $active ? 'page' : false }}">
    {{ $slot }}
</a>