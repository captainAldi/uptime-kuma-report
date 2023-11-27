@extends('layouts.dashboard')


@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Uptime</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Chart</h6>
    </div>


    <div class="card-body">
        
        <canvas id="chart-uptime"></canvas>

    </div>
</div>

@endsection

@push('scripts')
    <script>
        let dataChart = {{ Js::from($data_chart) }}
 
        const ctx = document.getElementById('chart-uptime');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataChart.map(row => row.untuk_tanggal),
                datasets: [
                    {
                        label: 'Uptime Per Month',
                        data: dataChart.map(row => row.persentase_hidup)
                    }
                ]
            }
        })
    </script>
@endpush