<x-guest-layout>
    <x-slot name="title">Crear cuenta</x-slot>
    <x-slot name="heading">Crea tu cuenta</x-slot>
    <x-slot name="subheading">Regístrate para comenzar a gestionar tu control interno.</x-slot>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <x-auth-field name="name" label="Nombre" icon="user" autofocus autocomplete="name" placeholder="Nombre completo" />
        <x-auth-field name="email" label="Correo electrónico" type="email" icon="mail" autocomplete="username" placeholder="tu@empresa.com" />
        <x-auth-field name="password" label="Contraseña" type="password" icon="lock" autocomplete="new-password" placeholder="••••••••" />
        <x-auth-field name="password_confirmation" label="Confirmar contraseña" type="password" icon="lock" autocomplete="new-password" placeholder="••••••••" />

        <x-auth-button>Crear cuenta</x-auth-button>

        <p class="text-center text-sm text-slate-500">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="font-medium text-slate-900 transition hover:underline">Inicia sesión</a>
        </p>
    </form>
</x-guest-layout>
