@extends('Administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">Gestion des Catégories</h4>
                    <a href="{{ route('administration.categories.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Ajouter une catégorie
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($categories->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucune catégorie créée pour le moment.</p>
                            <a href="{{ route('administration.categories.create') }}" class="btn btn-primary mt-2">Créer votre première catégorie</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover" id="categories-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th style="width: 80px">Icône</th>
                                        <th>Nom</th>
                                        <th>Slug</th>
                                        <th style="width: 100px">Ordre</th>
                                        <th style="width: 100px">Statut</th>
                                        <th style="width: 120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($categories as $category)
                                        <tr data-id="{{ $category->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($category->icon)
                                                    <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" 
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <i class="fa fa-folder" style="font-size: 30px;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $category->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $category->solutions->count() }} solution(s)</small>
                                            </td>
                                            :<td>{{ $category->slug }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $category->order }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('administration.categories.toggle-status', $category) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $category->is_active ? 'success' : 'secondary' }}">
                                                        {{ $category->is_active ? 'Actif' : 'Inactif' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('administration.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('administration.categories.destroy', $category) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
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
                    url: "{{ route('administration.categories.update-order') }}",
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