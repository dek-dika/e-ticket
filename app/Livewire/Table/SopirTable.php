<?php

namespace App\Livewire\Table;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sopir;
use Illuminate\Support\Facades\Storage;

class SopirTable extends DataTableComponent
{
    protected $model = Sopir::class;

    public function configure(): void
    {
        $this->setPrimaryKey('sopir_id');
    }

    public function columns(): array
    {
        return [
            Column::make("Sopir id", "sopir_id")
                ->sortable(),

            Column::make("Nama sopir", "nama_sopir")
                ->sortable(),

            Column::make("Nomor ktp", "nomor_ktp")
                ->sortable(),

            Column::make("Sim", "sim")
                ->sortable(),

            Column::make("Foto", "foto")
                ->format(fn($value, $row) =>
                    '<img src="'.Storage::url($value).'" '
                  . 'alt="'.e($row->nama_sopir).'" '
                  . 'class="w-20 h-20 object-cover rounded-md" />'
                )
                ->html(),

            Column::make("Umur", "umur")
                ->sortable(),

            Column::make("Alamat", "alamat")
                ->sortable(),


            Column::make('Actions')
                ->label(fn($row) => view('components.table-action', [
                    'rowId'     => $row->sopir_id,
                    'editUrl'   => route('sopir.edit', $row->sopir_id),
                    'deleteUrl' => route('sopir.destroy', $row->sopir_id),
                ])->render())
                ->html(),
        ];
    }
}
