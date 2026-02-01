<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Tables\Filters\Concerns\HasOptions;

class Scheldue extends Field
{
    use HasOptions;
    private int $rows;
    private int $cols;
    protected string $view = 'filament.forms.components.scheldue';

    protected function setUp(): void
    {
        parent::setUp();
        $this->default([]);

        $this->beforeStateDehydrated(function (array &$state) {
            $rows = $this->getRows();
            $cols = $this->getCols();

            $matrix = [];

            for ($i = 0; $i < $rows; $i++) {
                $matrix[$i] = [];

                for ($j = 0; $j < $cols; $j++) {
                    $matrix[$i][$j] = $state[$i][$j] ?? null;
                }
            }
            $state = $matrix;
        });
    }
    public function rows(int $rows)
    {
        $this->rows = $rows;
        return $this;
    }
    public function cols(int $columns)
    {
        $this->cols = $columns;
        return $this;
    }
    public function getRows()
    {
        return $this->evaluate($this->rows);
    }
    public function getCols()
    {
        return $this->evaluate(value: $this->cols);
    }
}
