<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <style>
        #dt-length, select {
            background-position: right -0.2rem center !important;
        }   
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="text-2xl font-bold">Daftar Lowongan Pekerjaan</h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('job-postings.create') }}" class="btn btn-primary">Buat Lowongan Pekerjaan Baru</a>
                        </div>
                    </div>
                    <table id="jobTable" class="bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pekerjaan</th>
                                <th>Deskripsi</th>
                                <th>Persyaratan</th>
                                <th>Tipe Pekerjaan</th>
                                <th>Range Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#jobTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('job-postings.datatable') }}',
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    { title: 'Nama Pekerjaan', data: 'title' },
                    { title: 'Deskripsi', data: 'deskripsi' },
                    { title: 'Persyaratan', data: 'syarat' },
                    { title: 'Tipe Pekerjaan', data: 'tipe_pekerjaan' },
                    { title: 'Range Gaji', data: 'salary_range' },
                    { title: 'Aksi', data: 'action', orderable: false, searchable: false }
                ]
            });
            $('#jobTable').on('click', '.btn-delete', function () {
                var jobId = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Lowongan pekerjaan ini akan dihapus!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    console.log(result);
                    if (result.value) {
                        $.ajax({
                            url: '{{ route('job-postings.delete') }}',
                            type: 'DELETE',
                            data: {
                            _token: '{{ csrf_token() }}',
                            id: jobId,
                        },
                        success: function (response) {
                            Swal.fire({
                                type: 'success',
                                title: 'Berhasil',
                                text: 'Lowongan pekerjaan berhasil dihapus.'
                            });
                            $('#jobTable').DataTable().ajax.reload();
                        },
                        error: function (xhr) {
                            Swal.fire({
                                type: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menghapus lowongan pekerjaan.'
                            });
                        }
                    });
                }
            });
        });
    });
    </script>
</x-app-layout>
