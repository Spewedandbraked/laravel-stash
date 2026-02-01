{{-- resources/views/filament/resources/workhour-resource/pages/debug-workhour.blade.php --}}
<x-filament::page>
    <x-slot name="header">
        <h2>Debug Workhour #{{ $record->id }}</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Массив данных -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Массив данных (arr):</h3>
            <div class="bg-gray-100 p-4 rounded">
                @php(dump($record->arr))
            </div>
        </div>

        <!-- Таблица -->
        @if(!empty($record->arr) && is_array($record->arr))
        <div>
            <h3 class="text-lg font-semibold mb-2">Визуальное представление:</h3>
            <div class="overflow-auto">
                <table class="border border-gray-300 border-collapse">
                    @foreach($record->arr as $rowIndex => $row)
                    <tr>
                        @foreach($row as $colIndex => $cell)
                        <td class="border border-gray-300 p-4 text-center
                                  {{ $cell ? 'text-white' : 'text-gray-600' }}"
                            style="{{ $cell ? "background-color: {$cell}" : '' }}">
                            [{{ $rowIndex }},{{ $colIndex }}]<br>
                            <strong>{{ $cell ?: 'null' }}</strong>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @endif

        <!-- Статистика -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Статистика:</h3>
            @php
                $filled = collect($record->arr)->flatten()->filter()->count();
                $total = collect($record->arr)->flatten()->count();
                $percent = $total > 0 ? round(($filled / $total) * 100, 2) : 0;
            @endphp

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded">
                    <div class="text-sm text-gray-500">Заполнено ячеек</div>
                    <div class="text-2xl font-bold">{{ $filled }} / {{ $total }}</div>
                    <div class="text-sm">{{ $percent }}%</div>
                </div>

                <div class="bg-gray-50 p-4 rounded">
                    <div class="text-sm text-gray-500">Размер таблицы</div>
                    <div class="text-2xl font-bold">
                        {{ count($record->arr) }} × {{ count($record->arr[0] ?? []) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
