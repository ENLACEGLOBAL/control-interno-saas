<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Asignar áreas" subtitle="Define a qué departamentos tendrá acceso {{ $user->name }}" icon="key" />
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-card>
            <div class="mb-6 flex items-center gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                <div class="min-w-0">
                    <p class="truncate font-semibold text-slate-900">{{ $user->name }}</p>
                    <p class="truncate text-sm text-slate-500">{{ $user->email }}</p>
                </div>
            </div>

            @if ($areas->isEmpty())
                <x-empty-state icon="building" title="No hay áreas para asignar" description="Primero registra las áreas de la empresa.">
                    <x-btn :href="route('areas.create')" icon="plus">Crear área</x-btn>
                </x-empty-state>
            @else
                <form method="POST" action="{{ route('tenant-users.update', $user->id) }}"
                      x-data="{ toggleAll(state) { $root.querySelectorAll('input[name=\'areas[]\']').forEach(c => c.checked = state) } }">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-sm text-slate-500">El usuario verá procesos, riesgos y controles de las áreas marcadas.</p>
                        <div class="flex shrink-0 gap-1">
                            <button type="button" @click="toggleAll(true)" class="rounded-md px-2 py-1 text-xs font-semibold text-cyan-700 hover:bg-cyan-50">Todas</button>
                            <button type="button" @click="toggleAll(false)" class="rounded-md px-2 py-1 text-xs font-semibold text-slate-500 hover:bg-slate-100">Ninguna</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                        @foreach ($areas as $area)
                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-slate-300 hover:bg-slate-50 has-[:checked]:border-slate-900 has-[:checked]:bg-slate-50">
                                <input type="checkbox" name="areas[]" value="{{ $area->id }}"
                                       class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20"
                                       @checked(in_array($area->id, $assignedAreaIds))>
                                <span class="text-sm font-medium text-slate-700">{{ $area->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <x-form-actions :cancel="route('tenant-users.index')" cancel-label="Volver" class="mt-6">
                        <x-btn icon="check">Guardar accesos</x-btn>
                    </x-form-actions>
                </form>
            @endif
        </x-card>
    </div>
</x-app-layout>
