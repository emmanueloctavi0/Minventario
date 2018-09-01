<?php

namespace App\Exports;

use App\Article;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ArticleExport implements FromQuery, WithHeadings
{
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre del artículo',
            'Descripción',
            'Cantidad',
            'Precio',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Article::query()->select(DB::raw('article_id, name, description, amount, price'))
                                    ->where('user_id', '=', $this->userId);
    }
}
