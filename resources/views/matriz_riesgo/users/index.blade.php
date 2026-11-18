<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Accesos por área" subtitle="Define qué áreas puede consultar cada usuario de la empresa" icon="users" />
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 pb-12 pt-6 sm:px-6 lg:px-8" x-data="{ q: '' }">
        <x-card padding="p-0">
            @if ($users->isEmpty())
                <x-empty-state icon="users" title="No hay usuarios en esta empresa"
                               description="El administrador de la plataforma puede dar de alta usuarios y asignarlos a esta empresa." />
            @else
                <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="relative w-full sm:max-w-xs">
                        <x-icon name="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
                        <input type="search" x-model="q" placeholder="Buscar por nombre o correo…" aria-label="Buscar usuarios"
                               class="block w-full rounded-lg border-slate-300 py-2 pl-9 text-sm placeholder-slate-400 shadow-sm focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">
                    </div>
                    <span class="text-xs text-slate-500"><strong class="text-slate-900">{{ $users->count() }}</strong> usuarios</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th class="!text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr x-show="$el.dataset.search.includes(q.toLowerCase())" data-search="{{ mb_strtolower($user->name.' '.$user->email) }}">
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                                            <span class="font-semibold text-slate-900">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-slate-500">{{ $user->email }}</td>
                                    <td class="text-right">
                                        <x-btn :href="route('tenant-users.edit', $user->id)" variant="secondary" size="sm" icon="key">Asignar áreas</x-btn>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
