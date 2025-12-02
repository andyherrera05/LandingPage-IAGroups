<div class="min-h-screen bg-black text-white">
    <!-- Background Effects -->
    <div class="fixed inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-yellow-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-yellow-600 rounded-full blur-3xl"></div>
    </div>

    <header class="bg-white/5 backdrop-blur-xl border-b border-yellow-500/20 sticky top-0 z-50 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-6">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center space-x-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-yellow-500/10 border-2 border-yellow-500/30 rounded-lg flex items-center justify-center">
                        <img src="/images/logo.png" alt="IA Groups Logo" class="w-full h-full object-contain">
                        <svg class="w-7 h-7 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-widest text-yellow-500">IA GROUPS</h1>
                </a>
                <a href="/" class="text-yellow-400 hover:text-yellow-300 font-medium transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Volver</span>
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-4xl sm:text-5xl font-black text-white mb-4">
                CALCULADORA <span class="text-yellow-500">AÉREA</span>
            </h2>
            <p class="text-gray-400 text-lg">Calcula el costo de tus envíos aéreos express</p>
        </div>

        @if (session()->has('success'))
            <div class="bg-yellow-500/10 border border-yellow-500 text-yellow-500 px-6 py-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-400 px-6 py-4 rounded-lg mb-6">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg hover:border-yellow-500 transition-all">
                    <label class="block text-yellow-500 font-bold mb-4 text-sm uppercase tracking-wide">Tipo de Servicio</label>
                    <div class="grid grid-cols-3 gap-4">
                        <button wire:click="$set('tipoCarga', 'lcl')"
                            class="px-4 py-4 border-2 rounded-lg font-bold transition-all transform hover:scale-105 {{ $tipoCarga === 'lcl' ? 'border-yellow-500 bg-yellow-500 text-black shadow-lg shadow-yellow-500/50' : 'border-yellow-500/30 text-yellow-400 hover:border-yellow-500' }}">
                            ESTÁNDAR<span class="block text-xs font-normal mt-1 {{ $tipoCarga === 'lcl' ? 'text-black/70' : 'text-gray-500' }}">3-5 días</span>
                        </button>
                        <button wire:click="$set('tipoCarga', 'fcl')"
                            class="px-4 py-4 border-2 rounded-lg font-bold transition-all transform hover:scale-105 {{ $tipoCarga === 'fcl' ? 'border-yellow-500 bg-yellow-500 text-black shadow-lg shadow-yellow-500/50' : 'border-yellow-500/30 text-yellow-400 hover:border-yellow-500' }}">
                            EXPRESS<span class="block text-xs font-normal mt-1 {{ $tipoCarga === 'fcl' ? 'text-black/70' : 'text-gray-500' }}">1-2 días</span>
                        </button>
                        <button wire:click="$set('tipoCarga', 'uld')"
                            class="px-4 py-4 border-2 rounded-lg font-bold transition-all transform hover:scale-105 {{ $tipoCarga === 'uld' ? 'border-yellow-500 bg-yellow-500 text-black shadow-lg shadow-yellow-500/50' : 'border-yellow-500/30 text-yellow-400 hover:border-yellow-500' }}">
                            CARGA<span class="block text-xs font-normal mt-1 {{ $tipoCarga === 'uld' ? 'text-black/70' : 'text-gray-500' }}">Pallets/ULD</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg hover:border-yellow-500 transition-all">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-yellow-500 font-bold mb-2 text-sm uppercase tracking-wide">Aeropuerto Origen</label>
                            <input type="text" wire:model="origen" placeholder="Ej: JFK - Nueva York"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition-all rounded-lg placeholder-gray-600">
                        </div>
                        <div>
                            <label class="block text-yellow-500 font-bold mb-2 text-sm uppercase tracking-wide">Aeropuerto Destino</label>
                            <input type="text" wire:model="destino" placeholder="Ej: EZE - Buenos Aires"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition-all rounded-lg placeholder-gray-600">
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg hover:border-yellow-500 transition-all">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-yellow-500 font-bold mb-2 text-sm uppercase tracking-wide">Peso (kg) *</label>
                            <input type="number" wire:model="peso" step="0.01" placeholder="100"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition-all rounded-lg" required>
                        </div>
                        <div>
                            <label class="block text-yellow-500 font-bold mb-2 text-sm uppercase tracking-wide">Volumen (m³) *</label>
                            <input type="number" wire:model="volumen" step="0.001" placeholder="0.5"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition-all rounded-lg" required>
                        </div>
                    </div>
                    <p class="text-yellow-600 text-xs mt-2">* Se cobrará por peso volumétrico si es mayor (factor 167 kg/m³)</p>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg hover:border-yellow-500 transition-all">
                    <h3 class="text-yellow-500 font-bold mb-4 text-sm uppercase tracking-wide">Calculadora Volumen</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-400 mb-2 text-xs">Largo (cm)</label>
                            <input type="number" wire:model="largo" wire:change="calcularVolumen" placeholder="50"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 transition-all rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-400 mb-2 text-xs">Ancho (cm)</label>
                            <input type="number" wire:model="ancho" wire:change="calcularVolumen" placeholder="40"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 transition-all rounded-lg">
                        </div>
                        <div>
                            <label class="block text-gray-400 mb-2 text-xs">Alto (cm)</label>
                            <input type="number" wire:model="alto" wire:change="calcularVolumen" placeholder="30"
                                class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 transition-all rounded-lg">
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg hover:border-yellow-500 transition-all">
                    <label class="block text-yellow-500 font-bold mb-2 text-sm uppercase tracking-wide">Valor Mercancía (USD)</label>
                    <input type="number" wire:model="valorMercancia" step="0.01" placeholder="2000"
                        class="w-full bg-black/50 border border-yellow-500/30 text-white px-4 py-3 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition-all rounded-lg">
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg hover:border-yellow-500 transition-all">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="urgente" class="w-5 h-5 text-yellow-500 bg-black/50 border-yellow-500/30 rounded focus:ring-yellow-500 focus:ring-2">
                        <span class="ml-3 text-yellow-400 font-bold">SERVICIO URGENTE (+30%)</span>
                    </label>
                    <p class="text-gray-500 text-xs mt-2 ml-8">Entrega en 24-48 horas</p>
                </div>

                <div class="flex space-x-4">
                    <button wire:click="calcular" 
                        class="flex-1 bg-yellow-500 hover:bg-yellow-400 text-black font-black py-4 px-6 text-lg uppercase tracking-wider transition-all transform hover:scale-105 shadow-xl hover:shadow-yellow-500/50 rounded-lg">
                        CALCULAR
                    </button>
                    <button wire:click="limpiar" 
                        class="bg-white/5 border border-yellow-500/30 hover:border-yellow-500 text-yellow-400 font-bold py-4 px-6 uppercase transition-all rounded-lg">
                        LIMPIAR
                    </button>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white/5 backdrop-blur-xl border border-yellow-500/30 p-6 rounded-lg sticky top-24">
                    <h2 class="text-2xl font-black text-yellow-500 mb-6 uppercase">Resultado</h2>
                    
                    @if ($resultado !== null)
                        <div class="bg-yellow-500 text-black p-8 rounded-lg mb-6 text-center transform hover:scale-105 transition-transform">
                            <p class="text-sm font-bold mb-2 uppercase tracking-wide">Total Estimado</p>
                            <p class="text-5xl font-black">${{ $resultado }}</p>
                            <p class="text-xs mt-2 opacity-70">USD</p>
                        </div>
                        
                        @if (count($desglose) > 0)
                            <div class="space-y-3">
                                <h3 class="font-bold text-yellow-500 uppercase text-sm tracking-wide mb-4">Desglose:</h3>
                                @foreach ($desglose as $concepto => $valor)
                                    <div class="flex justify-between items-center py-2 border-b border-yellow-500/20 hover:border-yellow-500/50 transition-colors">
                                        <span class="text-gray-300 text-sm">{{ $concepto }}</span>
                                        <span class="font-bold text-white">
                                            @if (is_numeric($valor))
                                                {{ $valor }}
                                            @else
                                                ${{ $valor }}
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <svg class="w-20 h-20 mx-auto text-yellow-500/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <p class="text-gray-500">Completa el formulario</p>
                        </div>
                    @endif
                    
                    {{-- Pregunta interactiva sobre el precio --}}
                    @if ($mostrarPregunta && $resultado !== null)
                        <div class="mt-6 bg-gradient-to-br from-yellow-500/20 to-amber-500/10 border-2 border-yellow-500 rounded-lg p-6 animate-pulse" style="animation-duration: 2s;">
                            @if ($respuestaUsuario === null)
                                {{-- Pregunta inicial --}}
                                <h3 class="text-2xl font-black text-yellow-500 text-center mb-6">
                                    ¿Te gusta el precio?
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <button wire:click="responder('si')" 
                                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-lg transform hover:scale-110 transition-all shadow-lg flex items-center justify-center space-x-2">
                                        <span class="text-2xl">😊</span>
                                        <span>SÍ</span>
                                    </button>
                                    <button wire:click="responder('no')" 
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-6 rounded-lg transform hover:scale-110 transition-all shadow-lg flex items-center justify-center space-x-2">
                                        <span class="text-2xl">😕</span>
                                        <span>NO</span>
                                    </button>
                                </div>
                            @else
                                {{-- Respuesta basada en la elección --}}
                                <div class="text-center">
                                    @if ($respuestaUsuario === 'si')
                                        <div class="mb-4">
                                            <svg class="w-16 h-16 mx-auto text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-green-500 mb-4">
                                            ¡Ponte en contacto ya mismo con nosotros!
                                        </h3>
                                    @else
                                        <div class="mb-4">
                                            <svg class="w-16 h-16 mx-auto text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-yellow-500 mb-4">
                                            ¡Tranquilo, podemos negociarlo!
                                        </h3>
                                    @endif
                                    
                                    <a href="https://wa.me/5491123456789?text=Hola!%20Vi%20el%20precio%20del%20envío%20aéreo%20de%20${{ $resultado }}%20y%20me%20gustaría%20más%20información." 
                                       target="_blank"
                                       class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transform hover:scale-110 transition-all shadow-lg mt-2">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                        <span>Contáctanos</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8 bg-yellow-500/10 border-l-4 border-yellow-500 p-6 rounded">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-yellow-500 mr-4 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-yellow-400 font-bold mb-1">Nota Importante</p>
                    <p class="text-gray-400 text-sm">Los cálculos son estimaciones. Para cotización final contacta con nuestro equipo comercial.</p>
                </div>
            </div>
        </div>
    </div>
</div>
