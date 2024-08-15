@extends('supervisor.supervisor_dashboard')
@section('supervisor')


<div class="page-content">
    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <form method="GET" action="{{ route('supervisor.inventory.report') }}"
                class="d-flex align-items-center justify-content-between flex-wrap row">

                <div class="col-12 col-md-4 my-2 order-2 order-md-1">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <a href="{{(request('search') || request('filter') || request('search_out')) ? url('/supervisor/inventory/report') : ''}}"
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
                                href="{{route('supervisor.inventory.report', ['filter' => 'unscheduled'])}}">Unscheduled</a>
                            <a class="dropdown-item"
                                href="{{route('supervisor.inventory.report', ['filter' => 'scheduled'])}}">Scheduled</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary px-4 ms-2" data-bs-target="#reportModal"
                        data-bs-toggle="modal">
                        <i class="bx bx-archive-in"></i>
                    </button>

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



</div>


<div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="get" action="{{route('supervisor.inventory.export')}}"
                    enctype="multipart/form-data" id="barangAddForm">
                    @csrf


                    <div>
                        <p class="form-label">Filter By</p>

                        <div class="row">
                            <div class="col-md-6">
                                <select type="text" class="form-control" id="schedule_filter" placeholder="Nama Barang"
                                    name="schedule_filter" value="">
                                    <option value=""></option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="unscheduled">Unscheduled</option>
                                </select>
                                <span class="text-danger" id="schedule_filter_error"></span>
                            </div>
                            <div class="col-md-6">
                                <select type="text" class="form-control" id="tanggal_filter" placeholder="Nama Barang"
                                    name="tanggal_filter" value="">
                                    <option value="tanggal_masuk" id="tanggal_keluar_option_masuk">Tanggal Masuk
                                    </option>
                                    <option value="tanggal_keluar" id="tanggal_keluar_option_keluar">Tanggal Keluar
                                    </option>
                                </select>
                                <span class="text-danger" id="tanggal_filter_error"></span>
                            </div>
                        </div>
                    </div>





                    <div class="col-md-6">
                        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggal_awal" placeholder="John Doe"
                            name="tanggal_awal" value="">
                        <span class="text-danger" id="tanggal_awal_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" placeholder="Albert Einstein"
                            name="tanggal_akhir" value="">
                        <span class="text-danger" id="tanggal_akhir_error"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const schedule_filter = document.getElementById('schedule_filter');
        const tanggal_keluar_option1_masuk = document.getElementById("tanggal_keluar_option_masuk");
        const tanggal_keluar_option1_keluar = document.getElementById("tanggal_keluar_option_keluar");
        const tanggal_keluar_filter = document.getElementById("tanggal_filter");
        function toggleDateInput() {
            if (schedule_filter.value === "unscheduled") {
               
                tanggal_keluar_option1_masuk.selected = true;
                tanggal_keluar_option1_keluar.disabled = true;
            } else {
               
                tanggal_keluar_option1_keluar.disabled = false;
            }
        }

        toggleDateInput();
        schedule_filter.addEventListener('change', toggleDateInput)

    })
</script>

@endsection