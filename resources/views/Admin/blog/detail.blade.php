@extends('layout.admin')
@section('content')
@section('judul', 'Detail Artikel')

<div class="row p-2">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="form">
                    <div class="form-group">
                        <label for="id_artikel">ID Artikel</label>
                        <input type="number" class="form-control" name="id_artikel" id="id_artikel"
                            aria-describedby="helpId" value="{{ $data->id_artikel }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul"
                            aria-describedby="helpId" value="{{ $data->judul }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" name="author" id="author"
                            aria-describedby="helpId" value="{{ $data->users->username }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal"
                            aria-describedby="helpId" value="{{ $data->tanggal }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="Segmen">Segmen</label>
                        <input type="text" class="form-control" name="segmen" id="segmen"
                            aria-describedby="helpId" value="{{ $data->segmen->segmen }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn btn-warning text-white text-end" data-toggle="modal"
                data-target="#editmodal">Edit</button>
            <button class="btn btn btn-danger text-white" data-toggle="modal" data-target="#hapusmodal">Hapus</button>
            <a href="{{ route('blog.index') }}" class="btn btn btn-secondary text-white text-end">Kembali</a>
        </div>
    </div>
    {{-- compose --}}
    <div class="col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <label for="compose">Detail Artikel</label>
            </div>
            <div class="card-body">
                <textarea id="isi" name="isi" style="display: none;">{{ $data->isi }}</textarea>

                <div id="tampilan_isi">

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <p>Konfirmasi</p>
          </div>

            <div class="modal-body">
                <h1 class="text-center" style="font-size: 30px;">Yakin Ingin Merubah Data ?</h1>
            </div>

            <div class="modal-footer">
                <button class="btn btn btn-outline-secondary text-white" data-dismiss="modal">Tidak</button>
                <a href="{{ route('blog.edit', $data->id) }}" class="btn btn btn-danger text-white">Iya</a>
            </div>
        </div>
    </div>
</div>

<!-- Hapus Modal -->
<div class="modal fade" id="hapusmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <p>Konfirmasi</p>
          </div>

            <div class="modal-body">
                <h1 class="text-center" style="font-size: 30px;">Yakin Ingin Menghapus Data ?</h1>
            </div>

            <div class="modal-footer">
              <a href="{{ route('blog.hapus', $data->id) }}" class="btn btn btn-danger text-white">Iya</a>
                <button class="btn btn btn-outline-secondary text-white" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>


<style>
    .modal-footer {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: end;
        justify-content: space-between;
        padding: 0.75rem;
        border-top: 1px solid #e9ecef;
        border-bottom-right-radius: calc(0.3rem - 1px);
        border-bottom-left-radius: calc(0.3rem - 1px);
    }
</style>

@if (Session::has('berhasil'))
    <script>
        $(document).ready(function() {
            $('#messageModal').modal('show');
        });
    </script>
@endif
@endsection
