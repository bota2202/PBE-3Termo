<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class MyWidget extends ChartWidget
{
    protected ?string $heading = 'My Widget';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => [5, 10, 8, 15, 20, 25, 18],
                    'backgroundColor' => '#0003a5',
                    'borderColor' => '#000000',
                ],
            ],
            'labels' => ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
