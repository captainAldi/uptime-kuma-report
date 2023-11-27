<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Monitor;
use App\Models\UptimeHistory;
use App\Models\Heartbeat;

use App\Exports\UptimeHistoryExport;
use Maatwebsite\Excel\Facades\Excel;





class UptimeController extends Controller
{
    public function get_uptime(Request $request)
    {

        // dd([
        //     'awal' => $awal,
        //     'akhir' => $akhir,
        // ]);

        $data = Monitor::orderBy('name', 'asc')->get();
        $data_monitor = [];

        // foreach ($data as $key => $value) {
        //     array_push($data_monitor,[
        //         "id" => $value->id,
        //         "name" => $value->name
        //     ]);
        // }

        
        // per baris
        // foreach ($data as $key => $value) {
        //     $from = date('2022-09-01');
        //     $to = date('2022-09-31');

        //     $data_hidup = Heartbeat::where('monitor_id', $value->id)
        //                             ->where('status', 1)
        //                             ->whereBetween('time', [$from, $to])
        //                             ->count();

        //     $data_mati = Heartbeat::where('monitor_id', $value->id)
        //                             ->where('status', 0)
        //                             ->whereBetween('time', [$from, $to])
        //                             ->count();
            
        //     $data_persentase_hidup = ($data_hidup / ($data_hidup + $data_mati)) * 100;
        //     $data_persentase_mati = ($data_mati / ($data_hidup + $data_mati)) * 100;

        //     $tampil = [
        //         'hidup' => $data_hidup,
        //         'mati' => $data_mati,
        //         'dari' => $from,
        //         'ke'   => $to,
        //         'persentase_hidup'  => number_format($data_persentase_hidup, 2),
        //         'persentase_mati'  => number_format($data_persentase_mati, 2),
        //     ];

        //     dd($tampil);
                                
        // }


        // -- Semua ---


        // filter date
        if ($request->filled('cari_tanggal_awal')) {
            $from = date($request->cari_tanggal_awal);
        } else {
            $from = date('Y-m-d');
        }

        if ($request->filled('cari_tanggal_akhir')) {
            $to = date($request->cari_tanggal_akhir);
        } else {
            $to = date('Y-m-d');
        }

        foreach ($data as $key => $value) {
            

            $data_hidup = Heartbeat::where('monitor_id', $value->id)
                                    ->where('status', 1)
                                    ->whereBetween('time', [$from, $to])
                                    ->count();

            $data_mati = Heartbeat::where('monitor_id', $value->id)
                                    ->where('status', 0)
                                    ->whereBetween('time', [$from, $to])
                                    ->count();
            
            if ($data_hidup != 0 ) {
               $data_persentase_hidup = ($data_hidup / ($data_hidup + $data_mati)) * 100;
            } else {
                $data_persentase_hidup = 0;
            }
            

            if ($data_mati != 0 ) {
               $data_persentase_mati = ($data_mati / ($data_hidup + $data_mati)) * 100;
            } else {
                $data_persentase_mati = 0;
            }
            

            $formated_data_persentase_hidup = number_format($data_persentase_hidup, 2);
            $formated_data_persentase_mati = number_format($data_persentase_mati, 2);

            $data_to_push = [
                'id' => $value->id,
                'name'  => $value->name,
                'persentase_hidup' => $formated_data_persentase_hidup,
                'persentase_mati' => $formated_data_persentase_mati
            ];

            array_push($data_monitor, $data_to_push);
                                
        }


        return view('reports.db', compact(
            'data_monitor',
            'from',
            'to'
        ));
        
    }

