@extends('errors.layout')

@section('code', '403')
@section('title', 'Acceso restringido')
@section('heading', 'No tienes acceso a esta sección')
@section('message', $exception->getMessage() ?: 'Tu rol o la licencia de la empresa activa no incluyen este módulo. Si crees que es un error, contacta al administrador.')
