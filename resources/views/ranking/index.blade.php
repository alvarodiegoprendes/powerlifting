@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<div class="flex flex-col mb-96">
    <!-- Formulario de búsqueda con filtro de sexo -->
    <form method="GET" action="{{ route('ranking.index') }}" class="mt-4 ml-2 flex items-center space-x-2">
        <div class="flex items-center space-x-2">
     
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}" 
                placeholder="Buscar por nombre" 
                class="border rounded px-2 py-1 text-sm"
            />

            <select name="sexo" class="border rounded px-6 py-1 text-sm text-left">
                <option value="">Filtrar por sexo</option>
                <option value="masculino" {{ $sexo == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="femenino" {{ $sexo == 'femenino' ? 'selected' : '' }}>Femenino</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Filtrar</button>
            
            @if($search || $sexo)
                <a href="{{ route('ranking.index') }}" class="bg-gray-500 text-white px-3 py-1 rounded text-sm">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden mt-2">
        <div class="table-container">
            <table class="ranking-table min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="column-fixed first-column px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Posición</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Atleta</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Fed.</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Fecha</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Lugar</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Sexo</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Edad</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Equipamiento</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Categoria</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Peso</th>                    
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Squat</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Bench</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Deadlift</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Total Kg</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Puntos IPF</th>
                        <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 tracking-wider">Puntos DOTS</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                    @foreach ($ranking as $atleta)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="column-fixed first-column px-2 py-4 whitespace-nowrap text-xs">{{ $loop->iteration }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                <a href="{{ route('atleta.show', $atleta->id) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ $atleta->nombre }}
                                </a>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->federacion_atleta ?? 'N/A' }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ \Carbon\Carbon::parse($atleta->resultado_atleta_competencias[0]->competencia->fecha)->format('d/m/Y') ?? 'N/A' }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{$atleta->resultado_atleta_competencias[0]->competencia->lugar_competencia ?? 'N/A' }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->sexo ?? 'N/A' }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->edad_atleta ?? 'N/A'}}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->equipamiento ?? 'N/A' }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->categoria_peso ?? 'N/A'}}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->peso_corporal ?? 'N/A' }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                {{ max($atleta->resultado_atleta_competencias[0]->squat_1 ?? 0, $atleta->resultado_atleta_competencias[0]->squat_2 ?? 0, $atleta->resultado_atleta_competencias[0]->squat_3 ?? 0) }}
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                {{ max($atleta->resultado_atleta_competencias[0]->bench_press_1 ?? 0, $atleta->resultado_atleta_competencias[0]->bench_press_2 ?? 0, $atleta->resultado_atleta_competencias[0]->bench_press_3 ?? 0) }}
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">
                                {{ max($atleta->resultado_atleta_competencias[0]->deadlift_1 ?? 0, $atleta->resultado_atleta_competencias[0]->deadlift_2 ?? 0, $atleta->resultado_atleta_competencias[0]->deadlift_3 ?? 0) }}
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->total ?? 0 }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->puntos_ipf ?? 0 }}</td>
                            <td class="px-2 py-4 whitespace-nowrap text-xs">{{ $atleta->resultado_atleta_competencias[0]->puntos_dots ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Contenedor principal para la tabla con scroll */
    .table-container {
        width: 100%;
        overflow-x: auto;
        position: relative;
        max-height: 75vh;
    }
    
    /* Estilos básicos de la tabla */
    .ranking-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    /* Columna fija */
    .column-fixed {
        position: -webkit-sticky;
        position: sticky;
        z-index: 2;
    }
    
    /* Primera columna (Posición) */
    .first-column {
        left: 0;
        box-shadow: 2px 0 5px -2px rgba(0,0,0,0.1);
        min-width: 70px;
    }
    
    /* Color de fondo específico para la columna fija */
    thead .column-fixed {
        background-color: #f9fafb; /* Fondo sólido para encabezados (bg-gray-50) */
    }
    
    tbody .column-fixed {
        background-color: #ffffff; /* Fondo sólido para celdas (bg-white) */
    }
    
    /* Mantener el color de fondo en hover para la columna fija */
    tbody tr.hover\:bg-gray-50:hover .column-fixed {
        background-color: #f9fafb; /* Mismo color que el hover de la fila */
    }
    
    /* Resto de columnas con ancho mínimo para evitar texto comprimido */
    th:not(.column-fixed), td:not(.column-fixed) {
        min-width: 80px;
    }
    
    /* Líneas discontinuas entre columnas */
    th, td {
        border-right: 1px dashed #e5e7eb;
    }
    
    th:last-child, td:last-child {
        border-right: none;
    }
    
    /* Asegurarse de que la primera columna fija tenga borde derecho más definido */
    .first-column {
        border-right: 1px dashed #d1d5db;
    }
    
    /* Diseño responsivo: en pantallas grandes, ajustar al ancho disponible */
    @media (min-width: 1280px) {
        .table-container {
            overflow-x: visible;
        }
        
        /* En pantallas grandes, ajustar los anchos de columna automáticamente */
        th:not(.column-fixed), td:not(.column-fixed) {
            min-width: auto;
        }
    }
    
    /* Ajuste para móviles para asegurar que la columna fija funcione correctamente */
    @media (max-width: 768px) {
        .first-column {
            min-width: 60px;
            z-index: 3;
        }
    }
</style>
@endsection