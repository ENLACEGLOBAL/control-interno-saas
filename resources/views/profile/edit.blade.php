<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Mi perfil" subtitle="Administra tu información personal y la seguridad de tu cuenta" icon="user" />
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            {{-- Resumen de la cuenta --}}
            <aside class="lg:col-span-1">
                <div class="relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-sm lg:sticky lg:top-24">
                    <div class="pointer-events-none absolute inset-0" style="background:radial-gradient(500px 260px at 0% -20%,rgba(56,189,248,.22),transparent 60%),radial-gradient(400px 260px at 110% 120%,rgba(99,102,241,.25),transparent 60%),linear-gradient(160deg,#0b1220,#0f172a);"></div>
                    <div class="relative z-10">
                        <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-400 to-indigo-500 text-2xl font-bold">
                            {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                        </span>
                        <h2 class="mt-4 text-lg font-bold">{{ $user->name }}</h2>
                        <p class="text-sm text-slate-300">{{ $user->email }}</p>

                        <dl class="mt-6 space-y-3 border-t border-white/10 pt-5 text-sm">
                            <div class="flex justify-between gap-3">
                                <dt class="text-slate-400">Empresa activa</dt>
                                <dd class="truncate font-medium">{{ session('tenant_name', '—') }}</dd>
                            </div>
                            <div class="flex justify-between gap-3">
                                <dt class="text-slate-400">Miembro desde</dt>
                                <dd class="font-medium">{{ optional($user->created_at)->format('d/m/Y') ?? '—' }}</dd>
                            </div>
                        </dl>

                        <nav class="mt-6 space-y-1 border-t border-white/10 pt-5 text-sm" aria-label="Secciones del perfil">
                            <a href="#informacion" class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-slate-300 transition hover:bg-white/10 hover:text-white"><x-icon name="user" class="h-4 w-4" /> Información</a>
                            <a href="#seguridad" class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-slate-300 transition hover:bg-white/10 hover:text-white"><x-icon name="lock" class="h-4 w-4" /> Contraseña</a>
                            <a href="#eliminar" class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-slate-300 transition hover:bg-white/10 hover:text-white"><x-icon name="alert" class="h-4 w-4" /> Zona de riesgo</a>
                        </nav>
                    </div>
                </div>
            </aside>

            <div class="space-y-6 lg:col-span-2">
                <x-card id="informacion" class="scroll-mt-24">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </x-card>

                <x-card id="seguridad" class="scroll-mt-24">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </x-card>

                <x-card id="eliminar" class="scroll-mt-24 border-red-200">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
