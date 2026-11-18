<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group transition-transform hover:scale-105">
                        <x-application-logo class="block h-9 w-auto fill-current text-indigo-600" />
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex">
                    
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        🏠 {{ __('Inicio') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-4">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 h-full border-b-2 {{ request()->routeIs('areas.*', 'processes.*') ? 'border-indigo-400 text-gray-900' : 'border-transparent' }}">
                                    🏢 Estructura
                                    <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('areas.index')">📍 Direcciones / Áreas</x-dropdown-link>
                                <x-dropdown-link :href="route('processes.index')">⚙️ Mapa de Procesos</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 h-full border-b-2 {{ request()->is('matriz-calor*', 'risks*', 'controls*') ? 'border-indigo-400 text-gray-900' : 'border-transparent' }}">
                                    ⚖️ Riesgos
                                    <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="url('/matriz-calor')" class="font-bold text-indigo-600 border-b border-gray-100">🗺️ Matriz de Calor</x-dropdown-link>
                                <x-dropdown-link :href="route('risks.index')">🔥 Riesgos Identificados</x-dropdown-link>
                                <x-dropdown-link :href="route('controls.index')">🛡️ Controles Mitigantes</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 h-full border-b-2 border-transparent">
                                    🔍 Auditoría
                                    <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#">📋 Consultas Generales</x-dropdown-link>
                                <x-dropdown-link href="#">📊 Auditoría Avanzada</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @if(Auth::user()->is_superadmin)
                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <a href="{{ route('saas.dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-black text-amber-700 bg-amber-50 hover:bg-amber-100 hover:text-amber-900 focus:outline-none transition ease-in-out duration-150 h-full border border-amber-200 rounded shadow-sm">
                            👑 Panel SaaS
                        </a>
                    </div>
                    @endif

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                
                <a href="{{ route('tenant-users.index') }}" class="text-gray-400 hover:text-indigo-600 transition-colors" title="Gestión de Accesos">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </a>

                <div class="h-6 border-l border-gray-200"></div> <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-indigo-200 text-xs font-bold rounded-full text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition ease-in-out duration-150">
                            🏢 {{ session('tenant_name', 'Seleccionar Empresa') }}
                            <svg class="fill-current h-3 w-3 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="block px-4 py-2 text-[10px] font-black uppercase tracking-wider text-gray-400 border-b border-gray-100">
                            Entorno de Trabajo
                        </div>
                        @foreach (auth()->user()->tenants as $tenant)
                            <form method="POST" action="{{ route('tenant.switch') }}">
                                @csrf
                                <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                <x-dropdown-link :href="route('tenant.switch')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-sm">
                                    {{ $tenant->name }}
                                    @if(session('active_tenant_id') == $tenant->id)
                                        <span class="float-right text-emerald-500 font-bold">✓</span>
                                    @endif
                                </x-dropdown-link>
                            </form>
                        @endforeach
                    </x-slot>
                </x-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                            <div class="h-8 w-8 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold text-xs mr-2">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs font-medium text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">👤 Mi Perfil</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                🚪 Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">🏠 Inicio</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('areas.index')" :active="request()->routeIs('areas.*')">🏢 Áreas</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('processes.index')" :active="request()->routeIs('processes.*')">⚙️ Procesos</x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/matriz-calor')" :active="request()->is('matriz-calor*')">🗺️ Matriz de Calor</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('risks.index')" :active="request()->routeIs('risks.*')">🔥 Riesgos</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('controls.index')" :active="request()->routeIs('controls.*')">🛡️ Controles</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tenant-users.index')" :active="request()->routeIs('tenant-users.*')">👥 Accesos</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 mb-2">
                <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-xs text-indigo-600 bg-indigo-100 px-2 py-0.5 rounded inline-block mt-1">Empresa: {{ session('tenant_name') }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">👤 Mi Perfil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        🚪 Cerrar Sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>