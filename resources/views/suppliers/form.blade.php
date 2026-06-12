@extends('layouts.admin')
@section('title', $supplier->exists ? 'Editar fornecedor' : 'Cadastrar fornecedor')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">{{ $supplier->exists ? 'Editar fornecedor' : 'Cadastrar fornecedor' }}</div>
        <div class="page-sub">Formulário completo com dados básicos, contato, categoria e validação automática de CPF/CNPJ.</div>
    </div>
    <a href="{{ route('suppliers.index') }}" class="btn-secondary-sm"><i class="bi bi-arrow-left"></i> Cancelar</a>
</div>

<form method="POST" action="{{ $supplier->exists ? route('suppliers.update', $supplier) : route('suppliers.store') }}" class="content-card p-4">
    @csrf
    @if($supplier->exists) @method('PUT') @endif

    <h6 class="mb-3"><i class="bi bi-building me-2"></i>Dados básicos</h6>
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="form-label">Nome / Razão social</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">CPF/CNPJ</label>
            <input type="text" name="document" id="document" class="form-control" value="{{ old('document', $supplier->document) }}" required placeholder="Somente números ou com máscara">
            <small id="docHelp" class="muted">Validação: CPF 11 dígitos ou CNPJ 14 dígitos.</small>
        </div>
        <div class="col-md-3">
            <label class="form-label">Categoria</label>
            <select name="category" class="form-select" required>
                @foreach(['Tecnologia','Serviços Gerais','Construção','Alimentação','Transporte','Consultoria','Material de Expediente','Geral'] as $category)
                    <option value="{{ $category }}" @selected(old('category', $supplier->category) === $category)>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="pending" @selected(old('status', $supplier->status) === 'pending')>Pendente</option>
                <option value="active" @selected(old('status', $supplier->status) === 'active')>Ativo</option>
                <option value="inactive" @selected(old('status', $supplier->status) === 'inactive')>Inativo</option>
            </select>
        </div>
    </div>

    <h6 class="mb-3"><i class="bi bi-person-lines-fill me-2"></i>Contato</h6>
    <div class="row g-3 mb-4">
        <div class="col-md-4"><label class="form-label">E-mail de acesso</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
        <div class="col-md-4"><label class="form-label">Telefone de acesso</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}"></div>
        <div class="col-md-4"><label class="form-label">Responsável</label><input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', $supplier->contact_name) }}"></div>
        <div class="col-md-4"><label class="form-label">E-mail do responsável</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $supplier->contact_email) }}"></div>
        <div class="col-md-4"><label class="form-label">Telefone do responsável</label><input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $supplier->contact_phone) }}"></div>
        <div class="col-md-4"><label class="form-label">Endereço</label><input type="text" name="address" class="form-control" value="{{ old('address', $supplier->address) }}"></div>
    </div>

    <h6 class="mb-3"><i class="bi bi-key me-2"></i>Acesso</h6>
    <div class="row g-3 mb-4">
        <div class="col-md-6"><label class="form-label">Senha {{ $supplier->exists ? '(deixe em branco para manter)' : '(opcional)' }}</label><input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres"></div>
        <div class="col-md-6"><label class="form-label">Confirmar senha</label><input type="password" name="password_confirmation" class="form-control"></div>
        <div class="col-12"><label class="form-label">Observações</label><textarea name="notes" class="form-control" rows="3">{{ old('notes', $supplier->notes) }}</textarea></div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('suppliers.index') }}" class="btn-secondary-sm">Cancelar</a>
        <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Salvar</button>
    </div>
</form>

@push('scripts')
<script>
function validarCpfCnpj(valor) {
    const digits = valor.replace(/\D/g, '');
    const help = document.getElementById('docHelp');
    if (!digits) { help.textContent = 'Validação: CPF 11 dígitos ou CNPJ 14 dígitos.'; help.style.color = ''; return; }
    if (digits.length === 11) { help.textContent = 'Formato detectado: CPF.'; help.style.color = '#34d399'; return; }
    if (digits.length === 14) { help.textContent = 'Formato detectado: CNPJ.'; help.style.color = '#34d399'; return; }
    help.textContent = 'Documento inválido: use CPF com 11 dígitos ou CNPJ com 14 dígitos.';
    help.style.color = '#f87171';
}
document.getElementById('document').addEventListener('input', e => validarCpfCnpj(e.target.value));
validarCpfCnpj(document.getElementById('document').value);
</script>
@endpush

@endsection
