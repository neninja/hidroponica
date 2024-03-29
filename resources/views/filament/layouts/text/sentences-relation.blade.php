<div>
@php
$sentences = $this->getRelationship()->get();

$action = \Illuminate\Support\Facades\Auth::user()->can('update', $this->ownerRecord)
    ? 'edit' : 'view';
@endphp
    <x-filament-actions::modals />
    <div
        x-data="{
            id: null,
        }"
    >
        <x-filament::grid class="gap-4">
            <x-filament::section>
                <x-slot name="heading">
                    Texto Original
                </x-slot>
                <div class="flex flex-col gap-4">
                    <div>
                        <p>
                        @foreach ($this->ownerRecord->sentences as $i => $sentence)
                            @if($sentence->new_paragraph && $i > 0)
                                </p>
                            @elseif($sentence->new_paragraph)
                                <p>
                            @endif
                            <span
                                class="cursor-pointer"
                                wire:loading.attr="disabled"
                                :class="{ 'bg-red-200 dark:bg-blue-800': id == '{{$sentence->id}}'}"
                                wire:click="mountTableAction('{{$action}}', '{{$sentence->id}}')"
                                @mouseenter="id = '{{$sentence->id}}'"
                                @mouseleave="id=null"
                            >
                                {{$sentence->content}}
                            </span>
                        @endforeach
                        </p>
                    </div>
                    <div>
                        <x-filament::button wire:click="mountTableAction('create')" icon="heroicon-m-plus">
                            Adicionar sentença
                        </x-filament::button>
                    </div>
                </div>
            </x-filament::section>
            <!-- create section por languagen for tanslate-->
            @foreach ($this->ownerRecord->translatedSentencesGroupByLanguage() as $language => $translatedSentences)
                <x-filament::section>
                    <x-slot name="heading">
                        {{\App\Enums\LanguageType::tryFrom($language)->getLabel()}}
                    </x-slot>
                    <p>
                    @foreach ($translatedSentences as $translatedSentence)
                        @if($translatedSentence->sentence->new_paragraph && $i > 0)
                            </p>
                        @elseif($translatedSentence->sentence->new_paragraph)
                            <p>
                        @endif
                        <span
                            class="cursor-pointer"
                            wire:loading.attr="disabled"
                            :class="{ 'bg-red-200 dark:bg-blue-800': id == '{{$translatedSentence->sentence->id}}'}"
                            wire:click="mountTableAction('{{$action}}', '{{$translatedSentence->sentence->id}}')"
                            @mouseenter="id = '{{$translatedSentence->sentence->id}}'"
                            @mouseleave="id=null"
                        >
                            {{$translatedSentence->content}}
                        </span>
                    @endforeach
                    </p>
                </x-filament::section>
            @endforeach
        </x-filament::grid.column>
    </div>
</div>
