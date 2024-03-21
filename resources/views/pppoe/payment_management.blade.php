@extends('layouts.layouts', ['menu' => 'pppoe', 'submenu' => 'secret'])

@section('title', 'PPPoE Payment Management')

@section('content')



    <div class="main-panel">
        <div class="content">
            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                            <h5 class="text-white op-7 mb-2">Total Secret PPPoE : {{ $totalsecret }}</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <!-- <h4 class="card-title">Add Row</h4> -->
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#addRowModal" disabled>
                                    <i class="fa fa-plus"></i>
                                    Add Secret
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal LUNAS-->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    Tandai</span>
                                                <span class="fw-light">
                                                    Pelanggan Lunas
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                                            {{-- <form action="" method="POST"> --}}
                                            {{-- @csrf --}}
                                            <input type="text" name="id_set_lunas" id="id_set_lunas">
                                            <input type="text" name="name_pppoe" id="name_pppoe">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Profile</label>
                                                        <select name="profile" id="profile_set_lunas" class="form-control"
                                                            placeholder="Profile">
                                                            <option disabled selected value="">Pilih</option>
                                                            @foreach ($profile as $data)
                                                                <option>{{ $data['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-primary set-lunas">Set Lunas</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover pppoe-pembayaran-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Password</th>
                                        <th>Profile</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($secret as $no => $data)
                                        <tr>
                                            <div hidden>{{ $id = str_replace('*', '', $data['.id']) }}</div>
                                            <td>{{ $no + 1 }} </td>
                                            <td>{{ $data['name'] ?? '' }} </td>
                                            <td>{{ $data['password'] ?? '' }} </td>
                                            <td>{{ $data['profile'] ?? '' }} </td>
                                            <td>
                                                @if ($data['disabled'] == 'true')
                                                    Disable
                                                @else
                                                    Enable
                                                @endif
                                            </td>
                                            <td>{{ $data['comment'] ?? '' }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    {{-- <a href="{{ route('pppoe.edit', $id ) }}" class="btn btn-link btn-primary btn-lg" data-toggle="tooltip" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                    @if ($data['comment'] == 'BELUM-BAYAR')
                                                    <button class="btn btn-primary btn-round btn-lunas" data-toggle="modal"
                                                        data-target="#addRowModal" data-id="{{ $data['.id'] }}"
                                                        data-name_pppoe="{{ $data['name'] }}">
                                                        LUNAS
                                                    </button>
                                                    @endif

                                                    {{-- <a href="{{ route('pppoe.delete', $id) }}" type="button"
                                                        data-toggle="tooltip" class="btn btn-link btn-danger"
                                                        data-original-title="Remove"
                                                        onclick="return confirm('Apakah anda yakin menghapus secret {{ $data['name'] }} ?')">
                                                        <i class="fa fa-times"></i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="{{ asset('template') }}/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Menangkap id saat tombol "LUNAS" ditekan
            $('.btn-lunas').on('click', function() {
                var id = $(this).data('id');
                var name_pppoe = $(this).data('name_pppoe');
                console.log(name_pppoe);
                $('#id_set_lunas').val(id);
                $('#name_pppoe').val(name_pppoe);
            });

            $('.set-lunas').on('click', function() {
                var id = $('#id_set_lunas').val();
                var profile = $('#profile_set_lunas').val();
                var name_pppoe = $('#name_pppoe').val();

                // Mengirim request AJAX saat tombol "Set Lunas" ditekan
                updatePPPoESecret(id, profile, name_pppoe);
            });

            // Fungsi untuk melakukan request AJAX

            function updatePPPoESecret(id, profile, name_pppoe) {
                // Mengirim request AJAX
                $.ajax({
                    url: '/pppoe/pembayaran/set-lunas/' + id,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Tambahkan _token untuk laravel
                        profile: profile,
                        name: name_pppoe,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Handle jika pembaruan berhasil (tampilkan alert atau yang sesuai)
                            $('#addRowModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil diperbarui!',
                            }).then((result) => {
                                // Reload table after clicking OK on the SweetAlert dialog
                                if (result.isConfirmed) {
                                    location.reload(true);
                                }
                            });
                        } else {
                            // Handle jika pembaruan gagal (tampilkan alert atau yang sesuai)
                            $('#addRowModal').modal('hide');
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Pembaruan gagal!',
                            });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Error: " + errorThrown);
                        // Handle error jika diperlukan (tampilkan alert atau yang sesuai)
                    }
                });
            }

        });
    </script>
@endsection
