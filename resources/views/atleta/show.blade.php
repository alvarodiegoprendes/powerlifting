@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<div class="flex flex-col mb-96">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ $atleta->nombre }}</h1>
            @auth
            <a href="{{ route('resultado_atleta_competencia.create_parametrizada',$atleta) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Agregar datos
            </a>
            @endauth
        </div>
    </div>

    <!-- Tabla de récords del atleta -->
    <div class="container mx-auto px-4 py-2">
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Récords personales</h2>
        
        <!-- Modificar la sección de récords personales para que las tablas se muestren en pares -->

<!-- Reemplazar el contenedor principal de récords -->
<div class="records-container">
    <!-- Grid para las 3 tablas de levantamientos -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 records-row">
        <!-- Mejor Squat -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 md:mb-0 record-card">
            <div class="overflow-x-auto" style="scrollbar-width: thin;">
                <h5 class="px-4 py-3 font-bold text-center text-gray-700 bg-gradient-to-r from-blue-50 to-gray-50 border-b border-gray-200 uppercase tracking-wider text-sm shadow-sm">Mejor Squat</h5>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Squat</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">{{ $bestSquat ? $bestSquat->max_squat : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestSquat ? $bestSquat->equipamiento : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestSquat ? $bestSquat->competencia->nombre_competencia : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestSquat && $bestSquat->competencia ? \Carbon\Carbon::parse($bestSquat->competencia->fecha)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mejor Bench -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 md:mb-0 record-card">
            <div class="overflow-x-auto" style="scrollbar-width: thin;">
                <h5 class="px-4 py-3 font-bold text-center text-gray-700 bg-gradient-to-r from-blue-50 to-gray-50 border-b border-gray-200 uppercase tracking-wider text-sm shadow-sm">Mejor Bench</h5>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Bench</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $bestBench ? $bestBench->max_bench : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestBench ? $bestBench->equipamiento : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestBench ? $bestBench->competencia->nombre_competencia : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestBench && $bestBench->competencia ? \Carbon\Carbon::parse($bestBench->competencia->fecha)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Segunda fila de tablas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 records-row">
        <!-- Mejor Deadlift -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 md:mb-0 record-card">
            <div class="overflow-x-auto" style="scrollbar-width: thin;">
                <h5 class="px-4 py-3 font-bold text-center text-gray-700 bg-gradient-to-r from-blue-50 to-gray-50 border-b border-gray-200 uppercase tracking-wider text-sm shadow-sm">Mejor Deadlift</h5>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Deadlift</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $bestDeadlift ? $bestDeadlift->max_deadlift : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestDeadlift ? $bestDeadlift->equipamiento : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestDeadlift ? $bestDeadlift->competencia->nombre_competencia : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestDeadlift && $bestDeadlift->competencia ? \Carbon\Carbon::parse($bestDeadlift->competencia->fecha)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mejor Total -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 md:mb-0 record-card">
            <div class="overflow-x-auto" style="scrollbar-width: thin;">
                <h5 class="px-4 py-3 font-bold text-center text-gray-700 bg-gradient-to-r from-blue-50 to-gray-50 border-b border-gray-200 uppercase tracking-wider text-sm shadow-sm">Mejor Total</h5>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Total</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $bestTotal ? $bestTotal->total : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestTotal ? $bestTotal->equipamiento : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestTotal ? $bestTotal->competencia->nombre_competencia : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestTotal && $bestTotal->competencia ? \Carbon\Carbon::parse($bestTotal->competencia->fecha)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Tercera fila de tablas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 records-row">
        <!-- Mejor IPF -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 md:mb-0 record-card">
            <div class="overflow-x-auto" style="scrollbar-width: thin;">
                <h5 class="px-4 py-3 font-bold text-center text-gray-700 bg-gradient-to-r from-blue-50 to-gray-50 border-b border-gray-200 uppercase tracking-wider text-sm shadow-sm">Mejor IPF</h5>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">IPF</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $bestIPF ? $bestIPF->puntos_ipf : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestIPF ? $bestIPF->equipamiento : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestIPF ? $bestIPF->competencia->nombre_competencia : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestIPF && $bestIPF->competencia ? \Carbon\Carbon::parse($bestIPF->competencia->fecha)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mejor DOTS -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 md:mb-0 record-card">
            <div class="overflow-x-auto" style="scrollbar-width: thin;">
                <h5 class="px-4 py-3 font-bold text-center text-gray-700 bg-gradient-to-r from-blue-50 to-gray-50 border-b border-gray-200 uppercase tracking-wider text-sm shadow-sm">Mejor DOTS</h5>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">DOTS</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-4 py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $bestDOTS ? $bestDOTS->puntos_dots : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestDOTS ? $bestDOTS->equipamiento : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestDOTS ? $bestDOTS->competencia->nombre_competencia : 'N/A' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $bestDOTS && $bestDOTS->competencia ? \Carbon\Carbon::parse($bestDOTS->competencia->fecha)->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Competencias</h2>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="table-container">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200 ranking-table">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="column-fixed first-column px-1 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Puesto</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Competencia</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fed.</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Fecha</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Lugar</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Sexo</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Edad</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Cat. Edad</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Equip.</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Peso Corp.</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Cat. Peso</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Squat</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Bench</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Deadlift</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Total</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">IPF</th>
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">DOTS</th>
                            @auth
                            <th class="px-1 md:px-2 py-2 md:py-3 text-left text-xs text-gray-500 tracking-wider font-bold">Acciones</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-xs md:text-sm">
                        @foreach ($resultado_atleta_competencias as $resultado_atleta_competencia)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="column-fixed first-column px-1 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->puesto_atleta }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->competencia->nombre_competencia }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->federacion_atleta }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ \Carbon\Carbon::parse($resultado_atleta_competencia->competencia->fecha)->format('d/m/Y') }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->competencia->lugar_competencia }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $atleta->sexo }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->edad_atleta }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->categoria_edad }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->equipamiento }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->peso_corporal }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->categoria_peso }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->squat_1 }} / {{ $resultado_atleta_competencia->squat_2 }} / {{ $resultado_atleta_competencia->squat_3 }}</td>  
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->bench_press_1 }} / {{ $resultado_atleta_competencia->bench_press_2 }} / {{ $resultado_atleta_competencia->bench_press_3 }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->deadlift_1 }} / {{ $resultado_atleta_competencia->deadlift_2 }} / {{ $resultado_atleta_competencia->deadlift_3 }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->total }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->puntos_ipf }}</td>
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">{{ $resultado_atleta_competencia->puntos_dots }}</td>
                                @auth
                                <td class="px-1 md:px-2 py-2 md:py-4 whitespace-nowrap text-xs">
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{route('resultado_atleta_competencia.edit',$resultado_atleta_competencia)}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 md:py-2 px-2 md:px-4 rounded text-center">
                                            Editar
                                        </a>
                                        <form action="{{ route('resultado_atleta_competencia.destroy_parametrizada', [$resultado_atleta_competencia,$atleta]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 md:py-2 px-2 md:px-4 rounded w-full">
                                                Eliminar
                                            </button>
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
</div>

