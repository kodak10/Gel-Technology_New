@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Ajouter un nouveau témoignage</h4>
                    <a href="{{ route('administration.temoignages.index') }}" class="btn btn-sm btn-secondary">
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
                    <form action="{{ route('administration.temoignages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Informations du temoignage</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name" 
                                                           class="form-control @error('name') is-invalid @enderror" 
                                                           value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="position" class="form-label">Poste/Fonction</label>
                                                    <input type="text" name="position" id="position" 
                                                           class="form-control @error('position') is-invalid @enderror" 
                                                           value="{{ old('position') }}">
                                                    @error('position')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="company" class="form-label">Entreprise</label>
                                            <input type="text" name="company" id="company" 
                                                   class="form-control @error('company') is-invalid @enderror" 
                                                   value="{{ old('company') }}">
                                            @error('company')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Témoignage <span class="text-danger">*</span></label>
                                            <textarea name="content" id="content" rows="4" 
                                                      class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Note <span class="text-danger">*</span></label>
                                            <div class="rating-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                                           {{ old('rating') == $i ? 'checked' : '' }} required>
                                                    <label for="star{{ $i }}" title="{{ $i }} étoiles">
                                                        <i class="fas fa-star"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                            @error('rating')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="order" class="form-label">Ordre d'affichage</label>
                                            <input type="number" name="order" id="order" 
                                                   class="form-control @error('order') is-invalid @enderror" 
                                                   value="{{ old('order', 0) }}" min="0">
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
                                        <h5 class="card-title mb-0">Photo du client</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Photo</label>
                                            <input type="file" name="avatar" id="avatar" 
                                                   class="form-control @error('avatar') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'avatar-preview')">
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format: JPEG, PNG, GIF, WebP. Max: 1MB</small>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <img id="avatar-preview" src="#" alt="Prévisualisation" 
                                                 class="img-fluid rounded-circle" style="display: none; width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Logo de l'entreprise</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="company_logo" class="form-label">Logo</label>
                                            <input type="file" name="company_logo" id="company_logo" 
                                                   class="form-control @error('company_logo') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'logo-preview')">
                                            @error('company_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format: JPEG, PNG, GIF, WebP, SVG. Max: 1MB</small>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <img id="logo-preview" src="#" alt="Prévisualisation" 
                                                 class="img-fluid rounded" style="display: none; max-height: 100px;">
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
                                                       id="is_active" value="1" checked>
                                                <label class="form-check-label" for="is_active">
                                                    Témoignage actif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Ajouter le témoignage
                                    </button>
                                    <a href="{{ route('administration.temoignages.index') }}" class="btn btn-secondary">
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

@push('styles')
<style>
    .rating-stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    
    .rating-stars input {
        display: none;
    }
    
    .rating-stars label {
        cursor: pointer;
        font-size: 1.5rem;
        color: #ddd;
        transition: color 0.2s;
        margin-right: 5px;
    }
    
    .rating-stars label:hover,
    .rating-stars label:hover ~ label,
    .rating-stars input:checked ~ label {
        color: #ffc107;
    }
</style>
@endpush

@push('scripts')
<script>
    function previewImage(event, previewId) {
        const reader = new FileReader();
        const imagePreview = document.getElementById(previewId);
        
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush