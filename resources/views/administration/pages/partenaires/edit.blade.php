@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Modifier le partenaire : {{ $partenaire->name }}</h4>
                    <a href="{{ route('administration.partenaires.index') }}" class="btn btn-sm btn-secondary">
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
                    <form action="{{ route('administration.partenaires.update', $partenaire) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Informations du partenaire</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom du partenaire <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   value="{{ old('name', $partenaire->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="website" class="form-label">Site web</label>
                                            <input type="url" name="website" id="website" 
                                                   class="form-control @error('website') is-invalid @enderror" 
                                                   value="{{ old('website', $partenaire->website) }}">
                                            @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="order" class="form-label">Ordre d'affichage</label>
                                            <input type="number" name="order" id="order" 
                                                   class="form-control @error('order') is-invalid @enderror" 
                                                   value="{{ old('order', $partenaire->order) }}" min="0">
                                            @error('order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Logo</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <img src="{{ $partenaire->logo_url }}" alt="{{ $partenaire->name }}" 
                                                 class="img-fluid rounded" style="max-height: 150px;">
                                            <p class="text-muted small mt-2">Logo actuel</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Changer le logo</label>
                                            <input type="file" name="logo" id="logo" 
                                                   class="form-control @error('logo') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'new-logo-preview')">
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mt-2" id="new-logo-preview-container" style="display: none;">
                                            <img id="new-logo-preview" src="#" alt="Nouveau logo" 
                                                 class="img-fluid rounded" style="max-height: 150px;">
                                            <p class="text-muted small mt-2">Nouveau logo</p>
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
                                                       id="is_active" value="1" {{ old('is_active', $partenaire->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    partenaire actif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ajouté le: {{ $partenaire->created_at->format('d/m/Y H:i') }}<br>
                                                Modifié le: {{ $partenaire->updated_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Mettre à jour
                                    </button>
                                    <a href="{{ route('administration.partenaires.index') }}" class="btn btn-secondary">
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