@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Gestion des Réalisations</h4>
                    <a href="{{ route('administration.projects.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Ajouter une réalisation
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($projects->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucune réalisation créée pour le moment.</p>
                            <a href="{{ route('administration.projects.create') }}" class="btn btn-primary mt-2">Créer votre première réalisation</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover" id="projects-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 100px;">Image</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th style="width: 80px;">Ordre</th>
                                        <th style="width: 100px;">Statut</th>
                                        <th style="width: 100px;">À la une</th>
                                        <th style="width: 120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($projects as $project)
                                        <tr data-id="{{ $project->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($project->image_url && file_exists(public_path($project->image_path)))
                                                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" 
                                                         class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 80px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $project->title }}</strong>
                                                @if($project->description)
                                                    <p class="text-muted mb-0 small">{{ \Illuminate\Support\Str::limit($project->description, 50) }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($project->category)
                                                    <span class="badge bg-info">{{ $project->category }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $project->order }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.projects.toggle-status', $project) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $project->is_active ? 'success' : 'secondary' }}">
                                                        {{ $project->is_active ? 'Actif' : 'Inactif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.projects.toggle-featured', $project) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $project->featured ? 'warning' : 'secondary' }}">
                                                        {{ $project->featured ? 'Oui' : 'Non' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('administration.projects.edit', $project) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('administration.projects.destroy', $project) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réalisation ?');">
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        // Vérifier si DataTable est chargé
        if ($.fn.dataTable) {
            $('#projects-table').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
                },
                columnDefs: [
                    { orderable: false, targets: [0, 1, 5, 6, 7] }
                ]
            });
        }

        // Fonctionnalité de tri par glisser-déposer
        $("#sortable").sortable({
            update: function(event, ui) {
                var order = [];
                $('#sortable tr').each(function(index, element) {
                    order.push($(this).data('id'));
                });

                $.ajax({
                    url: "{{ route('administration.projects.update-order') }}",
                    type: "POST",
                    data: {
                        order: order,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if(response.success) {
                            console.log('Ordre mis à jour avec succès');
                        }
                    },
                    error: function(xhr) {
                        console.error('Erreur lors de la mise à jour de l\'ordre');
                    }
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
@endpush