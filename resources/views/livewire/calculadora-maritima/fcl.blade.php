<div class="space-y-6">
    <!-- Card: Búsqueda de Rutas FCL -->
    <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/20 rounded-2xl p-6 shadow-xl relative z-10 overflow-visible">
        <h3 class="text-yellow-500 font-bold mb-6 text-lg uppercase tracking-widest flex items-center">
            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM2 12a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2z"/>
            </svg>
            Cotizador de Contenedores FCL
        </h3>
        <p class="text-gray-400 text-sm mb-6">Busca tarifas en tiempo real para contenedores completos (20' y 40')</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-50">
            <!-- Puerto Origen (POL) con Autocompletado -->
            <div class="relative z-[60]">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    Puerto de Origen (POL)
                </label>
                <input 
                    type="text" 
                    wire:model.live="searchPOL"
                    x-data
                    x-on:click.away="$wire.showPOLDropdown = false"
                    placeholder="Buscar: Shenzhen, CNSZN, China..."
                    class="w-full px-4 py-3 bg-black/40 border border-yellow-500/30 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                    autocomplete="off">
                
                <!-- Dropdown de Sugerencias POL -->
                @if($showPOLDropdown && count($polSuggestions) > 0)
                    <div class="absolute z-[9999] w-full mt-1 bg-white border-2 border-gray-200 rounded-lg shadow-2xl overflow-hidden" 
                         x-data="{ activeRegion: null }"
                         style="min-width: 800px; left: 0;">
                        
                        <!-- Pestañas de Regiones -->
                        <div class="border-b border-gray-200 bg-gray-50 p-3">
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $regions = collect($polSuggestions)->pluck('region')->unique()->values();
                                @endphp
                                @foreach($regions as $index => $region)
                                    <button 
                                        type="button"
                                        @click="activeRegion = activeRegion === '{{ $region }}' ? null : '{{ $region }}'"
                                        :class="activeRegion === '{{ $region }}' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                                        class="px-4 py-2 rounded text-sm font-medium transition-all border border-gray-300">
                                        {{ $region }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Lista de Puertos -->
                        <div class="max-h-80 overflow-y-auto p-3 bg-white">
                            @foreach($regions as $region)
                                <div x-show="activeRegion === '{{ $region }}' || activeRegion === null">
                                    @if($loop->first || true)
                                        <div class="mb-4">
                                            <h4 class="text-xs font-bold text-gray-500 uppercase mb-2 px-2" x-show="activeRegion === null">{{ $region }}</h4>
                                            <div class="grid grid-cols-4 gap-2">
                                                @foreach($polSuggestions as $port)
                                                    @if($port['region'] === $region)
                                                        <button 
                                                            type="button"
                                                            wire:click="selectPOL('{{ $port['code'] }}', '{{ $port['name'] }}')"
                                                            class="text-left px-3 py-2 hover:bg-blue-50 rounded transition-colors text-sm text-gray-700 hover:text-blue-600">
                                                            {{ $port['name'] }}
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if($polCode)
                    <p class="text-xs text-green-400 mt-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Seleccionado: {{ $polCode }}
                    </p>
                @endif
            </div>

            <!-- Puerto Destino (POD) con Autocompletado -->
            <div class="relative z-[50]">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    Puerto de Destino (POD)
                </label>
                <input 
                    type="text" 
                    wire:model.live="searchPOD"
                    x-data
                    x-on:click.away="$wire.showPODDropdown = false"
                    placeholder="Buscar: Singapore, SGSGP, USA..."
                    class="w-full px-4 py-3 bg-black/40 border border-yellow-500/30 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                    autocomplete="off">
                
                <!-- Dropdown de Sugerencias POD -->
                @if($showPODDropdown && count($podSuggestions) > 0)
                    <div class="absolute z-[9999] w-full mt-1 bg-white border-2 border-gray-200 rounded-lg shadow-2xl overflow-hidden" 
                         x-data="{ activeRegion: null }"
                         style="min-width: 800px; right: 0;">
                        
                        <!-- Pestañas de Regiones -->
                        <div class="border-b border-gray-200 bg-gray-50 p-3">
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $regions = collect($podSuggestions)->pluck('region')->unique()->values();
                                @endphp
                                @foreach($regions as $index => $region)
                                    <button 
                                        type="button"
                                        @click="activeRegion = activeRegion === '{{ $region }}' ? null : '{{ $region }}'"
                                        :class="activeRegion === '{{ $region }}' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'"
                                        class="px-4 py-2 rounded text-sm font-medium transition-all border border-gray-300">
                                        {{ $region }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Lista de Puertos -->
                        <div class="max-h-80 overflow-y-auto p-3 bg-white">
                            @foreach($regions as $region)
                                <div x-show="activeRegion === '{{ $region }}' || activeRegion === null">
                                    @if($loop->first || true)
                                        <div class="mb-4">
                                            <h4 class="text-xs font-bold text-gray-500 uppercase mb-2 px-2" x-show="activeRegion === null">{{ $region }}</h4>
                                            <div class="grid grid-cols-4 gap-2">
                                                @foreach($podSuggestions as $port)
                                                    @if($port['region'] === $region)
                                                        <button 
                                                            type="button"
                                                            wire:click="selectPOD('{{ $port['code'] }}', '{{ $port['name'] }}')"
                                                            class="text-left px-3 py-2 hover:bg-blue-50 rounded transition-colors text-sm text-gray-700 hover:text-blue-600">
                                                            {{ $port['name'] }}
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @if($podCode)
                    <p class="text-xs text-green-400 mt-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Seleccionado: {{ $podCode }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Resultados de Tarifas -->
    @if(count($fclRates) > 0)
        <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/20 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-yellow-500 font-bold text-lg uppercase tracking-widest flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                    Tarifas Disponibles
                </h3>
                <span class="text-sm text-gray-400">{{ count($fclRates) }} opciones encontradas</span>
            </div>

            <div class="space-y-4">
                @foreach($fclRates as $rate)
                    <div class="bg-black/30 border border-yellow-500/20 rounded-xl p-5 hover:border-yellow-500/50 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-yellow-500/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-base">{{ $rate['shippingLine'] }}</h4>
                                    <p class="text-xs text-gray-400">Válido hasta: {{ $rate['validUntil'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 text-xs text-gray-400">
                                <div class="text-center">
                                    <p class="text-yellow-400 font-bold">{{ $rate['transitTime'] }} días</p>
                                    <p>Tránsito</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-yellow-400 font-bold">{{ $rate['closing'] }} días</p>
                                    <p>Cierre</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-yellow-500/10">
                            <div class="text-center">
                                <p class="text-xs text-gray-400 mb-1">20' Standard</p>
                                <p class="text-xl font-bold text-yellow-400">${{ $rate['price']['gp20'] }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-400 mb-1">40' Standard</p>
                                <p class="text-xl font-bold text-yellow-400">${{ $rate['price']['gp40'] }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-400 mb-1">40' High Cube</p>
                                <p class="text-xl font-bold text-yellow-400">${{ $rate['price']['hq40'] }}</p>
                            </div>
                        </div>

                        <button class="w-full mt-4 bg-gradient-to-r from-yellow-500 to-amber-500 hover:from-yellow-400 hover:to-amber-400 text-black font-bold py-3 px-4 rounded-lg transition-all transform hover:scale-105">
                            Solicitar Cotización
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif($loadingRates)
        <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/20 rounded-2xl p-12 shadow-xl text-center">
            <svg class="animate-spin h-12 w-12 mx-auto mb-4 text-yellow-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-300 font-medium">Buscando mejores tarifas...</p>
        </div>
    @else
        <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/20 rounded-2xl p-12 shadow-xl text-center">
            <div class="w-20 h-20 mx-auto mb-6 bg-yellow-500/5 border-2 border-yellow-500/20 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-yellow-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-sm">Selecciona los puertos de origen y destino para ver las tarifas disponibles</p>
        </div>
    @endif

    <!-- Botón Limpiar -->
    <div class="flex justify-end">
        <button wire:click="limpiar"
            class="bg-white/5 hover:bg-white/10 text-gray-300 font-bold py-3 px-8 rounded-xl border border-white/10 hover:border-yellow-500/50 transition-all">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Limpiar Búsqueda
        </button>
    </div>
</div>
