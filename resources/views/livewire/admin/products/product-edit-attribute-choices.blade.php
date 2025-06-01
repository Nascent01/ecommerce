<div>
    <div class="container-fluid py-4">
        @include('partials.flash_messages_livewire')

        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive card">
                    <div class="card-header">
                        <h5 class="mb-0">Attached Attribute Choices</h5>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Attribute Name</th>
                                <th class="text-center" scope="col">Choice Name</th>
                                <th class="text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attributeChoices as $choice)
                                <tr>
                                    <td class="text-center">{{ $choice->productAttribute->name ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $choice->name }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger"
                                            wire:click="detachChoice({{ $choice->id }})"
                                            wire:confirm="Are you sure you want to detach this attribute choice?">
                                            <i class="fas fa-unlink"></i> Detach
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">
                                        No product attribute choices found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="py-3 mx-3">
                        {{ $attributeChoices->links('custom-pagination-links') }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add Attribute Choice</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group position-relative">
                            <label for="search-input" class="form-control-label">Find attribute choice</label>
                            <input type="text" class="form-control form-control-alternative" id="search-input"
                                wire:model.live.debounce.300ms="search" wire:blur="hideSuggestions"
                                placeholder="Type to search for attributes or choices..." autocomplete="off">

                            @if ($showSuggestions && count($suggestions) > 0)
                                <div class="suggestions-dropdown position-absolute w-100 bg-white border border-top-0 shadow-sm"
                                    style="z-index: 1000; max-height: 200px; overflow-y: auto;">
                                    @foreach ($suggestions as $suggestion)
                                        <div class="suggestion-item p-2 border-bottom cursor-pointer hover-bg-light"
                                            wire:click="selectChoice({{ $suggestion->id }})"
                                            onmouseover="this.style.backgroundColor='#f8f9fa'"
                                            onmouseout="this.style.backgroundColor='white'">
                                            <strong>{{ $suggestion->productAttribute->name }}</strong> -
                                            {{ $suggestion->name }}
                                            <br>
                                            <small
                                                class="text-muted">{{ $suggestion->description ?? 'No description' }}</small>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if ($showSuggestions && count($suggestions) == 0 && strlen($search) >= 2)
                                <div class="suggestions-dropdown position-absolute w-100 bg-white border border-top-0 shadow-sm"
                                    style="z-index: 1000;">
                                    <div class="p-3 text-center text-muted">
                                        No matching attribute choices found
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <button type="button" class="btn btn-primary" wire:click="attachChoice"
                                @if (!$selectedChoice) disabled @endif>
                                <i class="fas fa-link"></i> Attach Choice
                            </button>

                            <button type="button" class="btn btn-secondary ms-2" wire:click="resetSelection">
                                <i class="fas fa-times"></i> Clear
                            </button>
                        </div>

                        @if ($selectedChoice)
                            <div class="alert alert-info mt-3">
                                <strong>Selected:</strong> {{ $selectedChoice->productAttribute->name }} -
                                {{ $selectedChoice->name }}
                            </div>
                        @endif

                        <div class="form-group mt-3">
                            <h5 class="m-2">Filters</h5>
                            <label for="search-name" class="form-label">Filter attribute choice</label>
                            <div class="input-group">
                                <input wire:model.live="nameFilter" class="form-control" id="search-name"
                                    placeholder="Type to filter by attribute or choice names...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
