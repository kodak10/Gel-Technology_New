@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">Gestion des Bannières</h4>
                    <a href="{{ route('administration.banners.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Ajouter une bannière
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($banners->isEmpty())
                        <div class="text-center py-5">
                            <p class="text-muted">Aucune bannière créée pour le moment.</p>
                            <a href="{{ route('administration.banners.create') }}" class="btn btn-primary mt-2">Créer votre première bannière</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered" id="banners-table">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Sous-titre</th>
                                        <th>Description</th>
                                        <th>Ordre</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($banners as $banner)
                                        <tr data-id="{{ $banner->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($banner->background_image)
                                                    <img src="{{ asset($banner->background_image) }}" alt="{{ $banner->title }}" 
                                                         class="img-thumbnail" style="width: 80px; height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="badge bg-secondary">Pas d'image</span>
                                                @endif
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($banner->title, 30) }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($banner->sub_title, 30) }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($banner->description, 50) }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $banner->order }}</span>
                                            </td>
                                            <td>
                                                @if($banner->is_active)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('administration.banners.edit', $banner) }}" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('administration.banners.destroy', $banner) }}" method="POST" 
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette bannière ?');">
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