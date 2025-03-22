@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<div class="h-screen flex flex-col">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Competencias</h1>
            <a href="{{ route('competencia.create',$atleta) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Agregar datos
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden mt-4">
        <div class="table-container">
            <table class="ranking-table min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="column-fixed first-column px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Competencia</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Federacion</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Fecha</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Lugar</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Atletas</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @foreach ($competencias as $competencia)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="column-fixed first-column px-2 py-4 whitespace-nowrap text-xs">
                                <a href="{{route('competencia.show',$competencia)}}" class="text-blue-600 hover:text-blue-900">
                                    {{ $competencia->nombre_competencia }}
                                </a>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $competencia->federacion_atleta }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ \Carbon\Carbon::parse($competencia->fecha)->format('d/m/Y') }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $competencia->lugar_competencia }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ count($atleta) }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                <a href="{{route('competencia.edit',$competencia)}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Editar
                                </a>
                                <form action="{{ route('competencia.destroy', $competencia) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Eliminar
                                    </button>
                                </form>
                            </td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .table-container {
        overflow-x: auto;
        shadow-md: sm:rounded-lg;
    }
    .ranking-table {
        min-width: 100%;
        divide-y: divide-gray-200;
    }
    .column-fixed {
        position: sticky;
        left: 0;
        background-color: white;
        z-index: 1;
    }
    .first-column {
        width: 200px;
    }
</style>
@endsection