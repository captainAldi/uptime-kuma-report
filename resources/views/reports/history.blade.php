@extends('layouts.dashboard')


@section('judul')
  <h1 class="h3 mb-4 text-gray-800">History</h1>
@endsection

@section('konten')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Table</h6>
    </div>

    @if(session('pesan'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Info !</strong> {{ session('pesan') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="card-body">

      {{-- Backup --}}
      <form action="{{ route('get.uptime.backup') }}" method="get">

         <div class="row">
            <div class="col-lg-2 col-md-6 col-xs-12">
                <label for="cari_tanggal_awal">Tanggal Awal</label>
                <input type="date" name="cari_tanggal_awal" value="{{ $from }}">
            </div>

            <div class="col-lg-2 col-md-6 col-xs-12">
                <label for="cari_tanggal_akhir">Tanggal Akhir</label>
                <input type="date" name="cari_tanggal_akhir" value="{{ $to }}">
            </div>
          </div>

        <button type="submit" class="btn btn-info mt-2 mb-2">
          Backup
        </button>    

      </form>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
           <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_uptime_history as $key => $value)
              <tr>
                <td class="text-nowrap">{{ $loop->iteration }}</td>
                <td class="text-nowrap">{{ $key }}</td>
                <td>
                  <a href="{{ route('get.uptime.history.date', $key) }}">Lihat</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
</div>

@endsection