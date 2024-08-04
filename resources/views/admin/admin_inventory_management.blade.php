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
                            <a href="{{(request('search') || request('filter')) ? url('/admin/inventory/management') : ''}}"
                                style="color:inherit; {{(request('search') || request('filter')) ? '' : 'pointer-events:none;'}}"><i
                                    class="bx bx-{{(request('search') || request('filter')) ? 'refresh' : 'search'}}"></i></a>
                        </span>
                        <input type="text" class="form-control" placeholder="Search mail" name="search">

                    </div>

                </div>

                <div class="col-12 col-md-4 my-2 d-flex justify-content-end order-1 order-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-white ms-2" data-bs-toggle="dropdown">
                            <i class="bx bx-filter"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                            <a class="dropdown-item"
                                href="{{route('admin.inventory.management', ['filter' => 'unscheduled'])}}">Unscheduled</a>
                            <a class="dropdown-item"
                                href="{{route('admin.inventory.management', ['filter' => 'scheduled'])}}">Scheduled</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary px-4 ms-2" data-bs-toggle="modal"
                        data-bs-target="#exampleLargeModal">
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
                            <th>Product</th>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Resi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                                            <tr>
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
                            'Unscheduled'}}</span></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <i class="btn btn-primary bx bx-pencil" data-bs-toggle="modal"
                                                            data-bs-target="#exampleLargeModal{{$barang->id}}"></i>
                                                        <i class="btn btn-danger bx bx-trash" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{$barang->id}}"></i>
                                                        <form method="POST" action="{{route('admin.barang.out.update')}}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $barang->id }}">
                                                            @if ($barang->tanggal_keluar)
                                                                <button type="button" class="btn btn-success" onclick="toasterbarangout()">
                                                                    <i class="bx bx-archive-out"></i>
                                                                </button>
                                                            @else
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="bx bx-archive-out"></i>
                                                                </button>
                                                            @endif
                                                        </form>


                                                    </div>
                                                </td>
                                            </tr>





                                            <!-- update modal -->
                                            <div class="modal fade" id="exampleLargeModal{{$barang->id}}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Barang</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" method="POST" action="{{route('admin.barang.edit')}}"
                                                                enctype="multipart/form-data" id="barangAddForm{{$barang->id}}">
                                                                @csrf

                                                                <input type="hidden" name="id" value="{{ $barang->id }}">

                                                                <div class="d-flex gap-5">
                                                                    <div class="col-md-6">
                                                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                                                        <input type="text" class="form-control" id="nama_barang"
                                                                            placeholder="Nama Barang" name="nama_barang"
                                                                            value="{{$barang->nama_barang}}">
                                                                        <span class="text-danger"
                                                                            id="nama_barang_error{{$barang->id}}"></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <label for="jumlah" class="form-label">Jumlah</label>
                                                                        <input type="number" class="form-control" id="jumlah"
                                                                            placeholder="jumlah" name="jumlah" value="{{$barang->jumlah}}">
                                                                        <span class="text-danger" id="jumlah_error{{$barang->id}}"></span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex gap-5">
                                                                    <div class="col-md-6">
                                                                        <label for="pengirim" class="form-label">Pengirim</label>
                                                                        <input type="text" class="form-control" id="pengirim"
                                                                            placeholder="John Doe" name="pengirim"
                                                                            value="{{$barang->pengirim}}">
                                                                        <span class="text-danger" id="pengirim_error{{$barang->id}}"></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <label for="penerima" class="form-label">Penerima</label>
                                                                        <input type="text" class="form-control" id="penerima"
                                                                            placeholder="Albert Einstein" name="penerima"
                                                                            value="{{$barang->penerima}}">
                                                                        <span class="text-danger" id="penerima_error{{$barang->id}}"></span>
                                                                    </div>
                                                                </div>



                                                                <div class="col-md-12 mb-1">
                                                                    <label for="tanggal_keluar" class="form-label">Barang Keluar</label>
                                                                    <input type="date" class="form-control" id="tanggal_keluar"
                                                                        placeholder="dd/mm/yy" name="tanggal_keluar"
                                                                        value="{{$barang->tanggal_keluar}}">
                                                                    <span class="text-danger"
                                                                        id="tanggal_keluar_error{{$barang->id}}"></span>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <input type="submit" value="Submit" class="btn btn-primary" />
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#barangAddForm{{$barang->id}}').on('submit', function (event) {
                                                        event.preventDefault(); // Mencegah pengiriman form default

                                                        $.ajax({
                                                            url: $(this).attr('action'),
                                                            method: $(this).attr('method'),
                                                            data: $(this).serialize(),
                                                            success: function (response) {


                                                                setTimeout(function () {
                                                                    location.reload(); // Refresh halaman
                                                                }, 500);
                                                            },
                                                            error: function (xhr) {
                                                                $('.text-danger').text('');
                                                                var errors = xhr.responseJSON.errors;

                                                                // Display error 
                                                                if (errors) {
                                                                    $.each(errors, function (key, value) {
                                                                        $('#' + key + '_error' + '{{$barang->id}}').text(value[0]);
                                                                    });

                                                                    // Reopen the modal if it was closed
                                                                    $('#exampleLargeModal{{$barang->id}}').modal('show');
                                                                }
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>


                                            <!-- delete modal -->
                                            <div class="modal fade" id="exampleModal{{$barang->id}}" tabindex="-1"
                                                aria-labelledby="exampleModal{{$barang->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <i class="bx bx-trash display-2 text-danger text-center"></i>
                                                            </div>

                                                            <p class="h6 text-wrap text-start">
                                                                Apakah Anda Yakin Ingin Mengahapus {{" "}} {{$barang->nama_barang}} dengan 
                                                                id
                                                                {{$barang->id}} {{" "}} ?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{route('admin.barang.delete')}}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $barang->id }}">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <input type="submit" value="Submit" class="btn btn-danger" />
                                                            </form>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

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



