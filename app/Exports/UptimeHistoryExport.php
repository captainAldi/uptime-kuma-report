<?php

namespace App\Exports;

use App\Models\UptimeHistory;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class UptimeHistoryExport implements ShouldAutoSize, FromView
{

    use Exportable;

    protected $date;

    function __construct($date) {
            $this->date = $date;
    }

    public function view(): View 
    {
        // Data
        $date = $this->date;

        $data_uptime = UptimeHistory::where('untuk_tanggal', $date)->get();

        return view('exports.history-date', compact(
            'data_uptime',
            'date'
        ));
    }
}
