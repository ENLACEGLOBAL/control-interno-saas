<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Nuevo usuario" subtitle="Crea credenciales globales y asigna empresas con su rol" icon="user" />
    </x-slot>

    <div class="mx-auto max-w-5xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('saas.users.store') }}">
            @csrf
            <x-card>
                <div class="space-y-8">
                    <x-form-errors />

                    <x-form-section step="1" title="Credenciales" description="Datos de acceso a la plataforma.">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <x-input-label for="name" value="Nombre completo" />
                                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Ej: Juan Pérez" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="email" value="Correo electrónico" />
                                <x-text-input id="email" type="email" name="email" :value="old('email')" required placeholder="juan@empresa.com" autocomplete="off" />
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="password" value="Contraseña temporal" />
                                <x-text-input id="password" type="password" name="password" required minlength="8" placeholder="Mínimo 8 caracteres" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                        </div>
                    </x-form-section>

                    <hr class="border-slate-100">

                    <x-form-section step="2" title="Empresas y roles" description="Marca las empresas a las que tendrá acceso y el rol en cada una.">
                        @if ($tenants->isEmpty())
                            <x-alert type="warning">
                                Debes registrar al menos una empresa antes de dar de alta usuarios.
                                <a href="{{ route('saas.tenants.create') }}" class="font-semibold underline">Crear empresa</a>
                            </x-alert>
                        @else
                            <div class="space-y-2">
                                @foreach ($tenants as $t)
                                    <div x-data="{ on: {{ in_array($t->id, old('tenant_ids', [])) ? 'true' : 'false' }} }"
                                         class="flex flex-col gap-3 rounded-xl border p-3 transition sm:flex-row sm:items-center"
                                         :class="on ? 'border-slate-900 bg-slate-50' : 'border-slate-200'">
                                        <label class="flex flex-1 cursor-pointer items-center gap-3">
                                            <input type="checkbox" name="tenant_ids[]" value="{{ $t->id }}" x-model="on"
                                                   class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-slate-500 ring-1 ring-slate-200"><x-icon name="building" class="h-4 w-4" /></span>
                                            <span class="text-sm font-semibold text-slate-800">{{ $t->name }}</span>
                                        </label>
                                        <div class="sm:w-56">
                                            <x-select name="role_names[{{ $t->id }}]" x-bind:required="on" x-bind:class="on ? '' : 'opacity-50'" aria-label="Rol en {{ $t->name }}" class="!py-2">
                                                <option value="">Seleccionar rol…</option>
                                                @foreach ($roles as $r)
                                                    <option value="{{ $r->name }}" @selected(old('role_names.'.$t->id) === $r->name)>{{ ucfirst(str_replace('_', ' ', $r->name)) }}</option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </x-form-section>

                    <x-form-actions :cancel="route('saas.dashboard')">
                        <x-btn icon="check">Dar de alta usuario</x-btn>
                    </x-form-actions>
                </div>
            </x-card>
        </form>
    </div>
</x-app-layout>
