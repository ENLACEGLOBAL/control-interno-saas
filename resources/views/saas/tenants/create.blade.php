<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🏢 Registrar Nueva Empresa (Tenant)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
<form method="POST" action="{{ route('saas.tenants.store') }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Razón Social de la Empresa</label>
                            <input type="text" name="name" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: Logística Internacional S.A.">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-indigo-800 mb-1">Plan / Tipo de Licencia</label>
                            <select name="license_type" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-indigo-50">
                                <option value="">-- Seleccionar Plan SaaS --</option>
                                <option value="Basic">Licencia Básica</option>
                                <option value="Profesional">Licencia Profesional</option>
                                <option value="Corporativa">Licencia Corporativa</option>
                                <option value="Enterprise">Enterprise</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end border-t pt-4">
                        <a href="{{ route('saas.dashboard') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm mr-4 flex items-center">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow-sm transition-colors">
                            Crear Entorno de Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>