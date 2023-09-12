@extends('partials.master')

@prepend('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endprepend

@section('content')
    <div class="row form-control">
        <div class="text-center">
            <h3>Form 
            @if(isset($penyidik)) 
                Edit
            @else
                Input 
            @endif    
                Penyidik</h3>
        </div>
        <hr>
        @if(isset($penyidik))
        <form action="/data-penyidik/update" id="input-penyidik" method="post">
        @else
        <form action="/input-data-penyidik/store" id="input-penyidik" method="post">
        @endif
            @csrf
            <div class="row">
                <input type="hidden" name="id" id="id" value="{{ isset($penyidik) ? $penyidik->id : '' }}">
                <div class="col-lg-6 mb-3">
                    <label for="perihal_nota_dinas" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control border-dark" id="name" placeholder="Nama" value="{{ isset($penyidik) ? $penyidik->name : '' }}" >
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="wujud_perbuatan" class="form-label">NRP</label>
                    <input type="number" name="nrp" class="form-control border-dark" id="nrp" placeholder="NRP" value="{{ isset($penyidik) ? $penyidik->nrp : '' }}" >
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="pangkat" class="form-label">Pangkat</label>
                    <select name="id_pangkat" id="id_pangkat" class="form-control">
                        <option value="">Pilih Pangkat</option>
                        @foreach ($pangkats as $pangkat)
                            <option value="{{ $pangkat->id }}"                           
                                @if(isset($penyidik)) 
                                    @if($penyidik->id_pangkat == $pangkat->id)
                                        "selected";
                                    @endif 
                                @endif 
                            >{{ $pangkat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control border-dark" placeholder="Jabatan" value="{{ isset($penyidik) ? $penyidik->jabatan : '' }}" >
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="tim" class="form-label">Tim</label>
                    <select name="tim" id="tim" class="form-control">
                        <option value="">Pilih Tim</option>
                        @for ($i = 0; $i < count($tims); $i++)
                            <option value="{{ $tims[$i] }}"
                                    @if(isset($penyidik))
                                        @if($penyidik->tim == $tims[$i])
                                            "selected";
                                        @endif 
                                    @endif 
                            >{{ $tims[$i] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" id="unit" name="unit" class="form-control border-dark" placeholder="Unit" value="{{ isset($penyidik) ? $penyidik->unit : '' }}" >
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="unit" class="form-label">Fungsional</label>
                    <select class="form-control" name="fungsional" id="fungsional">
                        <option value="">Pilih Fungsional</option>
                        <option value="Akreditor Utama" 
                            @if(isset($penyidik))
                                @if($penyidik->fungsional == 'Akreditor Utama')
                                    "selected";
                                @endif 
                            @endif 
                        >Akreditor Utama</option>
                        <option value="Akreditor Madya"
                            @if(isset($penyidik))
                                @if($penyidik->fungsional == 'Akreditor Madya')
                                    "selected";
                                @endif 
                            @endif 
                        >Akreditor Madya</option>
                        <option value="Anggota"
                            @if(isset($penyidik))
                                @if($penyidik->fungsional == 'Anggota')
                                    "selected";
                                @endif 
                            @endif 
                        >Anggota</option>
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="kesatuan" class="form-label">Kesatuan</label>
                    <input type="text" id="kesatuan" name="kesatuan" class="form-control border-dark" placeholder="Kesatuan" value="{{ isset($penyidik) ? $penyidik->kesatuan : '' }}" >
                </div>

            </div>
            {{-- <input type="text" class="form-control border-dark" value="{{ isset($kasus) ? $kasus->id : '' }}" hidden name="kasus_id"> --}}
            <div class="row">
                <div class="col-lg-12 mb-3">
                    @if(isset($penyidik))
                        <button class="btn btn-success form-control" type="submit" value="edit_penyidik" name="type_submit">
                            Submit Data
                        </button>
                    @else
                        <button class="btn btn-success form-control" type="submit" value="input_penyidik" name="type_submit">
                            Submit Data
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#input-penyidik').validate({
                rules: {
                    name : {
                        required: true,
                    },
                    nrp : {
                        required: true,
                    },
                    id_pangkat : {
                        required: true,
                    },
                    jabatan : {
                        required: true,
                    },
                    tim : {
                        required: true,
                    },
                    unit : {
                        required: true,
                    },
                    kesatuan : {
                        required: true,
                    },
                    fungsional : {
                        required: true,
                    },
                },
                messages : {
                    name: "Silahkan isi Nama!",
                    nrp: "Silahkan isi NRP!",
                    id_pangkat: "Silahkan Pilih Pangkat!",
                    jabatan: "Silahkan isi Jabatan!",
                    tim: "Silahkan Pilih Tim!",
                    unit: "Silahkan isi Unit!",
                    kesatuan: "Silahkan isi Kesatuan!",
                    Fungsional: "Silahkan Pilih Fungsional!",
                },
                errorElement : 'label',
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                success: function(label,element) {
                    label.parent().removeClass('error');
                    label.remove(); 
                },
                submitHandler: function (form) { // for demo
                    form.submit();
                }
            });
        });
        
    </script>
@endsection
