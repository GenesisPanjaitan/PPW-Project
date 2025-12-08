@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-3">Edit Posting Lowongan</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('recruitment.update', ['id' => $r->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Perusahaan</label>
                <input type="text" name="company" class="form-control" value="{{ old('company', $r->company_name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Posisi</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $r->position) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('kategori') == $cat->id) || ($r->category_id == $cat->id && !old('kategori')) ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tipe Pekerjaan</label>
                <select name="tipe" class="form-select">
                    <option value="">-- Pilih Tipe --</option>
                    @foreach($jobtypes as $jt)
                        <option value="{{ $jt->id }}" {{ (old('tipe') == $jt->id) || ($r->jobtype_id == $jt->id && !old('tipe')) ? 'selected' : '' }}>{{ $jt->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $r->location) }}">
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="6">{{ old('deskripsi', $r->description) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Link</label>
                <input type="text" name="link" class="form-control" value="{{ old('link', $r->link) }}">
            </div>

            <div class="col-12">
                <label class="form-label">Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control">
                @if($r->image)
                    <p class="small mt-2">Gambar saat ini: {{ $r->image }}</p>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('recruitment') }}" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</div>

@endsection
