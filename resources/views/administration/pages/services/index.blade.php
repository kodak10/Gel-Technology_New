@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">Gestion des Services</h4>
                    <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Ajouter un service
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <select id="solution-filter" class="form-select">
                                <option value="">Toutes les solutions</option>
                                @foreach($solutions as $solution)
                                    <option value="{{ $solution->id }}">{{ $solution->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select id="status-filter" class="form-select">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actifs seulement</option>
                                <option value="inactive">Inactifs seulement</option>
                            </select>
                        </div>
                    </div>

                    @if($services->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucun service créé pour le moment.</p>
                            <a href="{{ route('services.create') }}" class="btn btn-primary mt-2">Créer votre premier service</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered" id="services-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Solution</th>
                                        <th>Description</th>
                                        <th>Ordre</th>
                                        <th>Statut</th>
                                        <th>À la une</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr data-solution="{{ $service->solution_id }}" 
                                            data-status="{{ $service->is_active ? 'active' : 'inactive' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($service->image_path)
                                                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}" 
                                                         class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="badge bg-secondary">Pas d'image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $service->title }}</strong>
                                                <br>
                                                <small class="text-muted">Slug: {{ $service->slug }}</small>
                                            </td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $service->solution->color ?? '#6c757d' }}; color: white;">
                                                    {{ $service->solution->title }}
                                                </span>
                                            </td>
                                            <td>{{ Str::limit($service->description, 60) }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $service->order }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('services.toggle-status', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $service->is_active ? 'success' : 'secondary' }}">
                                                        {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('services.toggle-featured', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $service->featured ? 'warning' : 'secondary' }}">
                                                        {{ $service->featured ? 'Oui' : 'Non' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('services.destroy', $service) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
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
        const table = $('#services-table').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            },
            columnDefs: [
                { orderable: false, targets: [0, 1, 6, 7, 8] }
            ]
        });

        // Filter by solution
        $('#solution-filter').on('change', function() {
            const solutionId = $(this).val();
            table.column(3).search(solutionId).draw();
        });

        // Filter by status
        $('#status-filter').on('change', function() {
            const status = $(this).val();
            table.column(6).search(status).draw();
        });
    });
</script>
@endpush