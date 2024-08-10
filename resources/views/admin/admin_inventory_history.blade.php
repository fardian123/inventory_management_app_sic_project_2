@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">
    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <form method="GET" action="{{ route('admin.inventory.management') }}"
                class="d-flex align-items-center justify-content-between flex-wrap row">

                <div class="col-12 col-md-4 my-2 order-2 order-md-1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <a href="{{request('search')  ? url('/admin/inventory/management') : ''}}"
                                style="color:inherit; {{request('search')  ? '' : 'pointer-events:none;'}}"><i
                                    class="bx bx-{{request('search')  ? 'refresh' : 'search'}}"></i></a>
                        </span>
                        <input type="text" class="form-control" placeholder="Search " name="search">

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
                        @foreach($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$barang->nama_barang}}</td>
                                <td>{{$barang->id}}</td>
                                <td>{{$barang->jumlah}}</td>
                                <td>{{$barang->tanggal_masuk}}</td>
                                <td>{{$barang->tanggal_keluar}}</td>
                                <td>{{$barang->pengirim}}</td>
                                <td>{{$barang->penerima}}</td>
                                <td>{{$barang->resi->nomor_resi}}</td>
                                <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100 ">OUT</td>

                            </tr>

                        @endforeach

                    </tbody>


                </table>
            </div>


        </div>
    </div>
</div>


@endsection