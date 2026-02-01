<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div style="overflow: auto;  user-select: none;" x-data="{
        state: $wire.$entangle(@js($getStatePath())),
        options: @js($getOptions()),
        rows: @js($getRows()),
        columns: @js($getCols()),

        init() {
            if (!this.state || !Array.isArray(this.state)) {
                this.state = [];
            }
        },
        isViewMode: @js($operation === 'view'),

        selected_color: null,
        selectColor(color) {
            this.selected_color = color;
        },

        setCellState(row, col) {
            this.state[row][col] = this.selected_color;
        },

        isPainting: false,
        startPainting() {
            this.isPainting = true;
        },
        stopPainting() {
            this.isPainting = false;
        },

        handleCell(row, col, event) {
            if (!this.selected_color) return;
            if (this.isPainting || event.type === 'mousedown') {
                if (!this.state[row]) this.state[row] = [];
                this.state[row][col] = this.selected_color;
            }
        }
    }" @mousedown="startPainting"
        @mouseup="stopPainting" @mouseleave="stopPainting"
        {{ $getExtraAttributeBag()->class('filament-forms-grid-component') }}>
        <!-- Цвета -->
        <div style="margin-bottom: 20px;">
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <template x-for="(label, color) in options" :key="color">
                    <button type="button" x-on:click="selectColor(color)"
                        style="padding: 8px; border: 2px solid #e5e7eb; border-radius: 6px; background: white;"
                        :style="selected_color === color ? 'border-color: #3b82f6; background: #eff6ff;' : ''"
                        :title="`${label} (${color})`">
                        <div style="width: 30px; height: 30px; border-radius: 4px; margin-bottom: 4px; border: 1px solid #d1d5db"
                            :style="{ backgroundColor: color }"></div>
                        <span style="font-size: 12px; font-weight: 500;" x-text="label"></span>
                    </button>
                </template>
            </div>
        </div>

        <!-- Таблица -->
        <div>
            <table style="max-width: fit-content; border: 1px solid #e5e7eb; border-collapse: collapse;">
                <thead></thead>
                <tbody>
                    <template x-for="(row, rowIndex) in Array.from({length: rows})" :key="rowIndex">
                        <tr>
                            <template x-for="(col, colIndex) in Array.from({length: columns})" :key="colIndex">
                                <td @mousedown="!isViewMode && handleCell(rowIndex, colIndex, $event)"
                                    @mouseover="!isViewMode && handleCell(rowIndex, colIndex, $event)"
                                    style="border: 1px solid #e5e7eb; padding: 0; text-align: center; cursor: pointer;"
                                    :style="state[rowIndex] && state[rowIndex][colIndex] ?
                                        `background-color: ${state[rowIndex][colIndex]}; border: 1px solid #e5e7eb; padding: 0; ` :
                                        'border: 1px solid #e5e7eb; padding: 0;'">
                                    <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"
                                        :title="`Ячейка [${rowIndex},${colIndex}]`">
                                    </div>
                                </td>
                            </template>
                        </tr>
                    </template>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</x-dynamic-component>
