<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Registrar riesgo" subtitle="Identificación y evaluación inherente (probabilidad × impacto)" icon="alert" />
    </x-slot>

    <div class="mx-auto max-w-5xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        @if ($processes->isEmpty())
            <x-card>
                <x-empty-state icon="flow" title="Primero necesitas procesos"
                               description="Cada riesgo se asocia a un proceso. Registra al menos uno para continuar.">
                    <x-btn :href="route('processes.create')" icon="plus">Registrar proceso</x-btn>
                </x-empty-state>
            </x-card>
        @else
            <form method="POST" action="{{ route('risks.store') }}"
                  x-data="{
                      area: '{{ old('area_id', $areas->first()->id ?? '') }}',
                      prob: {{ (int) old('probability', 1) }},
                      imp: {{ (int) old('impact', 1) }},
                      hasProcesses: true,
                      syncProcess() {
                          this.$nextTick(() => {
                              const select = this.$refs.proc;
                              const options = [...select.options].filter(o => o.dataset.area == this.area);
                              this.hasProcesses = options.length > 0;
                              if (! options.includes(select.selectedOptions[0]) && options.length) select.value = options[0].value;
                          });
                      },
                      init() { this.syncProcess(); this.$watch('area', () => this.syncProcess()); },
                      get score() { return this.prob * this.imp },
                      get zone() {
                          if (this.score >= 13) return { label: 'Extremo', cls: 'bg-red-600 text-white' };
                          if (this.score >= 6)  return { label: 'Alto', cls: 'bg-orange-500 text-white' };
                          if (this.score >= 2)  return { label: 'Moderado', cls: 'bg-amber-400 text-slate-900' };
                          return { label: 'Bajo', cls: 'bg-emerald-500 text-white' };
                      }
                  }">
                @csrf

                <x-card>
                    <div class="space-y-8">
                        <x-form-errors />

                        <x-form-section step="1" title="Ubicación" description="¿En qué área y proceso se materializa el riesgo?">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="area_id" value="Área organizacional" />
                                    <x-select id="area_id" name="area_id" required x-model="area">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error :messages="$errors->get('area_id')" />
                                </div>
                                <div>
                                    <x-input-label for="process_id" value="Proceso" />
                                    <x-select id="process_id" name="process_id" required x-ref="proc">
                                        @foreach ($processes as $proc)
                                            <option value="{{ $proc->id }}" data-area="{{ $proc->area_id }}"
                                                    x-show="area == '{{ $proc->area_id }}'" :disabled="area != '{{ $proc->area_id }}'"
                                                    @selected(old('process_id') == $proc->id)>{{ $proc->name }}</option>
                                        @endforeach
                                    </x-select>
                                    <p class="mt-1.5 text-xs text-slate-400" x-show="hasProcesses">Solo se listan los procesos del área seleccionada.</p>
                                    <p class="mt-1.5 text-xs font-medium text-amber-600" x-show="!hasProcesses" x-cloak>
                                        Esta área no tiene procesos. <a href="{{ route('processes.create') }}" class="underline">Registra uno</a>.
                                    </p>
                                    <x-input-error :messages="$errors->get('process_id')" />
                                </div>
                            </div>
                        </x-form-section>

                        <hr class="border-slate-100">

                        <x-form-section step="2" title="Descripción" description="Qué puede salir mal, por qué y con qué efecto.">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="code" value="Código del riesgo" />
                                    <x-text-input id="code" type="text" name="code" :value="old('code')" required maxlength="20" placeholder="Ej: RSCI-35" class="font-mono uppercase" />
                                    <x-input-error :messages="$errors->get('code')" />
                                </div>
                                <div>
                                    <x-input-label for="category" value="Categoría" />
                                    <x-select id="category" name="category" required>
                                        @foreach (['Estratégico' => 'Estratégico', 'Operacional' => 'Operacional', 'Financiero' => 'Financiero', 'Cumplimiento' => 'Cumplimiento / Legal', 'Tecnológico' => 'Tecnológico / Seguridad'] as $value => $label)
                                            <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error :messages="$errors->get('category')" />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="description" value="Descripción del evento de riesgo" />
                                <textarea id="description" name="description" required rows="3" placeholder="Detalla qué puede salir mal…" class="textarea-modern">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" />
                            </div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="cause" value="Causas raíz (opcional)" />
                                    <textarea id="cause" name="cause" rows="2" class="textarea-modern">{{ old('cause') }}</textarea>
                                </div>
                                <div>
                                    <x-input-label for="consequence" value="Consecuencias (opcional)" />
                                    <textarea id="consequence" name="consequence" rows="2" class="textarea-modern">{{ old('consequence') }}</textarea>
                                </div>
                            </div>
                        </x-form-section>

                        <hr class="border-slate-100">

                        <x-form-section step="3" title="Evaluación inherente" description="Califica el riesgo antes de considerar controles.">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <x-input-label for="probability" value="Probabilidad" />
                                    <x-select id="probability" name="probability" required x-model.number="prob">
                                        @foreach ([1 => 'Improbable', 2 => 'Rara vez', 3 => 'Posible', 4 => 'Probable', 5 => 'Casi cierto'] as $v => $l)
                                            <option value="{{ $v }}">{{ $v }} · {{ $l }}</option>
                                        @endforeach
                                    </x-select>
                                </div>
                                <div>
                                    <x-input-label for="impact" value="Impacto" />
                                    <x-select id="impact" name="impact" required x-model.number="imp">
                                        @foreach ([1 => 'Insignificante', 2 => 'Menor', 3 => 'Moderado', 4 => 'Mayor', 5 => 'Catastrófico'] as $v => $l)
                                            <option value="{{ $v }}">{{ $v }} · {{ $l }}</option>
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>

                            {{-- Vista previa en vivo --}}
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Score inherente</p>
                                    <p class="text-2xl font-bold text-slate-900"><span x-text="score"></span><span class="text-sm font-normal text-slate-400"> / 25</span></p>
                                </div>
                                <span class="rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider transition" :class="zone.cls" x-text="zone.label"></span>
                            </div>
                        </x-form-section>

                        <x-form-actions :cancel="route('risks.index')">
                            <x-btn icon="check">Registrar riesgo</x-btn>
                        </x-form-actions>
                    </div>
                </x-card>
            </form>
        @endif
    </div>
</x-app-layout>
