@php
    $user = Auth::user();
    $unread = $user->unreadNotifications;
@endphp

<header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-3 px-4 sm:px-6 lg:px-8">
        {{-- Abrir menú (móvil) --}}
        <button type="button" class="-ml-1 rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900 lg:hidden"
                @click="sidebarOpen = true" aria-label="Abrir menú">
            <x-icon name="menu" />
        </button>

        {{-- Migas de pan: siempre indican dónde está el usuario --}}
        <nav aria-label="Ruta de navegación" class="min-w-0 flex-1">
            <ol class="flex items-center gap-1.5 text-sm">
                @foreach ($crumbs as $i => $crumb)
                    @php $isLast = $loop->last; @endphp
                    <li class="flex min-w-0 items-center gap-1.5 {{ ! $isLast && ! $loop->first ? 'hidden sm:flex' : '' }}">
                        @unless ($loop->first)
                            <x-icon name="chevron" class="h-3.5 w-3.5 text-slate-300" stroke="2" />
                        @endunless
                        @if ($loop->first)
                            <a href="{{ $crumb['url'] }}" class="flex items-center gap-1.5 rounded-md text-slate-400 transition hover:text-slate-900" @if($isLast) aria-current="page" @endif>
                                <x-icon name="home" class="h-4 w-4" />
                                <span class="{{ $isLast ? 'font-semibold text-slate-900' : 'sr-only' }}">{{ $crumb['label'] }}</span>
                            </a>
                        @elseif ($isLast)
                            <span class="truncate font-semibold text-slate-900" aria-current="page">{{ $crumb['label'] }}</span>
                        @elseif ($crumb['url'])
                            <a href="{{ $crumb['url'] }}" class="truncate text-slate-500 transition hover:text-slate-900">{{ $crumb['label'] }}</a>
                        @else
                            <span class="truncate text-slate-400">{{ $crumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <div class="flex items-center gap-1.5">
            {{-- Notificaciones --}}
            <x-dropdown align="right" width="w-80">
                <x-slot name="trigger">
                    <button type="button" class="relative rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-900" aria-label="Notificaciones ({{ $unread->count() }} sin leer)">
                        <x-icon name="bell" />
                        @if ($unread->count() > 0)
                            <span class="absolute right-1 top-1 flex h-4 min-w-4 items-center justify-center rounded-full bg-cyan-500 px-1 text-[10px] font-bold leading-none text-white ring-2 ring-white">
                                {{ $unread->count() > 9 ? '9+' : $unread->count() }}
                            </span>
                        @endif
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
                        <p class="text-sm font-semibold text-slate-900">Notificaciones</p>
                        @if ($unread->count() > 0)
                            <form method="POST" action="{{ route('notifications.read') }}">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-cyan-700 hover:text-cyan-900">Marcar como leídas</button>
                            </form>
                        @endif
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        @forelse ($unread as $notification)
                            <div class="flex gap-3 border-b border-slate-50 px-4 py-3 last:border-0">
                                <span class="text-base leading-5">{{ $notification->data['icono'] ?? '🔔' }}</span>
                                <div class="min-w-0">
                                    <p class="text-sm text-slate-700">{{ $notification->data['mensaje'] ?? 'Nueva notificación' }}</p>
                                    <p class="mt-0.5 text-[11px] font-medium text-slate-400">{{ $notification->data['fecha'] ?? $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center px-4 py-8 text-center">
                                <span class="mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                    <x-icon name="check" stroke="2" />
                                </span>
                                <p class="text-sm font-medium text-slate-700">Estás al día</p>
                                <p class="text-xs text-slate-400">No tienes notificaciones pendientes.</p>
                            </div>
                        @endforelse
                    </div>
                </x-slot>
            </x-dropdown>

            <div class="mx-1 hidden h-6 w-px bg-slate-200 sm:block"></div>

            {{-- Menú de usuario --}}
            <x-dropdown align="right" width="w-60">
                <x-slot name="trigger">
                    <button type="button" class="flex items-center gap-2 rounded-full py-1 pl-1 pr-2 transition hover:bg-slate-100" aria-label="Menú de usuario">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">
                            {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                        </span>
                        <span class="hidden max-w-[10rem] truncate text-sm font-medium text-slate-700 md:block">{{ $user->name }}</span>
                        <x-icon name="chevron" class="hidden h-3.5 w-3.5 rotate-90 text-slate-400 md:block" stroke="2" />
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="border-b border-slate-100 px-4 py-3">
                        <p class="truncate text-sm font-semibold text-slate-900">{{ $user->name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                        @if (session('tenant_name'))
                            <p class="mt-2 inline-flex max-w-full items-center gap-1 truncate rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-600">
                                <x-icon name="building" class="h-3 w-3" /> {{ session('tenant_name') }}
                            </p>
                        @endif
                    </div>
                    <div class="p-1">
                        <x-dropdown-link :href="route('profile.edit')">
                            <x-icon name="user" class="h-4 w-4 text-slate-400" /> Mi perfil
                        </x-dropdown-link>
                        @if ($user->is_superadmin)
                            <x-dropdown-link :href="route('saas.dashboard')">
                                <x-icon name="crown" class="h-4 w-4 text-amber-500" /> Panel SaaS
                            </x-dropdown-link>
                        @endif
                    </div>
                    <div class="border-t border-slate-100 p-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm text-red-600 transition hover:bg-red-50">
                                <x-icon name="logout" class="h-4 w-4" /> Cerrar sesión
                            </button>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
