@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<div class="container mx-auto px-4 py-8 flex justify-center">
    <div class="w-full max-w-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear Nueva Competencia</h1>

        <form action="{{route('competencia.store')}}" method="POST" class="space-y-4">
            @csrf
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700" for="nombre_competencia">
                    Nombre de la competencia
                </label>
                <input type="text" name="nombre_competencia" id="nombre_competencia" value="{{old('nombre_competencia')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700" for="federacion">
                    Federación
                </label>
                <input type="text" name="federacion" id="federacion" value="{{old('federacion')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700" for="fecha">
                    Fecha de la competencia
                </label>
                <input type="date" name="fecha" id="fecha" value="{{old('fecha')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700" for="lugar_competencia">
                    Lugar de la competencia
                </label>
                <input type="text" name="lugar_competencia" id="lugar_competencia" value="{{old('lugar_competencia')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('competencia.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Cancelar</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crear Competencia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
