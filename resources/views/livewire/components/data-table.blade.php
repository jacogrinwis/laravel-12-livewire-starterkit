<?php

use App\Support\Format;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    public $tableId = 'default';
    public $model;            
    public $columns = [];      
    public $searchable = [];  
    public $sortable = [];    
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $actions = true;
    public $showAction = true;
    public $editAction = true;
    public $deleteAction = true;
    public $createEvent = 'create-item';
    public $showEvent = 'show-item';
    public $editEvent = 'edit-item';
    public $deleteEvent = 'delete-item';
    public $showCreateButton = false;
    public $createButtonText = 'Create';
    public $createButtonIcon = 'plus';
    public $createModalName = '';
    public $formatters = [];
    
    // Change the property name to avoid conflict with the with() method
    public $eagerLoad = [];

    public function create()
    {
        if ($this->createModalName) {
            // If a modal name is provided, open that modal
            $this->dispatch('open-modal', ['name' => $this->createModalName]);
        } else {
            // Otherwise dispatch the create event
            $this->dispatch($this->createEvent);
        }
    }
   
    public function updatedSearch()
    {
        $this->resetPage();
    }
   
    public function sortBy($field)
    {
        // Only sort if the column is marked as sortable
        if (!in_array($field, $this->sortable)) {
            return;
        }
       
        if ($this->sortField === $field) {
            // Toggle sort direction if same column clicked
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Set new sort column and default to ascending
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
       
        // Reset to page 1 when sort changes
        $this->resetPage();
    }

    public function formatValue($item, $key)
    {
        // Handle relationship properties with dot notation (e.g., carrier.name)
        if (str_contains($key, '.')) {
            $parts = explode('.', $key);
            $value = $item;
        
            foreach ($parts as $part) {
                if (is_null($value)) {
                    return null;
                }
                $value = $value->{$part};
            }
        
            return $value;
        }

        // If a custom formatter exists for this column, use it
        if (isset($this->formatters[$key])) {
            // If formatter is a string, use predefined formatting
            if (is_string($this->formatters[$key])) {
                switch ($this->formatters[$key]) {
                    case 'currency':
                        return Format::toCurrency($item->$key);
                    case 'weight':
                        return Format::toComma($item->$key) . ' g';
                    case 'size':
                        // This is for displaying the formatted size
                        $sizes = [];
                        if ($item->length) $sizes[] = Format::toComma($item->length);
                        if ($item->width) $sizes[] = Format::toComma($item->width);
                        if ($item->height) $sizes[] = Format::toComma($item->height);
                        
                        if (empty($sizes)) {
                            return '';
                        }
                        
                        return implode(' x ', $sizes) . ' cm';
                    default:
                        return $item->$key;
                }
            } else if (is_callable($this->formatters[$key])) {
                // Keep existing callable support
                return call_user_func($this->formatters[$key], $item, $key);
            }
        }
    
        // Default formatting based on value type
        if (isset($item->$key)) {
            // Auto-format Carbon dates using diffForHumans
            if ($item->$key instanceof \Carbon\Carbon) {
                return $item->$key->diffForHumans();
            }
        
            // Return unmodified value for other types
            return $item->$key;
        }
    
        // Return null if property doesn't exist
        return null;
    }

    public function getDataProperty()
    {
        $query = $this->model::query();

        // Use eagerLoad property instead of with
        if (!empty($this->eagerLoad)) {
            $query->with($this->eagerLoad);
        }
    
        // Apply search filters if search is not empty and searchable columns exist
        if (!empty($this->search) && !empty($this->searchable)) {
            $query->where(function($q) {
                // Convert search term for number formats (replace comma with period)
                $convertedSearch = str_replace(',', '.', $this->search);
                
                foreach ($this->searchable as $column) {
                    // Check if column contains a relationship reference
                    if (str_contains($column, '.')) {
                        $parts = explode('.', $column);
                        $relationship = $parts[0];
                        $field = $parts[1];
                        
                        $q->orWhereHas($relationship, function($query) use ($field) {
                            $query->where($field, 'like', '%' . $this->search . '%');
                        });
                    } else {
                        // For numeric columns (price, weight, etc.), search using the converted value
                        if (in_array($column, ['price', 'weight', 'length', 'width', 'height'])) {
                            $q->orWhere($column, 'like', '%' . $convertedSearch . '%')
                            ->orWhere($column, 'like', '%' . $this->search . '%'); // Try both formats
                        } else {
                            $q->orWhere($column, 'like', '%' . $this->search . '%');
                        }
                    }
                }
            });
        }
    
        // Apply current sort settings
        $query->orderBy($this->sortField, $this->sortDirection);
    
        // Return paginated results
        return $query->paginate($this->perPage);
    }

   
    public function show($id)
    {
        $this->dispatch($this->showEvent, $id);
    }
   
    public function edit($id)
    {
        $this->dispatch($this->editEvent, $id);
    }
   
    public function delete($id)
    {
        $this->dispatch($this->deleteEvent, $id);
    }

    #[On('reload-datatable')]
    public function reloadData($tableId = null)
    {
        if ($tableId === null || $tableId === $this->tableId) {}
    }
   
    public function with(): array
    {
        return [
            'data' => $this->data,
        ];
    }
}; ?>

