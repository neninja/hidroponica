<div>
@php
$sentences = $this->getRelationship()->get();
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
                <p>
                @foreach ($this->ownerRecord->sentences as $sentence)
                    @if($sentence->new_paragraph)
                    </p>
                    <p>
                        <span
                            class="cursor-pointer"
                            wire:loading.attr="disabled"
                            :class="{ 'bg-red-200': id == {{$sentence->id}}}"
                            wire:click="mountTableAction('edit', '{{$sentence->id}}')"
                            @mouseenter="id = {{$sentence->id}}"
                        >
                            {{$sentence->content}}
                        </span>
                    @else
                    @endif
                        <span
                            class="cursor-pointer"
                            wire:loading.attr="disabled"
                            :class="{ 'bg-red-200': id == {{$sentence->id}}}"
                            wire:click="mountTableAction('edit', '{{$sentence->id}}')"
                            @mouseenter="id = {{$sentence->id}}"
                        >
                            {{$sentence->content}}
                        </span>
                @endforeach
                </p>
            </x-filament::section>
            <!-- create section por languagen for tanslate-->
            @foreach ($this->ownerRecord->sentencasTraduzidasAgrupadas() as $language => $sentence)
                <x-filament::section>
                    <x-slot name="heading">
                        {{\App\Enums\LanguageType::tryFrom($language)->getLabel()}}
                    </x-slot>
                    <p>
                    @foreach ($sentence as $sentence)
                        @if($sentence->new_paragraph)
                        </p>
                        <p>
                            <span
                                class="cursor-pointer"
                                wire:loading.attr="disabled"
                                :class="{ 'bg-red-200': id == {{$sentence->id}}}"
                                wire:click="mountTableAction('edit', '{{$sentence->id}}')"
                                @mouseenter="id = {{$sentence->id}}"
                            >
                                {{$sentence->content}}
                            </span>
                        @else
                        @endif
                            <span
                                class="cursor-pointer"
                                wire:loading.attr="disabled"
                                :class="{ 'bg-red-200': id == {{$sentence->id}}}"
                                wire:click="mountTableAction('edit', '{{$sentence->id}}')"
                                @mouseenter="id = {{$sentence->id}}"
                            >
                                {{$sentence->content}}
                            </span>
                    @endforeach
                    </p>
                </x-filament::section>
            @endforeach
        </x-filament::grid.column>
    </div>
</div>
