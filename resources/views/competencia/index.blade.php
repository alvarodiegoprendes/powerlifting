@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<div class="flex flex-col mb-96">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Listado de Competencias</h1>
            @auth
            <a href="{{ route('competencia.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Agregar nueva competencia
            </a>
            @endauth
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mt-4">
        <div class="table-container">
            <table class="ranking-table min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Nombre</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Fed.</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Fecha</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Lugar</th>
                        @auth
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Acciones</th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @foreach ($competencias as $competencia)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                <a href="{{route('competencia.show',$competencia)}}" class="text-blue-600 hover:text-blue-900">
                                    {{ $competencia->nombre_competencia }}
                                </a>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $competencia->federacion }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ \Carbon\Carbon::parse($competencia->fecha)->format('d/m/Y') }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $competencia->lugar_competencia }}</td>
                            @auth
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                <div class="flex items-center justify-start space-x-2">
                                    <a href="{{ route('competencia.edit',$competencia) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 border border-blue-600 hover:border-blue-900 px-2 py-1 rounded text-sm">Editar</a>
                                    <form action="{{ route('competencia.destroy', $competencia) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200 border border-red-600 hover:border-red-900 px-2 py-1 rounded text-sm">Eliminar</button>
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

<style>
    .table-container {
        width: 100%;
        overflow-x: auto;
        position: relative;
        max-height: 75vh;
    }
    
    .ranking-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .column-fixed {
        position: -webkit-sticky;
        position: sticky;
        z-index: 2;
    }
    
    .first-column {
        left: 0;
        min-width: 70px;
    }
    
    @media (min-width: 1280px) {
        .table-container {
            overflow-x: visible;
        }
        th:not(.column-fixed), td:not(.column-fixed) {
            min-width: auto;
        }
    }
</style>
@endsection
