@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('content')
<div class="container py-4">

  {{-- Alert Pesan Error & Success --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between mb-3">
    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
      + Tambah Surat
    </button>
  </div>


  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table id="suratTable" class="table table-striped table-bordered align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Pengirim</th>
              <th>No Surat</th>
              <th>Perihal</th>
              <th>Tanggal Surat</th>
              <th>Tanggal Surat Masuk</th>
              <th>File</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($surat as $key => $item)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->pengirim }}</td>
                <td>{{ $item->no_surat }}</td>
                <td>{{ $item->perihal }}</td>
                <td>{{ $item->tanggal_surat }}</td>
                <td>{{ $item->tanggal_masuk }}</td>
                <td class="text-center">
                  @if($item->file_upload)
                    <a href="{{ asset('uploads/'.$item->file_upload) }}" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                <td class="text-center">
  <!-- Tombol Edit -->
  <a href="{{ route('suratmasuk.edit', $item->id) }}" class="btn btn-sm btn-warning">
    <i class="bi bi-pencil-square"></i>
  </a>

  <!-- Tombol Hapus -->
  <form action="{{ route('suratmasuk.destroy', $item->id) }}" method="POST" class="d-inline" 
        onsubmit="return confirm('Yakin ingin menghapus surat ini?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
  </form>
</td>

              </tr>
            @empty
  <tr>
    <td colspan="1" class="text-center" colspan="8">Belum ada data</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
@endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Surat -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Tambah Surat Masuk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Pengirim</label>
              <input type="text" class="form-control" name="pengirim" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">No Surat</label>
              <input type="text" class="form-control" name="no_surat" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Perihal</label>
              <input type="text" class="form-control" name="perihal" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tanggal Surat</label>
              <input type="date" class="form-control" name="tanggal_surat" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tanggal Surat Masuk</label>
              <input type="date" class="form-control" name="tanggal_masuk" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Upload File</label>
              <input type="file" class="form-control" name="file" accept=".pdf,.jpg,.png,.doc,.docx">
            </div>
          </div>
        </div>
        <div class="modal-footer flex-wrap">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- DataTables Script --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#suratTable').DataTable({
      "pageLength": 5,
      "lengthMenu": [5, 10, 25, 50, 100],
      "ordering": false, // biar ga error kalau ada colspan
    });
  });
</script>
@endsection
