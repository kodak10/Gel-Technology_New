@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Gestion des Partenaire</h4>
                    <a href="{{ route('administration.partenaires.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Ajouter un partenaire
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($partenaires->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucun partenaire ajouté pour le moment.</p>
                            <a href="{{ route('administration.partenaires.create') }}" class="btn btn-primary mt-2">Ajouter votre premier partenaire</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover" id="clients-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 100px;">Logo</th>
                                        <th>Nom</th>
                                        <th>Site web</th>
                                        <th style="width: 80px;">Ordre</th>
                                        <th style="width: 100px;">Statut</th>
                                        <th style="width: 120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($partenaires as $partenaire)
                                        <tr data-id="{{ $partenaire->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $partenaire->logo_url }}" alt="{{ $partenaire->name }}" 
                                                     class="img-thumbnail" style="width: 80px; height: 60px; object-fit: contain; background: #f8f9fa;">
                                            </td>
                                            <td>
                                                <strong>{{ $partenaire->name }}</strong>
                                            </td>
                                            <td>
                                                @if($partenaire->website)
                                                    <a href="{{ $partenaire->website }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                                                        <i class="fas fa-external-link-alt me-1"></i>
                                                        {{ parse_url($partenaire->website, PHP_URL_HOST) }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $partenaire->order }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.partenaires.toggle-status', $partenaire) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $partenaire->is_active ? 'success' : 'secondary' }}">
                                                        {{ $partenaire->is_active ? 'Actif' : 'Inactif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('administration.partenaires.edit', $partenaire) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('administration.partenaires.destroy', $partenaire) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('#partenaires-table').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            },
            columnDefs: [
                { orderable: false, targets: [0, 1, 5, 6] }
            ]
        });

        $("#sortable").sortable({
            update: function(event, ui) {
                var order = [];
                $('#sortable tr').each(function(index, element) {
                    order.push($(this).data('id'));
                });

                $.ajax({
                    url: "{{ route('administration.partenaires.update-order') }}",
                    type: "POST",
                    data: {
                        order: order,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Ordre mis à jour');
                    }
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
@endpush