<div>
    <!-- Header section with search and create button -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-4">
        @if(count($searchable) > 0)
            <!-- Search input - only shown if searchable columns exist -->
            <flux:input
                wire:model.live.debounce.250ms="search"
                placeholder="Zoeken..."
                icon="magnifying-glass"
                class="w-full sm:w-80"
                clearable
            />
        @else
            <!-- Empty div to maintain spacing when search is not shown -->
            <div></div>
        @endif

        <!-- Create button section - configurable through component properties -->
        @if($showCreateButton)
            @if($createModalName)
                <!-- Modal trigger version if a modal name is specified -->
                <flux:modal.trigger name="{{ $createModalName }}">
                    <flux:button icon="{{ $createButtonIcon }}" variant="primary" class="w-full sm:w-auto">
                        {{ $createButtonText }}
                    </flux:button>
                </flux:modal.trigger>
            @else
                <!-- Event dispatch version if no modal name is specified -->
                <flux:button icon="{{ $createButtonIcon }}" variant="primary" wire:click="create" class="w-full sm:w-auto">
                    {{ $createButtonText }}
                </flux:button>
            @endif
        @endif
    </div>

    <!-- Main data table -->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
            <!-- Table header with sortable columns -->
            <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
                <tr>
                    @foreach($columns as $key => $column)
                        <th scope="col" class="px-6 py-3">
                            @if(in_array($key, $sortable))
                                <!-- Sortable column with click handler and direction indicators -->
                                <div class="flex items-center cursor-pointer" wire:click="sortBy('{{ $key }}')">
                                    {{ $column }}
                                    @if ($sortField === $key)
                                        <!-- Show sort direction indicator for active sort column -->
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                <!-- Ascending sort indicator (arrow up) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                </svg>
                                            @else
                                                <!-- Descending sort indicator (arrow down) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            @else
                                <!-- Non-sortable column (just display the label) -->
                                {{ $column }}
                            @endif
                        </th>
                    @endforeach
                   
                    <!-- Actions column header (if actions are enabled) -->
                    @if($actions)
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    @endif
                </tr>
            </thead>
            <!-- Table body with data rows -->
            <tbody>
                @foreach ($data as $item)
                    <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700 border-zinc-200">
                        <!-- Data cells with formatted values -->
                        @foreach($columns as $key => $column)
                            @if ($loop->first)
                                <th scope="row" class="px-6 py-4 font-medium text-zinc-900 dark:text-white whitespace-nowrap">
                                    {{ $this->formatValue($item, $key) }}
                                </th>
                            @else
                                <td class="px-6 py-4">
                                    {{ $this->formatValue($item, $key) }}
                                </td>
                            @endif
                        @endforeach
                       
                        <!-- Actions dropdown for each row (if actions are enabled) -->
                        @if($actions)
                            <td class="px-6 py-4 flex items-center justify-end">
                                <flux:dropdown position="bottom" align="end">
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                                    <flux:navmenu>
                                        <!-- Show action (if enabled) -->
                                        @if($showAction)
                                            <flux:navmenu.item wire:click="show({{ $item->id }})" icon="eye">Show</flux:navmenu.item>
                                        @endif
                                       
                                        <!-- Edit action (if enabled) -->
                                        @if($editAction)
                                            <flux:navmenu.item wire:click="edit({{ $item->id }})" icon="pencil">Edit</flux:navmenu.item>
                                        @endif
                                       
                                        <!-- Separator between main actions and danger actions -->
                                        @if($showAction || $editAction)
                                            <flux:menu.separator />
                                        @endif
                                       
                                        <!-- Delete action (if enabled) -->
                                        @if($deleteAction)
                                            <flux:navmenu.item wire:click="delete({{ $item->id }})" icon="trash" variant="danger">Delete</flux:navmenu.item>
                                        @endif
                                    </flux:navmenu>
                                </flux:dropdown>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination links -->
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>
</div>
