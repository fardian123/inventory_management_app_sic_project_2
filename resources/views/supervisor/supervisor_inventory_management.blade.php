@extends('supervisor.supervisor_dashboard')
@section('supervisor')


<div class="page-content">
    <h1 class="font-weight-light text-muted">Item In Storage</h1>
    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <form method="GET" action="{{ route('supervisor.inventory.management') }}"
                class="d-flex align-items-center justify-content-between flex-wrap row">

                <div class="col-12 col-md-4 my-2 order-2 order-md-1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <a href="{{(request('search') || request('filter') || request('search_out')) ? url('/supervisor/inventory/management') : ''}}"
                                style="color:inherit; {{(request('search') || request('filter') || request('search_out')) ? '' : 'pointer-events:none;'}}"><i
                                    class="bx bx-{{(request('search') || request('filter') || request('search_out')) ? 'refresh' : 'search'}}"></i></a>
                        </span>
                        <input type="text" class="form-control" placeholder="Search" name="search">

                    </div>

                </div>

                <div class="col-12 col-md-4 my-2 d-flex justify-content-end order-1 order-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-white ms-2" data-bs-toggle="dropdown">
                            <i class="bx bx-filter"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item"
                                href="{{route('supervisor.inventory.management', ['filter' => 'unscheduled'])}}">Unscheduled</a>
                            <a class="dropdown-item"
                                href="{{route('supervisor.inventory.management', ['filter' => 'scheduled'])}}">Scheduled</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Resi</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$barang->nama_barang}}</td>
                                                <td>{{$barang->id}}</td>
                                                <td>{{$barang->jumlah}}</td>
                                                <td>{{$barang->tanggal_masuk}}</td>
                                                <td>{{$barang->tanggal_keluar}}</td>
                                                <td class="fixed-with-td">{{$barang->pengirim}}</td>
                                                <td class="fixed-with-td">{{$barang->penerima}}</td>
                                                <td>{{$barang->resi->nomor_resi}}</td>
                                                <td><span class="{{$barang->tanggal_keluar ? 'badge bg-gradient-bloody text-white shadow-sm w-100 ' :
                            'badge bg-gradient-quepal text-white shadow-sm w-100'}}">{{$barang->tanggal_keluar ? 'Scheduled' :
                            'Unscheduled'}}</span> </td>
                                            </tr>
                        @empty
                            <tr>
                                <span class="text-danger">Barang Tidak Ditemukan</span>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

    </div>







    <!-- card out -->
    <h1 class="font-weight-light text-muted">Item Exited Storage</h1>
    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <form method="GET" action="{{ route('supervisor.inventory.management') }}"
                class="d-flex align-items-center justify-content-between flex-wrap row">

                <div class="col-12 col-md-4 my-2 order-2 order-md-1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <a href="{{request('search_out') ? url('/supervisor/inventory/management') : ''}}"
                                style="color:inherit; {{request('search_out') ? '' : 'pointer-events:none;'}}"><i
                                    class="bx bx-{{(request('search_out') || request('search') || request('filter')) ? 'refresh' : 'search'}}"></i></a>
                        </span>
                        <input type="text" class="form-control" placeholder="search" name="search_out">

                    </div>

                </div>


            </form>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Resi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangsOut as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$barang->nama_barang}}</td>
                                <td>{{$barang->id}}</td>
                                <td>{{$barang->jumlah}}</td>
                                <td>{{$barang->tanggal_masuk}}</td>
                                <td>{{$barang->tanggal_keluar}}</td>
                                <td class="fixed-with-td">{{$barang->pengirim}}</td>
                                <td class="fixed-with-td">{{$barang->penerima}}</td>
                                <td>{{$barang->resi->nomor_resi}}</td>

                            </tr>
                        @empty
                            <tr>
                                <span class="text-danger">Barang Tidak Ditemukan</span>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>


    </div>
</div>









@endsection