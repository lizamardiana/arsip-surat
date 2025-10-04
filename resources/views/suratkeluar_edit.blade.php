@extends('layouts.app')

@section('title', 'Edit Surat Keluar')

@section('content')
<div class="container py-4">
  <h2 class="mb-4 text-center">✏️ Edit Surat Keluar</h2>

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('suratkeluar.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Tujuan</label>
            <input type="text" class="form-control" name="tujuan" value="{{ $surat->tujuan }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">No Surat</label>
            <input type="text" class="form-control" name="no_surat" value="{{ $surat->no_surat }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Perihal</label>
            <input type="text" class="form-control" name="perihal" value="{{ $surat->perihal }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tanggal Surat</label>
            <input type="date" class="form-control" name="tanggal_surat" value="{{ $surat->tanggal_surat }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Tanggal Surat Keluar</label>
            <input type="date" class="form-control" name="tanggal_keluar" value="{{ $surat->tanggal_keluar }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Upload File (kosongkan jika tidak diubah)</label>
            <input type="file" class="form-control" name="file" accept=".pdf,.jpg,.png,.doc,.docx">
            @if($surat->file_upload)
              <small class="d-block mt-1">
                File saat ini: 
                <a href="{{ asset('uploads/'.$surat->file_upload) }}" target="_blank">Lihat</a>
              </small>
            @endif
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          <a href="{{ route('suratkeluar.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
