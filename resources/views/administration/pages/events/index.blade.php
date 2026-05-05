@extends('Administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Gestion des Événements</h4>
                    <a href="{{ route('events.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Ajouter un événement
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($events->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucun événement ajouté pour le moment.</p>
                            <a href="{{ route('events.create') }}" class="btn btn-primary mt-2">Ajouter votre premier événement</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover" id="events-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 100px;">Image</th>
                                        <th>Titre</th>
                                        <th style="width: 100px;">Date</th>
                                        <th style="width: 100px;">Catégorie</th>
                                        <th style="width: 80px;">Vues</th>
                                        <th style="width: 100px;">Statut</th>
                                        <th style="width: 100px;">À la une</th>
                                        <th style="width: 120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" 
                                                     class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <strong>{{ Str::limit($event->title, 50) }}</strong>
                                                @if($event->featured)
                                                    <span class="badge bg-warning ms-1">À la une</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $event->formatted_date }}</span>
                                            </td>
                                            <td>
                                                @if($event->category)
                                                    <span class="badge bg-info">{{ $event->category }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $event->views }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('events.toggle-published', $event) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $event->is_published ? 'success' : 'secondary' }}">
                                                        {{ $event->is_published ? 'Publié' : 'Brouillon' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('events.toggle-featured', $event) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $event->featured ? 'warning' : 'secondary' }}">
                                                        {{ $event->featured ? 'Oui' : 'Non' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('events.show', $event->slug) }}" target="_blank" class="btn btn-sm btn-info" title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('events.destroy', $event) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#events-table').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            },
            order: [[3, 'desc']], // Tri par date descendante par défaut
            columnDefs: [
                { orderable: false, targets: [0, 1, 5, 6, 7, 8] }
            ]
        });
    });
</script>
@endpush