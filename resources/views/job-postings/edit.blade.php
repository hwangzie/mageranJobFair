<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perubahan Lowongan Pekerjaan') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('asset/libs/sweetalert2/sweetalert2.min.css') }}">
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                });
            });
        </script>
    @elseif(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
            });
        </script>
    @endif
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-2xl font-bold mb-6">Edit Lowongan Pekerjaan</h2>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('job-postings.index') }}" class="btn btn-secondary">Kembali ke Daftar Lowongan</a>
                        </div>
                    </div>
                        <form action="{{ route('job-postings.update', $id) }}" method="POST" class="space-y-4" id="job_form" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Nama Pekerjaan<span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" value="{{$job_posting->title}}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Nama Pekerjaan, Cth: Frontend Developer">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan<span class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Deskripsi Pekerjaan" required>{{$job_posting->deskripsi}}</textarea>
                            </div>
                            <div>
                                <label for="requirements" class="block text-sm font-medium text-gray-700">Persyaratan Pekerjaan<span class="text-danger">*</span></label>
                                <textarea name="requirements" id="requirements" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>{{$job_posting->syarat}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="tipe_pekerjaan">Tipe Pekerjaan<span class="text-danger">*</span></label>
                                    <select name="job_type" id="job_type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                        <option value="">Pilih Tipe Pekerjaan</option>
                                        <option value="full-time" {{ $job_posting->tipe_pekerjaan == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                        <option value="part-time" {{ $job_posting->tipe_pekerjaan == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="location" class="block text-sm font-medium text-gray-700">Lokasi Pekerjaan<span class="text-danger">*</span></label>
                                    <input type="text" name="location" id="location" value="{{$job_posting->lokasi}}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 form-control" placeholder="Lokasi Pekerjaan, Cth: Jakarta" required>
                                </div>
                            </div>
                            <div class="row">
                                <label for="Range Gaji">Range Gaji <span class="text-danger">*</span></label>
                                <div class="form-group col-md-6 col-12">
                                    <input type="text" name="salary_min" id="salary_min" oninput="number_format(this)" value="{{ number_format($job_posting->gaji_min, 0, ',', '.') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 form-control" placeholder="Gaji Minimum" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <input type="text" name="salary_max" id="salary_max" oninput="number_format(this)" value="{{ number_format($job_posting->gaji_max, 0, ',', '.') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Gaji Maksimum" required>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" onclick="window.location='{{ route('job-postings.index') }}'" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Batal
                                </button>
                                <button type="reset" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                    Reset
                                </button>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('asset/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        ckeditor();

        $('#job_form').on('submit', function (e) {

            // Sync CKEditor
            for (let instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            let minRaw = $('#salary_min').val();
            let maxRaw = $('#salary_max').val();

            if (minRaw === '' || maxRaw === '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Range Gaji tidak boleh kosong',
                });
                return;
            }

            let min = parseInt(minRaw.replace(/\D/g, ''));
            let max = parseInt(maxRaw.replace(/\D/g, ''));

            if (min > max) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gaji Minimum tidak boleh lebih besar dari Gaji Maksimum',
                });
            }
        });
    });
    function ckeditor(){
        CKEDITOR.replace('description',{
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                {
                    "name": 'clipboard',
                    "groups": ['Undo', 'Paste', 'Cut', 'Copy' ]
                },
                {
                    "name" : 'editing',
                    "groups" : ['Find', 'Replace', 'SelectAll']
                },
                {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Source'
        });
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.replace('requirements',{
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                {
                    "name": 'clipboard',
                    "groups": ['Undo', 'Paste', 'Cut', 'Copy' ]
                },
                {
                    "name" : 'editing',
                    "groups" : ['Find', 'Replace', 'SelectAll']
                },
                {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                },
                {
                    "name": "document",
                    "groups": ["mode"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Source'
        });
        CKEDITOR.config.allowedContent = true;
    }
    function number_format(input) {
        let value = input.value.replace(/\D/g, '');

        if (value === '') {
            input.value = '';
            return;
        }

        input.value = new Intl.NumberFormat('id-ID').format(value);
    }
</script>
</x-app-layout>
