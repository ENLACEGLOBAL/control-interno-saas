<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Gestión de accesos por área" subtitle="Asigna áreas a los usuarios de la empresa" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <x-alert>{{ session('status') }}</x-alert>
            @endif

            <x-card padding="p-0">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Nombre</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider text-slate-500">Correo</th>
                                <th class="px-6 py-3 text-right font-semibold uppercase tracking-wider text-slate-500">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($users as $user)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 font-semibold text-slate-900">{{ $user->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-600">{{ $user->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <x-btn :href="route('tenant-users.edit', $user->id)" variant="secondary" class="!px-3 !py-1.5 text-xs">Asignar áreas</x-btn>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