<!-- Actualizar los estilos para asegurar que las tablas se muestren correctamente -->
<style>
    /* Contenedor principal para la tabla con scroll */
    .table-container {
        width: 100%;
        overflow-x: auto;
        position: relative;
        max-height: 75vh;
    }
    
    /* Contenedor de records para mejor organización */
    .records-container {
        width: 100%;
    }
    
    /* Tarjetas de récords */
    .record-card {
        width: 100%;
        height: 100%;
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
    
    /* Primera columna (Puesto) */
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
    
    /* Líneas discontinuas entre columnas - aplica a todas las tablas */
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
        
        /* Espaciado adicional entre tablas en dispositivos móviles */
        .grid > div {
            margin-bottom: 1rem;
        }
    }
    
    /* Orientación horizontal específica para móviles */
    @media (max-width: 896px) and (orientation: landscape) {
        /* Configurar el contenedor de récords principal */
        .records-container {
            padding: 0 5px;
        }
        
        /* Hacer que las filas de récords se ajusten automáticamente */
        .records-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            margin-bottom: 10px;
        }
        
        /* Configurar cada tarjeta de récord individualmente */
        .record-card {
            height: 100%;
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
        }
        
        /* Hacer que el div de overflow-x ocupe todo el espacio disponible */
        .record-card > div {
            flex: 1;
            width: 100%;
            overflow-x: auto;
        }
        
        /* Mejorar la visualización de las tablas */
        .record-card table {
            width: 100%;
            table-layout: auto;
        }
        
        /* Ajustar el tamaño del texto y padding para mejor visualización */
        .record-card th, .record-card td {
            padding: 8px 6px;
            font-size: 11px;
        }
        
        /* Asegurar que las columnas tengan tamaños mínimos adecuados */
        .record-card th, .record-card td {
            min-width: 70px;
            white-space: nowrap;
        }
    }
</style>

@endsection

