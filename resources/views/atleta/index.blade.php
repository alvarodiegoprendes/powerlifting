@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<div class="flex flex-col mb-96">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Listado de Atletas</h1>
            @auth
            <a href="{{ route('atleta.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Agregar nuevo atleta
            </a>
            @endauth
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mt-4">
        <div class="table-container">
            <table class="ranking-table min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="column-fixed first-column px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Nombre</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Pais</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Sexo</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Fecha de nacimiento</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Altura</th>
                        @auth
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Acciones</th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @foreach ($atletas as $atleta)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="column-fixed first-column px-2 py-4 whitespace-nowrap text-xs">
                                <a href="{{route('atleta.show',$atleta)}}" class="text-blue-600 hover:text-blue-900">
                                    {{ $atleta->nombre }}
                                </a>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->pais }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->sexo }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ \Carbon\Carbon::parse($atleta->fecha_nacimiento)->format('d/m/Y') }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->altura }}</td>
                            @auth
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                <div class="flex flex-col sm:flex-row items-center gap-2 sm:space-x-2">
                                    <a href="{{ route('atleta.edit',$atleta) }}" class="w-full sm:w-auto text-center text-blue-600 hover:text-blue-900 transition-colors duration-200 border border-blue-600 hover:border-blue-900 px-3 py-2 sm:px-2 sm:py-1 rounded text-xs sm:text-sm">Editar</a>
                                    <form action="{{ route('atleta.destroy', $atleta) }}" method="POST" class="w-full sm:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-red-600 hover:text-red-900 transition-colors duration-200 border border-red-600 hover:border-red-900 px-3 py-2 sm:px-2 sm:py-1 rounded text-xs sm:text-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                            @endauth  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection