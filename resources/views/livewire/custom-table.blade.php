@props([
    'config' => [
        'columns' => [],
        'data' => null,
        'actions' => [],
        'emptyMessage' => 'No records found.',
    ]
])

<div class="bg-light shadow-md rounded-md p-6 overflow-x-auto">
    <table class="w-full table-auto border-collapse min-w-max">
        <thead>
            <tr class="bg-gray-100">
                @foreach ($config['columns'] as $column)
                    <th class="px-4 py-2 text-left text-dark border border-gray-200 whitespace-nowrap">
                        {{ $column['label'] }}
                    </th>
                @endforeach
                @if (!empty($config['actions']))
                    <th class="px-4 py-2 text-left text-dark border border-gray-200 whitespace-nowrap">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($config['data'] as $row)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    @foreach ($config['columns'] as $column)
                        <td class="px-4 py-2 text-dark border border-gray-200 text-center whitespace-nowrap">
                            @if ($column['key'] === 'profile_image')
                                @if (data_get($row, $column['key']))
                                    <div class="flex justify-center">
                                        <img src="{{ Storage::url(data_get($row, $column['key'])) }}" alt="Profile Image" class="w-10 h-10 rounded-full object-cover">
                                    </div>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            @else
                                {{ data_get($row, $column['key']) }}
                            @endif
                        </td>
                    @endforeach
                    @if (!empty($config['actions']))
                        <td class="px-4 py-2 flex gap-2 justify-end border border-gray-200 whitespace-nowrap">
                            @foreach ($config['actions'] as $action)
                                <button
                                    wire:click="triggerAction('{{ $action['event'] }}', {{ $row->id }})"
                                    @if (isset($action['confirm']) && $action['confirm'])
                                        wire:confirm="{{ $action['confirmMessage'] ?? 'Are you sure?' }}"
                                    @endif
                                    class="{{ $action['class'] }} px-3 py-1 rounded-md text-sm"
                                >
                                    {{ $action['label'] }}
                                </button>
                            @endforeach
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($config['columns']) + (empty($config['actions']) ? 0 : 1) }}"
                        class="px-4 py-2 text-center text-gray-500 border border-gray-200">
                        {{ $config['emptyMessage'] }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>