    public function uptime_history(Request $request)
    {
        // filter date
        if ($request->filled('cari_tanggal_awal')) {
            $from = date($request->cari_tanggal_awal);
        } else {
            $from = date('Y-m-d');
        }

        if ($request->filled('cari_tanggal_akhir')) {
            $to = date($request->cari_tanggal_akhir);
        } else {
            $to = date('Y-m-d');
        }

        // History List
        $data_uptime_history = UptimeHistory::orderBy('untuk_tanggal', 'desc')
                                                ->get()
                                                ->groupBy('untuk_tanggal');

        // dd($data_ns);
        
        return view('reports.history', compact(
            'data_uptime_history',
            'from',
            'to'
        ));
    }

    public function uptime_history_date($date)
    {

        
        $data_uptime = UptimeHistory::where('untuk_tanggal', $date)->get();

        return view('reports.history-date', compact(
            'data_uptime',
            'date'
        ));
    }

    public function uptime_history_date_excel($date)
    {
        return Excel::download(new UptimeHistoryExport($date), 'data-uptime-' . $date . '-.xlsx');
    }

    public function backup_uptime(Request $request)
    {
        $data = Monitor::orderBy('name', 'asc')->get();
        $data_monitor = [];

         // -- Semua ---


        // filter date
        if ($request->filled('cari_tanggal_awal')) {
            $from = date($request->cari_tanggal_awal);
        } else {
            $from = date('Y-m-d');
        }

        if ($request->filled('cari_tanggal_akhir')) {
            $to = date($request->cari_tanggal_akhir);
        } else {
            $to = date('Y-m-d');
        }

        foreach ($data as $key => $value) {
            

            $data_hidup = Heartbeat::where('monitor_id', $value->id)
                                    ->where('status', 1)
                                    ->whereBetween('time', [$from, $to])
                                    ->count();

            $data_mati = Heartbeat::where('monitor_id', $value->id)
                                    ->where('status', 0)
                                    ->whereBetween('time', [$from, $to])
                                    ->count();
            
            if ($data_hidup != 0 ) {
               $data_persentase_hidup = ($data_hidup / ($data_hidup + $data_mati)) * 100;
            } else {
                $data_persentase_hidup = 0;
            }
            

            if ($data_mati != 0 ) {
               $data_persentase_mati = ($data_mati / ($data_hidup + $data_mati)) * 100;
            } else {
                $data_persentase_mati = 0;
            }
            

            $formated_data_persentase_hidup = number_format($data_persentase_hidup, 2);
            $formated_data_persentase_mati = number_format($data_persentase_mati, 2);

            $data_to_push = [
                'id' => $value->id,
                'name'  => $value->name,
                'persentase_hidup' => $formated_data_persentase_hidup,
                'persentase_mati' => $formated_data_persentase_mati
            ];

            array_push($data_monitor, $data_to_push);
                                
        }


        // Save to DB

        // Proses Simpan ke DB
        DB::beginTransaction();

        try {

            foreach ($data_monitor as $key => $value) {
                $data_uptime_history = UptimeHistory::updateOrCreate(
                    [
                        'nama_platform' => $value['name'],
                        'untuk_tanggal' => $request->cari_tanggal_akhir
                    ],
                    [
                        'persentase_hidup'  => $value['persentase_hidup'],
                        'persentase_mati'   => $value['persentase_mati']
                    ]
                );
            }
            
            // Jika Semua Normal, Commit ke DB
            DB::commit(); 
        } catch (\Exception $e) {
            // Jika ada yang Gagal, Rollback DB
            DB::rollBack();
            Log::info($e->getMessage());
        }

        return back()->with('pesan', 'Berhasil Backup Data !');
    }


    public function get_chart()
    {
        $data_monitor = Monitor::orderBy('name', 'asc')->get();
        
        return view('reports.chart', compact('data_monitor'));
    }

    public function get_chart_detail(Request $request)
    {

        $platformName = $request->nama_platform;

        $data_monitor = Monitor::where('name', $platformName)->first();
        if (empty($data_monitor)) {
            return redirect()->route('home');
        }

        $data_chart = UptimeHistory::where('nama_platform', $platformName)->get();
        
        
        return view('reports.chart-detail', compact('data_chart'));
    }

    
}
