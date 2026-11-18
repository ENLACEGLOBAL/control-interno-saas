@php
    $user = Auth::user();
    $context = app(\App\Services\TenantContext::class);
    $activeTenant = $context->getTenant();
    $tenants = $user->tenants ?? collect();
@endphp

<div class="relative flex h-full flex-col overflow-hidden bg-slate-900 text-slate-300">
    {{-- Fondo con el mismo corte visual del login --}}
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(600px 380px at 0% -10%, rgba(56,189,248,.16), transparent 60%),
            radial-gradient(500px 420px at 110% 105%, rgba(99,102,241,.20), transparent 60%),
            linear-gradient(170deg, #0b1220 0%, #0f172a 60%, #111827 100%);"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.05]"
         style="background-image:linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 42px 42px;"></div>

    <div class="relative z-10 flex h-full flex-col">
        {{-- Marca --}}
        <div class="flex h-16 shrink-0 items-center justify-between px-5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/60">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/20">
                    <x-icon name="shield" class="h-5 w-5 text-cyan-300" stroke="2" />
                </span>
                <span class="text-[15px] font-semibold tracking-tight text-white">{{ config('app.name', 'Control Interno') }}</span>
            </a>
            <button type="button" class="rounded-lg p-1.5 text-slate-400 transition hover:bg-white/10 hover:text-white lg:hidden" @click="sidebarOpen = false" aria-label="Cerrar menú">
                <x-icon name="x" />
            </button>
        </div>

        {{-- Selector de empresa --}}
        <div class="px-4 pb-4" x-data="{ open: false }" @click.outside="open = false">
            <button type="button" @click="open = !open" :aria-expanded="open"
                    class="flex w-full items-center gap-3 rounded-xl border border-white/10 bg-white/[0.06] px-3 py-2.5 text-left transition hover:border-white/20 hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/60">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ $activeTenant ? 'bg-cyan-400/15 text-cyan-300' : 'bg-amber-400/15 text-amber-300' }}">
                    <x-icon name="building" class="h-4 w-4" stroke="2" />
                </span>
                <span class="min-w-0 flex-1">
                    <span class="block text-[10px] font-semibold uppercase tracking-widest text-slate-400">Empresa activa</span>
                    <span class="block truncate text-sm font-semibold text-white">{{ $activeTenant->name ?? 'Selecciona una empresa' }}</span>
                </span>
                <x-icon name="switch" class="h-4 w-4 text-slate-400" />
            </button>

            <div x-show="open" x-cloak x-transition.origin.top
                 class="mt-2 overflow-hidden rounded-xl border border-white/10 bg-slate-800/95 shadow-xl backdrop-blur">
                <div class="px-3 pb-1 pt-2.5 text-[10px] font-semibold uppercase tracking-widest text-slate-400">Cambiar entorno de trabajo</div>
                <div class="max-h-64 overflow-y-auto p-1.5">
                    @forelse ($tenants as $tenant)
                        <form method="POST" action="{{ route('tenant.switch') }}">
                            @csrf
                            <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                            @php $isCurrent = $activeTenant && $activeTenant->id === $tenant->id; @endphp
                            <button type="submit" @disabled($isCurrent)
                                    class="flex w-full items-center justify-between gap-2 rounded-lg px-2.5 py-2 text-left text-sm transition {{ $isCurrent ? 'bg-white/10 font-semibold text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                                <span class="truncate">{{ $tenant->name }}</span>
                                @if ($isCurrent)
                                    <x-icon name="check" class="h-4 w-4 text-cyan-300" stroke="2.5" />
                                @endif
                            </button>
                        </form>
                    @empty
                        <p class="px-2.5 py-2 text-xs text-slate-400">No tienes empresas asignadas. Contacta al administrador.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Menú principal --}}
        <nav class="flex-1 space-y-6 overflow-y-auto px-3 pb-6">
            @foreach (\App\Support\Navigation::sections() as $section)
                <div>
                    @if ($section['label'])
                        <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">{{ $section['label'] }}</p>
                    @endif
                    <ul class="space-y-0.5">
                        @foreach ($section['items'] as $item)
                            <li>
                                <a href="{{ $item['url'] }}"
                                   @if ($item['is_active']) aria-current="page" @endif
                                   @if ($item['locked']) title="No incluido en la licencia actual" @endif
                                   class="group relative flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-400/60
                                          {{ $item['is_active'] ? 'bg-white/10 text-white shadow-[inset_0_0_0_1px_rgba(255,255,255,.08)]' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                    @if ($item['is_active'])
                                        <span class="absolute inset-y-1.5 left-0 w-[3px] rounded-r-full bg-cyan-400"></span>
                                    @endif
                                    <x-icon :name="$item['icon']" class="h-[18px] w-[18px] {{ $item['is_active'] ? 'text-cyan-300' : 'text-slate-500 group-hover:text-slate-300' }}" />
                                    <span class="flex-1 truncate">{{ $item['label'] }}</span>
                                    @if ($item['locked'])
                                        <x-icon name="lock" class="h-3.5 w-3.5 text-slate-500" />
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </nav>

        {{-- Usuario --}}
        <div class="shrink-0 border-t border-white/10 p-3">
            <div class="flex items-center gap-3 rounded-xl px-2 py-2">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-cyan-400 to-indigo-500 text-sm font-bold text-white">
                    {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                </span>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-white">{{ $user->name }}</p>
                    <p class="truncate text-xs text-slate-400">{{ $user->email }}</p>
                </div>
            </div>
            <div class="mt-1 grid grid-cols-2 gap-1">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center justify-center gap-1.5 rounded-lg px-2 py-2 text-xs font-medium transition {{ request()->routeIs('profile.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <x-icon name="user" class="h-4 w-4" /> Mi perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-1.5 rounded-lg px-2 py-2 text-xs font-medium text-slate-400 transition hover:bg-red-500/10 hover:text-red-300">
                        <x-icon name="logout" class="h-4 w-4" /> Salir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
