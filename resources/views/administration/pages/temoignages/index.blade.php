@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Gestion des Témoignages</h4>
                    <a href="{{ route('administration.temoignages.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Ajouter un témoignage
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($temoignages->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucun témoignage ajouté pour le moment.</p>
                            <a href="{{ route('administration.temoignages.create') }}" class="btn btn-primary mt-2">Ajouter votre premier témoignage</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover" id="testimonials-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 80px;">Photo</th>
                                        <th>Nom & Poste</th>
                                        <th>Témoignage</th>
                                        <th style="width: 100px;">Note</th>
                                        <th style="width: 80px;">Ordre</th>
                                        <th style="width: 100px;">Statut</th>
                                        <th style="width: 120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($temoignages as $temoignage)
                                        <tr data-id="{{ $temoignage->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $temoignage->avatar_url }}" alt="{{ $temoignage->name }}" 
                                                     class="img-thumbnail rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <strong>{{ $temoignage->name }}</strong>
                                                @if($temoignage->position)
                                                    <p class="mb-0 small">{{ $temoignage->position }}</p>
                                                @endif
                                                @if($temoignage->company)
                                                    <p class="mb-0 small text-muted">{{ $temoignage->company }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ Str::limit($temoignage->content, 100) }}</p>
                                            </td>
                                            <td>
                                                <div class="star-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $temoignage->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $temoignage->order }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.temoignages.toggle-status', $temoignage) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $temoignage->is_active ? 'success' : 'secondary' }}">
                                                        {{ $temoignage->is_active ? 'Actif' : 'Inactif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('administration.temoignages.edit', $temoignage) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('administration.temoignages.destroy', $temoignage) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce témoignage ?');">
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
<style>
    .star-rating {
        font-size: 0.9rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('#testimonials-table').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
            },
            columnDefs: [
                { orderable: false, targets: [0, 1, 5, 6, 7] }
            ]
        });

        $("#sortable").sortable({
            update: function(event, ui) {
                var order = [];
                $('#sortable tr').each(function(index, element) {
                    order.push($(this).data('id'));
                });

                $.ajax({
                    url: "{{ route('administration.temoignages.update-order') }}",
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