{{-- Header navbar start --}}
<header id='navbar'
    class="bg-white sticky top-0 z-50 transition-shadow duration-300 md:backdrop-blur-sm md:bg-white/30">
    <nav class="px-4 lg:px-6 py-2.5">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3">
                <img src="{{ asset('assets/assets_logo.svg') }}" class="w-[122px] h-[29px]" alt="Assets Logo">
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-400 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 md:hover:text-assets">
                    <li>
                        <a href="{{ route('home') }}" aria-current="page"
                            class="block py-2 px-3 text-l {{ request()->routeIs('home') ? 'text-assets font-bold' : 'text-gray-400' }} hover:text-second_a ">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between py-2 px-3 {{ request()->routeIs('kabinet.show') ? 'text-assets font-bold' : 'text-gray-400' }} hover:text-second_a">
                            Kabinet
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal bg-white divide-y rounded-lg shadow w-44 ">
                            <ul class="py-2 text-sm text-gray-400" aria-labelledby="dropdownLargeButton">
                                @foreach ($dataKabinet as $index => $kabinet)
                                    <li>
                                        <a href="{{ route('kabinet.show', $kabinet->id_kabinet) }}"
                                            class="block px-4 py-2 hover:text-second_a text-assets">
                                            {{ $kabinet->nama_kabinet }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    {{-- <li>
                        <a href="{{ route('artikel') }}"
                            class="block py-2 px-3 {{ request()->routeIs('artikel') ? 'text-assets font-bold' : 'text-gray-400' }} hover:text-second_a text-l">
                            Artikel
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('about') }}"
                            class="block py-2 px-3 {{ request()->routeIs('about') ? 'text-assets font-bold' : 'text-gray-400' }} hover:text-second_a text-l">
                            Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vote.result') }}"
                            class="block py-2 px-3 text-white text-l bg-assets py-1 px-2 rounded-md">
                            Voting
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
{{-- Header navbar ends --}}
