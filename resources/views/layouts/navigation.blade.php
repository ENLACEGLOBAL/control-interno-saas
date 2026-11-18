<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-900">
                            <svg class="h-5 w-5 text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>
                            </svg>
                        </span>
                        <span class="hidden text-sm font-semibold tracking-tight text-slate-900 sm:block">{{ config('app.name', 'Control Interno') }}</span>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex h-full items-center border-b-2 px-3 py-2 text-sm font-medium leading-4 text-slate-500 transition hover:text-slate-900 focus:outline-none {{ request()->routeIs('areas.*', 'processes.*') ? 'border-cyan-500 text-slate-900' : 'border-transparent' }}">
                                    Estructura
                                    <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('areas.index')">Direcciones / Áreas</x-dropdown-link>
                                <x-dropdown-link :href="route('processes.index')">Mapa de Procesos</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex h-full items-center border-b-2 px-3 py-2 text-sm font-medium leading-4 text-slate-500 transition hover:text-slate-900 focus:outline-none {{ request()->is('matriz-calor*', 'risks*', 'controls*') ? 'border-cyan-500 text-slate-900' : 'border-transparent' }}">
                                    Riesgos
                                    <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="url('/matriz-calor')" class="font-semibold text-cyan-700 border-b border-slate-100">Matriz de Calor</x-dropdown-link>
                                <x-dropdown-link :href="route('risks.index')">Riesgos Identificados</x-dropdown-link>
                                <x-dropdown-link :href="route('controls.index')">Controles Mitigantes</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex h-full items-center border-b-2 border-transparent px-3 py-2 text-sm font-medium leading-4 text-slate-500 transition hover:text-slate-900 focus:outline-none">
                                    Auditoría
                                    <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="#">Consultas Generales</x-dropdown-link>
                                <x-dropdown-link href="#">Auditoría Avanzada</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    @if(Auth::user()->is_superadmin)
                    <div class="hidden sm:flex sm:items-center sm:ms-2">
                        <a href="{{ route('saas.dashboard') }}" class="inline-flex h-full items-center rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                            Panel SaaS
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="hidden space-x-4 sm:ms-6 sm:flex sm:items-center">
                <a href="{{ route('tenant-users.index') }}" class="text-slate-400 transition hover:text-slate-900" title="Gestión de Accesos">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </a>

                <div class="h-6 border-l border-slate-200"></div>

                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                            {{ session('tenant_name', 'Seleccionar Empresa') }}
                            <svg class="ms-1 h-3 w-3 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="block border-b border-slate-100 px-4 py-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            Entorno de Trabajo
                        </div>
                        @foreach (auth()->user()->tenants as $tenant)
                            <form method="POST" action="{{ route('tenant.switch') }}">
                                @csrf
                                <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                <x-dropdown-link :href="route('tenant.switch')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-sm">
                                    {{ $tenant->name }}
                                    @if(session('active_tenant_id') == $tenant->id)
                                        <span class="float-right font-bold text-emerald-500">✓</span>
                                    @endif
                                </x-dropdown-link>
                            </form>
                        @endforeach
                    </x-slot>
                </x-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-slate-500 transition hover:text-slate-900 focus:outline-none">
                            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="border-b border-slate-100 px-4 py-2">
                            <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs font-medium text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">Mi Perfil</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                                Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-b border-slate-200 bg-slate-50 sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Inicio</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('areas.index')" :active="request()->routeIs('areas.*')">Áreas</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('processes.index')" :active="request()->routeIs('processes.*')">Procesos</x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/matriz-calor')" :active="request()->is('matriz-calor*')">Matriz de Calor</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('risks.index')" :active="request()->routeIs('risks.*')">Riesgos</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('controls.index')" :active="request()->routeIs('controls.*')">Controles</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tenant-users.index')" :active="request()->routeIs('tenant-users.*')">Accesos</x-responsive-nav-link>
        </div>

        <div class="border-t border-slate-200 pb-1 pt-4">
            <div class="mb-2 px-4">
                <div class="text-base font-semibold text-slate-900">{{ Auth::user()->name }}</div>
                <div class="mt-1 inline-block rounded bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600">Empresa: {{ session('tenant_name') }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Mi Perfil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        Cerrar Sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
