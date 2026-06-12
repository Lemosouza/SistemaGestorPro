@if(($status ?? '') === 'active')
    <span class="badge-status badge-active">Ativo</span>
@elseif(($status ?? '') === 'inactive')
    <span class="badge-status badge-inactive">Inativo</span>
@else
    <span class="badge-status badge-pending">Pendente</span>
@endif
