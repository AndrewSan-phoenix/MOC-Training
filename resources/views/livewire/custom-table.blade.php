@props([
    'config' => [
        'columns' => [],
        'data' => [],
        'actions' => [],
        'emptyMessage' => 'No records found.',
    ]
])

<div class="bg-light shadow-md rounded-md p-6">
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100">
                @foreach ($config['columns'] as $column)
                    <th class="px-4 py-2 text-left text-dark border border-gray-200">{{ $column['label'] }}</th>
                @endforeach
                @if (!empty($config['actions']))
                    <th class="px-4 py-2 text-left text-dark border border-gray-200">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($config['data'] as $row)
                <tr class="border-b border-gray-200">
                    @foreach ($config['columns'] as $column)
                        <td class="px-4 py-2 text-dark border border-gray-200">
                            {{ data_get($row, $column['key']) }}
                        </td>
                    @endforeach
                    @if (!empty($config['actions']))
                        <td class="px-4 py-2 flex gap-2 border border-gray-200">
                            @foreach ($config['actions'] as $action)
                                <button
                                    wire:click="triggerAction('{{ $action['event'] }}', {{ $row->id }})"
                                    @if (isset($action['confirm']) && $action['confirm'])
                                        onclick="return confirm('{{ $action['confirmMessage'] ?? 'Are you sure?' }}')"
                                    @endif
                                    class="{{ $action['class'] }}"
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
