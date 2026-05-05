@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Modifier la réalisation : {{ $project->title }}</h4>
                    <a href="{{ route('administration.projects.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Retour
                    </a>
                </div>
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('administration.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Informations de base</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" 
                                                   class="form-control @error('title') is-invalid @enderror" 
                                                   value="{{ old('title', $project->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" rows="4" 
                                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Catégorie</label>
                                                    <input type="text" name="category" id="category" 
                                                           class="form-control @error('category') is-invalid @enderror" 
                                                           value="{{ old('category', $project->category) }}">
                                                    @error('category')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="order" class="form-label">Ordre d'affichage</label>
                                                    <input type="number" name="order" id="order" 
                                                           class="form-control @error('order') is-invalid @enderror" 
                                                           value="{{ old('order', $project->order) }}" min="0">
                                                    @error('order')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Image</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" 
                                                 class="img-fluid rounded" style="max-height: 200px;">
                                            <p class="text-muted small mt-2">Image actuelle</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Changer l'image</label>
                                            <input type="file" name="image" id="image" 
                                                   class="form-control @error('image') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'new-image-preview')">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mt-2" id="new-image-preview-container" style="display: none;">
                                            <img id="new-image-preview" src="#" alt="Nouvelle image" 
                                                 class="img-fluid rounded" style="max-height: 200px;">
                                            <p class="text-muted small mt-2">Nouvelle image</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Paramètres</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active" 
                                                       id="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    Réalisation active
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="featured" 
                                                       id="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured">
                                                    Mettre en avant
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Créé le: {{ $project->created_at->format('d/m/Y H:i') }}<br>
                                                Modifié le: {{ $project->updated_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Mettre à jour
                                    </button>
                                    <a href="{{ route('administration.projects.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i> Annuler
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event, previewId) {
        const reader = new FileReader();
        const imagePreview = document.getElementById(previewId);
        const container = document.getElementById(previewId + '-container');
        
        reader.onload = function() {
            imagePreview.src = reader.result;
            if (container) {
                container.style.display = 'block';
            }
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush