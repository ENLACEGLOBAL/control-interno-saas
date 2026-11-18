<x-guest-layout>
    <x-slot name="title">Confirmar contraseña</x-slot>
    <x-slot name="heading">Confirma tu contraseña</x-slot>
    <x-slot name="subheading">Esta es un área segura. Confirma tu contraseña para continuar.</x-slot>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <x-auth-field name="password" label="Contraseña" type="password" icon="lock" autofocus autocomplete="current-password" placeholder="••••••••" />

        <x-auth-button>Confirmar</x-auth-button>
    </form>
</x-guest-layout>
