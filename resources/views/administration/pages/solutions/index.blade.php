@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">Gestion des Solutions</h4>
                    <a href="{{ route('administration.solutions.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Ajouter une solution
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($solutions->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucune solution créée pour le moment.</p>
                            <a href="{{ route('administration.solutions.create') }}" class="btn btn-primary mt-2">Créer votre première solution</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover" id="solutions-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th style="width: 80px">Image</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Description</th>
                                        <th style="width: 100px">Ordre</th>
                                        <th style="width: 100px">Statut</th>
                                        <th style="width: 100px">À la une</th>
                                        <th style="width: 120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($solutions as $solution)
                                        <tr data-id="{{ $solution->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($solution->image_url)
                                                    <img src="{{ $solution->image_url }}" alt="{{ $solution->title }}" 
                                                         style="width: 60px; height: 50px; object-fit: cover;" class="rounded">
                                                @else
                                                    <i class="fa fa-image" style="font-size: 30px;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $solution->title }}</strong>
                                            </td>
                                            <td>
                                                @if($solution->categorie)
                                                    <span class="badge" style="background-color: {{ $solution->categorie->color ?? '#6c757d' }}; color: white;">
                                                        {{ $solution->categorie->name }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">Non catégorisé</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Illuminate\Support\Str::limit($solution->short_description, 60) }}
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $solution->order }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.solutions.toggle-status', $solution) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $solution->is_active ? 'success' : 'secondary' }}">
                                                        {{ $solution->is_active ? 'Actif' : 'Inactif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.solutions.toggle-featured', $solution) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $solution->featured ? 'warning' : 'secondary' }}">
                                                        {{ $solution->featured ? 'Oui' : 'Non' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('administration.solutions.edit', $solution) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('administration.solutions.destroy', $solution) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette solution ?');">
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $("#sortable").sortable({
            update: function(event, ui) {
                var order = [];
                $('#sortable tr').each(function(index, element) {
                    order.push($(this).data('id'));
                });

                $.ajax({
                    url: "{{ route('administration.solutions.update-order') }}",
                    type: "POST",
                    data: {
                        order: order,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if(response.success) {
                            location.reload();
                        }
                    }
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
@endpush