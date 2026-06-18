@if(($status ?? '') === 'approved')
    <span class="badge-status badge-active">Aprovado</span>
@elseif(($status ?? '') === 'rejected')
    <span class="badge-status badge-inactive">Reprovado</span>
@else
    <span class="badge-status badge-pending">Em análise</span>
@endif