<!-- 
Tambah Barang Modal -->
<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{ route('admin.barang.add') }}"
                    enctype="multipart/form-data" id="barangAddForm">
                    @csrf
                    <div class="col-md-12">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang"
                            name="nama_barang">
                        <span class="text-danger" id="nama_barang_error"></span>
                    </div>
                    <div class="col-md-12">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" placeholder="jumlah" name="jumlah">
                        <span class="text-danger" id="jumlah_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="pengirim" class="form-label">Pengirim</label>
                        <input type="text" class="form-control" id="pengirim" placeholder="John Doe" name="pengirim">
                        <span class="text-danger" id="pengirim_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="penerima" class="form-label">Penerima</label>
                        <input type="text" class="form-control" id="penerima" placeholder="Albert Einstein"
                            name="penerima">
                        <span class="text-danger" id="penerima_error"></span>
                    </div>
                    <div class="col-md-12">
                        <label for="tanggal_keluar" class="form-label">Barang Keluar</label>
                        <input type="date" class="form-control" id="tanggal_keluar" placeholder="dd/mm/yy"
                            name="tanggal_keluar">
                        <span class="text-danger" id="tanggal_keluar_error"></span>
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




<!-- Tambah Barang Modal Behavior  -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script>
    function toasterbarangout() {
        toastr.error("Barang Sudah Keluar")
    }
    $(document).ready(function () {
        $('#barangAddForm').on('submit', function (event) {
            event.preventDefault(); // Mencegah pengiriman form default

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (response) {


                    setTimeout(function () {
                        toastr.success('Barang Ditambahkan');
                        location.reload(); // Refresh halaman
                    }, 500);
                },
                error: function (xhr) {
                    $('.text-danger').text('');
                    var errors = xhr.responseJSON.errors;

                    // Display error 
                    if (errors) {
                        $.each(errors, function (key, value) {
                            $('#' + key + '_error').text(value[0]);
                        });

                        // Reopen the modal if it was closed
                        $('#exampleLargeModal').modal('show');
                    }
                }
            });
        });
    });
</script>

@endsection