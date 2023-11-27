@extends('layouts.dashboard')


@section('judul')
  <h1 class="h3 mb-4 text-gray-800">Uptime</h1>
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
        
    <!-- Filter -->
    <ul class="nav nav-tabs" id="tabFilter" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="search-tab" data-toggle="tab" data-target="#search" type="button" role="tab" aria-controls="search" aria-selected="true">Search</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="sort-tab" data-toggle="tab" data-target="#sort" type="button" role="tab" aria-controls="sort" aria-selected="false">Sort</button>
      </li>
    </ul>

    <!-- Filter Content -->
    <form action="{{ route('get.uptime') }}" method="get">

      <div class="tab-content" id="tabFilterContent">

        <!-- Search -->
        <div class="tab-pane fade show active" id="search" role="tabpanel" aria-labelledby="search-tab">
         
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

        </div>

        <!-- Sort -->
        <div class="tab-pane fade" id="sort" role="tabpanel" aria-labelledby="Sort-tab">
          <div class="row">
            
            <p>sorting..</p>

            
          </div>
        </div>
      </div>


      <button type="submit" class="btn btn-info mt-2">
        Apply
      </button>    

      <a href="{{ route('get.uptime') }}" class="btn btn-info mt-2">
        Refresh
      </a>  
    </form>
    <!-- End Filter -->

    <hr>

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
                @foreach($data_monitor as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value['name'] }}</td>
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