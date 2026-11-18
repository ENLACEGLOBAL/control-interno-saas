<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Vincular control mitigante" subtitle="Asocia un control a un riesgo y evalúa su diseño y efectividad (COSO)" icon="shield" />
    </x-slot>

    <div class="mx-auto max-w-5xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        @if ($risks->isEmpty())
            <x-card>
                <x-empty-state icon="alert" title="Primero necesitas riesgos"
                               description="Los controles mitigan riesgos identificados. Registra al menos uno para continuar.">
                    <x-btn :href="route('risks.create')" icon="plus">Registrar riesgo</x-btn>
                </x-empty-state>
            </x-card>
        @else
            <form method="POST" action="{{ route('controls.store') }}"
                  x-data="{
                      f: {{ (int) old('formal_score', 0) }},
                      a: {{ (int) old('application_score', 0) }},
                      e: {{ (int) old('effectiveness_score', 0) }},
                      get total() { return this.f + this.a + this.e },
                      get rating() {
                          if (this.total >= 80) return { label: 'Óptimo', cls: 'bg-emerald-100 text-emerald-800', bar: 'bg-emerald-500' };
                          if (this.total >= 50) return { label: 'Bueno', cls: 'bg-cyan-100 text-cyan-800', bar: 'bg-cyan-500' };
                          if (this.total >= 25) return { label: 'Débil', cls: 'bg-orange-100 text-orange-800', bar: 'bg-orange-400' };
                          return { label: 'Inaceptable', cls: 'bg-red-100 text-red-800', bar: 'bg-red-500' };
                      }
                  }">
                @csrf

                <x-card>
                    <div class="space-y-8">
                        <x-form-errors />

                        <x-form-section step="1" title="Vinculación" description="Riesgo que mitiga y área responsable de ejecutarlo.">
                            <div>
                                <x-input-label for="risk_id" value="Riesgo a mitigar" />
                                <x-select id="risk_id" name="risk_id" required>
                                    @foreach ($risks as $risk)
                                        <option value="{{ $risk->id }}" @selected(old('risk_id', request('risk')) == $risk->id)>{{ $risk->code }} — {{ \Illuminate\Support\Str::limit($risk->description, 70) }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('risk_id')" />
                            </div>
                            <div>
                                <x-input-label for="area_id" value="Área responsable" />
                                <x-select id="area_id" name="area_id" required>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" @selected(old('area_id') == $area->id)>{{ $area->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('area_id')" />
                            </div>
                        </x-form-section>

                        <hr class="border-slate-100">

                        <x-form-section step="2" title="Definición" description="Nombre y naturaleza del control.">
                            <div>
                                <x-input-label for="name" value="Nombre del control" />
                                <x-text-input id="name" type="text" name="name" :value="old('name')" required placeholder="Ej: Conciliación bancaria automatizada diaria" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                            <fieldset>
                                <legend class="mb-1.5 block text-sm font-medium text-slate-700">Tipo de control</legend>
                                <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                                    @foreach (['Preventivo' => 'Evita que ocurra', 'Detectivo' => 'Identifica anomalías', 'Correctivo' => 'Mitiga el impacto'] as $type => $hint)
                                        <label class="relative flex cursor-pointer flex-col rounded-xl border border-slate-200 p-3 transition hover:border-slate-300 has-[:checked]:border-slate-900 has-[:checked]:bg-slate-50 has-[:checked]:ring-1 has-[:checked]:ring-slate-900">
                                            <input type="radio" name="type" value="{{ $type }}" class="sr-only" required @checked(old('type', 'Preventivo') === $type)>
                                            <span class="text-sm font-semibold text-slate-900">{{ $type }}</span>
                                            <span class="text-xs text-slate-500">{{ $hint }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('type')" />
                            </fieldset>
                        </x-form-section>

                        <hr class="border-slate-100">

                        <x-form-section step="3" title="Evaluación SCI" description="Tres criterios ponderados que suman un máximo de 100 puntos.">
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <x-input-label for="formal_score">Formalidad <span class="font-normal text-slate-400">· 15 pts</span></x-input-label>
                                    <x-select id="formal_score" name="formal_score" required x-model.number="f">
                                        <option value="0">0 · Sin documentar</option>
                                        <option value="7">7 · Documentado, no aprobado</option>
                                        <option value="10">10 · Documentado y aprobado</option>
                                        <option value="15">15 · Aprobado y divulgado</option>
                                    </x-select>
                                </div>
                                <div>
                                    <x-input-label for="application_score">Aplicación <span class="font-normal text-slate-400">· 20 pts</span></x-input-label>
                                    <x-select id="application_score" name="application_score" required x-model.number="a">
                                        <option value="0">0 · Nunca se aplica</option>
                                        <option value="5">5 · A discreción e incompleto</option>
                                        <option value="10">10 · A discreción, debidamente</option>
                                        <option value="15">15 · Siempre, incompleto</option>
                                        <option value="20">20 · Siempre y debidamente</option>
                                    </x-select>
                                </div>
                                <div>
                                    <x-input-label for="effectiveness_score">Efectividad <span class="font-normal text-slate-400">· 65 pts</span></x-input-label>
                                    <x-select id="effectiveness_score" name="effectiveness_score" required x-model.number="e">
                                        <option value="0">0 · No es efectivo</option>
                                        <option value="15">15 · Solo eficiente</option>
                                        <option value="35">35 · Solo eficaz</option>
                                        <option value="65">65 · Eficiente y eficaz</option>
                                    </x-select>
                                </div>
                            </div>

                            {{-- Resultado en vivo --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Puntaje total</p>
                                        <p class="text-2xl font-bold text-slate-900"><span x-text="total"></span><span class="text-sm font-normal text-slate-400"> / 100</span></p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-bold" :class="rating.cls" x-text="rating.label"></span>
                                </div>
                                <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200">
                                    <div class="h-full rounded-full transition-all duration-300" :class="rating.bar" :style="`width: ${total}%`"></div>
                                </div>
                            </div>
                        </x-form-section>

                        <x-form-actions :cancel="route('controls.index')">
                            <x-btn icon="check">Vincular control</x-btn>
                        </x-form-actions>
                    </div>
                </x-card>
            </form>
        @endif
    </div>
</x-app-layout>
