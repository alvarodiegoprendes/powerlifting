@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')

<form action="{{route('atleta.store')}}" method="POST" class="space-y-4">
    @csrf
    <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700" for="nombre">
            Escriba su nombre
        </label>
        <input type="text" name="nombre" id="nombre" value=" {{old('nombre')}}  " class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
    </div>
    <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700" for="pais">
            Escriba su pais de nacimiento
        </label>
        <input type="text" name="pais" id="pais" value="{{old('pais','Cuba')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
    </div>
    <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700" for="sexo">
            Eliga su sexo
        </label>
        <select name="sexo" id="sexo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            <option value="">Seleccione el sexo</option>
            <option value="masculino" {{old('sexo') == 'masculino' ? 'selected' : ''}}>Masculino</option>
            <option value="femenino" {{old('sexo') == 'femenino' ? 'selected' : ''}}>Femenino</option>
        </select>
    </div>
    <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700" for="fecha_nacimiento">
            Eliga su fecha de nacimiento
        </label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
    </div>
    <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700" for="altura">
            Escriba su altura
        </label>
        <input type="text" name="altura" id="altura" value="{{old('altura')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
    </div>
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Enviar Datos
    </button>
    <a href="{{ route('atleta.index') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Cancelar</a>
</form>
  
@endsection