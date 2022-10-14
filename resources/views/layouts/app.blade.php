<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta name="developer" content="flagstudio.ru">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    @isset($meta)
        <meta name="title" content="{{ $meta->title ?? '' }}">
        <meta name="description" content="{{ $meta->description ?? '' }}">
        <meta name="keywords" content="{{ $meta->keywords ?? '' }}">
    @endif

    <title>{{ isset($meta) ? $meta->tag_title : ''  }}</title>

    <link href="{!! mix('/css/components.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! mix('/css/app.css') !!}" rel="stylesheet" type="text/css">

    <!-- UIkit CSS -->
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/css/uikit.min.css" />--}}

{{--    <!-- UIkit JS -->--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit-icons.min.js"></script>--}}

    {{--    Tailwind ui--}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles
</head>
<body>

<div class="min-h-full bg-gray-100">
    <nav class="bg-white shadow-md z-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('main') }}">
                            <img class="h-16 w-16" src="{{ asset('images/flag_logo.svg') }}">
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            @include('parts.navigation.header-links', ['route' => 'main', 'title' => 'Dashboard'])
                            @include('parts.navigation.header-links', ['route' => 'search', 'title' => 'Search'])
                            @include('parts.navigation.header-links', ['route' => 'products', 'title' => 'Products'])
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            <div class="w-6 h-6 bg-white border rounded-full cursor-pointer absolute -top-2 -right-2 text-center bg-rose-400">
                                3
                            </div>
                        </div>
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button
                                    type="button"
                                    class="flex items-center h-12 w-12 rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 overflow-hidden"
                                    id="user-menu-button"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                >
                                    <img class="h-12 w-12" src="{{ asset('images/profile.jpg') }}" alt="">
                                </button>
                            </div>

                            <!--
                              Dropdown menu, show/hide based on menu state.

                              Entering: "transition ease-out duration-100"
                                From: "transform opacity-0 scale-95"
                                To: "transform opacity-100 scale-100"
                              Leaving: "transition ease-in duration-75"
                                From: "transform opacity-100 scale-100"
                                To: "transform opacity-0 scale-95"
                            -->
{{--                            <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">--}}
{{--                                <!-- Active: "bg-gray-100", Not Active: "" -->--}}
{{--                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>--}}

{{--                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>--}}

{{--                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header>
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-700">@yield('page_title')</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 pb-6">
            <div class="px-4 sm:px-0">
                <div class="rounded-lg border-4 border-dashed border-gray-200 mx-auto py-6 px-4">
                    @yield('content')
                    {{ $slot ?? null}}
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{!! mix('/js/check-support.js') !!}"></script>
<script src="{!! mix('/js/manifest.js') !!}"></script>
<script src="{!! mix('/js/vendor.js') !!}"></script>
<script src="{!! mix('/js/main.js') !!}"></script>

@livewireScripts
</body>
</html>
