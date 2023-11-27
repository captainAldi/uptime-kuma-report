@extends('layouts.dashboard')


@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Uptime History</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Table</h6>
    </div>

    <div class="card-body">

    <a class="btn btn-primary mb-2" href="{{ route('get.uptime.history.date.excel', $date) }}">
        Excel
    </a>

    <h2>Untuk Tanggal: {{ $date }}</h2>

    <!-- Table -->
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Persentase Hidup</th>
                    <th>Persentase Mati</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_uptime as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value['nama_platform'] }}</td>
                        <td>{{ $value['persentase_hidup'] }} %</td>
                        <td>{{ $value['persentase_mati'] }} %</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>
</div>

@endsection