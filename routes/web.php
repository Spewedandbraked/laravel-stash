<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
use App\Models\Workhour;

Route::get('/debug-workhour/{id}', function ($id) {
    $workhour = Workhour::findOrFail($id);

    echo "<h2>Workhour ID: {$id}</h2>";
    echo "<h3>Массив данных (arr):</h3>";
    dump($workhour->arr);

    echo "<h3>Таблица:</h3>";

    if (empty($workhour->arr) || !is_array($workhour->arr)) {
        echo "Нет данных для отображения";
        return;
    }

    echo "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; font-family: monospace;'>";

    foreach ($workhour->arr as $rowIndex => $row) {
        echo "<tr>";

        foreach ($row as $colIndex => $cell) {
            $color = $cell ?: 'transparent';
            $text = $cell ?: "null";

            echo "<td style='border: 1px solid #ccc; padding: 10px; text-align: center;
                   background-color: {$color}; color: " . ($cell ? 'white' : '#666') . ";'>
                   [{$rowIndex},{$colIndex}]<br>
                   <strong>{$text}</strong>
                  </td>";
        }

        echo "</tr>";
    }

    echo "</table>";

    echo "<h3>JSON представление:</h3>";
    echo "<pre>" . json_encode($workhour->arr, JSON_PRETTY_PRINT) . "</pre>";

    echo "<h3>Статистика:</h3>";
    $filled = collect($workhour->arr)->flatten()->filter()->count();
    $total = collect($workhour->arr)->flatten()->count();
    $percent = $total > 0 ? round(($filled / $total) * 100, 2) : 0;

    echo "Заполнено: {$filled} из {$total} ячеек ({$percent}%)<br>";

    // Цветовая статистика
    $colorStats = collect($workhour->arr)
        ->flatten()
        ->filter()
        ->countBy()
        ->sortDesc();

    echo "<h4>Использованные цвета:</h4>";
    foreach ($colorStats as $color => $count) {
        echo "<div style='margin: 5px 0;'>
                <span style='display: inline-block; width: 20px; height: 20px; background: {$color}; border: 1px solid #000;'></span>
                {$color}: {$count} ячеек
              </div>";
    }
})->name('debug-workhour');
