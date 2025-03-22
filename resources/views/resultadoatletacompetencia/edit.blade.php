@extends('layouts.base')

@section('title')
    powerlifting cubano
@endsection

@section('body')
<h3>Editar Competencia al atleta {{$atleta->nombre}}</h3>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Editar Competencia</h2>
        
        <form action="{{ route('resultado_atleta_competencia.update', $resultado_atleta_competencias) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información de la Competencia -->
                <div class="pt-4">
                    <label for="competencia_id" class="block text-sm font-medium text-gray-700">Competencia</label>
                    <select name="competencia_id" id="competencia_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach($competencias as $competencia)
                            <option value="{{ $competencia->id }}" {{ old('competencia_id', $resultado_atleta_competencias->competencia_id) == $competencia->id ? 'selected' : '' }}>
                                {{ $competencia->nombre_competencia }} - {{ $competencia->fecha }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="puesto_atleta" class="block text-sm font-medium text-gray-700">Puesto</label>
                    <input type="number" name="puesto_atleta" id="puesto_atleta" value="{{old('puesto_atleta', $resultado_atleta_competencias->puesto_atleta)}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="federacion_atleta" class="block text-sm font-medium text-gray-700">Federación</label>
                    <input type="text" name="federacion_atleta" id="federacion_atleta" value="{{old('federacion_atleta', $resultado_atleta_competencias->federacion_atleta)}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="edad_atleta" class="block text-sm font-medium text-gray-700">Edad</label>
                    <input type="number" name="edad_atleta" id="edad_atleta" value="{{old('edad_atleta', $resultado_atleta_competencias->edad_atleta)}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="equipamiento" class="block text-sm font-medium text-gray-700">Equipamiento</label>
                    <select name="equipamiento" id="equipamiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Raw" {{old('equipamiento', $resultado_atleta_competencias->equipamiento) == 'Raw' ? 'selected' : ''}}>Raw</option>
                        <option value="Wraps" {{old('equipamiento', $resultado_atleta_competencias->equipamiento) == 'Wraps' ? 'selected' : ''  }}>Wraps</option>
                    </select>
                </div>

                <div>
                    <label for="peso_corporal" class="block text-sm font-medium text-gray-700">Peso Corporal</label>
                    <input type="number" step="0.01" name="peso_corporal" id="peso_corporal" value="{{old('peso_corporal', $resultado_atleta_competencias->peso_corporal)}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="tipo_competencia" class="block text-sm font-medium text-gray-700">Tipo de Competencia</label>
                    <select name="tipo_competencia" id="tipo_competencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="full-power" {{old('tipo_competencia', $resultado_atleta_competencias->tipo_competencia) == 'full-power' ? 'selected' : ''}}>Full Power</option>
                        <option value="push-pull" {{old('tipo_competencia', $resultado_atleta_competencias->tipo_competencia) == 'push-pull' ? 'selected' : ''}}>Push-Pull</option>
                    </select>
                </div>


            </div>

            <!-- Levantamientos -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Intentos</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Squat -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Squat</label>
                        <div class="space-y-2">
                            <input type="number" step="0.5" name="squat_1" placeholder="1er intento" value="{{old('squat_1', $resultado_atleta_competencias->squat_1)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="squat_1_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="squat_1_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('squat_1_no_valido', $resultado_atleta_competencias->squat_1_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="squat_1_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                            <input type="number" step="0.5" name="squat_2" placeholder="2do intento" value="{{old('squat_2', $resultado_atleta_competencias->squat_2)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="squat_2_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="squat_2_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('squat_2_no_valido', $resultado_atleta_competencias->squat_2_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="squat_2_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                            <input type="number" step="0.5" name="squat_3" placeholder="3er intento" value="{{old('squat_3', $resultado_atleta_competencias->squat_3)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="squat_3_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="squat_3_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('squat_3_no_valido', $resultado_atleta_competencias->squat_3_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="squat_3_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bench Press -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bench Press</label>
                        <div class="space-y-2">
                            <input type="number" step="0.5" name="bench_press_1" placeholder="1er intento" value="{{old('bench_press_1', $resultado_atleta_competencias->bench_press_1)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="bench_press_1_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="bench_press_1_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('bench_press_1_no_valido', $resultado_atleta_competencias->bench_press_1_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="bench_press_1_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                            <input type="number" step="0.5" name="bench_press_2" placeholder="2do intento" value="{{old('bench_press_2', $resultado_atleta_competencias->bench_press_2)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="bench_press_2_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="bench_press_2_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('bench_press_2_no_valido', $resultado_atleta_competencias->bench_press_2_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="bench_press_2_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                            <input type="number" step="0.5" name="bench_press_3" placeholder="3er intento" value="{{old('bench_press_3', $resultado_atleta_competencias->bench_press_3)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="bench_press_3_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="bench_press_3_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('bench_press_3_no_valido', $resultado_atleta_competencias->bench_press_3_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="bench_press_3_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Deadlift -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deadlift</label>
                        <div class="space-y-2">
                            <input type="number" step="0.5" name="deadlift_1" placeholder="1er intento" value="{{old('deadlift_1', $resultado_atleta_competencias->deadlift_1)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="deadlift_1_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="deadlift_1_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('deadlift_1_no_valido', $resultado_atleta_competencias->deadlift_1_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="deadlift_1_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                            <input type="number" step="0.5" name="deadlift_2" placeholder="2do intento" value="{{old('deadlift_2', $resultado_atleta_competencias->deadlift_2)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="deadlift_2_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="deadlift_2_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('deadlift_2_no_valido', $resultado_atleta_competencias->deadlift_2_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="deadlift_2_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                            <input type="number" step="0.5" name="deadlift_3" placeholder="3er intento" value="{{old('deadlift_3', $resultado_atleta_competencias->deadlift_3)}}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="deadlift_3_no_valido" value="0">
                                    <input
                                        type="checkbox"
                                        name="deadlift_3_no_valido"
                                        value="1" 
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('deadlift_3_no_valido', $resultado_atleta_competencias->deadlift_3_no_valido ? 'checked' : '') }}
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="deadlift_3_no_valido" class="font-medium text-gray-700">No válido</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Actualizar Competencia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection