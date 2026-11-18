<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Asignar áreas a {{ $user->name }}" subtitle="Define a qué departamentos tendrá acceso" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <p class="mb-6 text-sm text-slate-500">Selecciona las áreas a las que este usuario tendrá acceso. Podrá ver los procesos, riesgos y controles de los departamentos marcados.</p>

                <form method="POST" action="{{ route('tenant-users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @forelse($areas as $area)
                            <label class="flex cursor-pointer items-center rounded-lg border border-slate-200 p-3 transition hover:border-slate-300 hover:bg-slate-50">
                                <input type="checkbox" name="areas[]" value="{{ $area->id }}"
                                    class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20"
                                    {{ in_array($area->id, $assignedAreaIds) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm font-semibold text-slate-700">{{ $area->name }}</span>
                            </label>
                        @empty
                            <div class="col-span-2 py-4 text-center text-slate-500">Primero debes crear áreas en la empresa.</div>
                        @endforelse
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                        <x-btn :href="route('tenant-users.index')" variant="secondary">Volver</x-btn>
                        <x-btn>Guardar accesos</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
