@extends('layouts.admin')
@section('title', 'Enviar Documento')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">Enviar Documento</div>
        <div class="page-sub">Faça upload do arquivo e informe a validade para controle automático.</div>
    </div>
    <a href="{{ route('documents.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Cancelar</a>
</div>

<form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="content-card p-4">
    @csrf
    <div class="row g-3">
        @if(Auth::user()->role === 'admin')
            <div class="col-md-6">
                <label class="form-label">Fornecedor</label>
                <select name="supplier_id" class="form-select" required>
                    <option value="">Selecione</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>{{ optional($supplier->user)->name }} — {{ $supplier->document }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-md-6">
            <label class="form-label">Tipo de documento</label>
            <select name="document_type" class="form-select" required>
                @foreach(['Contrato Social','CNPJ','Certidão Negativa','Alvará','Comprovante Bancário','Documento de Identificação','Outro'] as $type)
                    <option value="{{ $type }}" @selected(old('document_type') === $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Data de validade</label>
            <input type="date" name="expiration_date" class="form-control" value="{{ old('expiration_date') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Arquivo</label>
            <input type="file" name="file" class="form-control" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
            <small class="muted">PDF, imagens ou documentos até 10MB.</small>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('documents.index') }}" class="btn-secondary-sm">Cancelar</a>
        <button class="btn-primary-sm"><i class="bi bi-cloud-upload"></i> Enviar</button>
    </div>
</form>

@endsection
