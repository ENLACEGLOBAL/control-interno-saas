<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Consultas básicas" subtitle="Reportes y consultas generales del sistema" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-4">
            <x-alert type="success">
                <strong>Acceso permitido.</strong> Este módulo está disponible para todos los tipos de licencia (Basic, Premium, Enterprise).
            </x-alert>

            <x-card>
                <p class="text-sm text-slate-600">Aquí se mostrarían reportes generales, listas de asistencia o consultas básicas del sistema.</p>
            </x-card>
        </div>
    </div>
</x-app-layout>
