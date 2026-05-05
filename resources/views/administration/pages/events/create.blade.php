@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Ajouter un nouvel événement</h4>
                    <a href="{{ route('events.index') }}" class="btn btn-sm btn-secondary">
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
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Contenu de l'événement</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" 
                                                   class="form-control @error('title') is-invalid @enderror" 
                                                   value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug (URL)</label>
                                            <input type="text" name="slug" id="slug" 
                                                   class="form-control @error('slug') is-invalid @enderror" 
                                                   value="{{ old('slug') }}">
                                            @error('slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Laissez vide pour générer automatiquement depuis le titre</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="excerpt" class="form-label">Extrait</label>
                                            <textarea name="excerpt" id="excerpt" 
                                                      class="form-control @error('excerpt') is-invalid @enderror" 
                                                      rows="3">{{ old('excerpt') }}</textarea>
                                            @error('excerpt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Court résumé (max 500 caractères)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                                            <textarea name="content" id="content" 
                                                      class="form-control @error('content') is-invalid @enderror" 
                                                      rows="10" required>{{ old('content') }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Image principale</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" id="image" 
                                                   class="form-control @error('image') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'image-preview')" required>
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Format: JPEG, PNG, GIF, WebP. Max: 2MB</small>
                                        </div>
                                        
                                        <div class="mt-2">
                                            <img id="image-preview" src="#" alt="Prévisualisation" 
                                                 class="img-fluid rounded" style="display: none; max-height: 200px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Détails de l'événement</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" id="date" 
                                                   class="form-control @error('date') is-invalid @enderror" 
                                                   value="{{ old('date') }}" required>
                                            @error('date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="time_start" class="form-label">Heure de début</label>
                                                <input type="time" name="time_start" id="time_start" 
                                                       class="form-control @error('time_start') is-invalid @enderror" 
                                                       value="{{ old('time_start') }}">
                                                @error('time_start')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="time_end" class="form-label">Heure de fin</label>
                                                <input type="time" name="time_end" id="time_end" 
                                                       class="form-control @error('time_end') is-invalid @enderror" 
                                                       value="{{ old('time_end') }}">
                                                @error('time_end')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="location" class="form-label">Lieu</label>
                                            <input type="text" name="location" id="location" 
                                                   class="form-control @error('location') is-invalid @enderror" 
                                                   value="{{ old('location') }}">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Catégorie</label>
                                            <input type="text" name="category" id="category" 
                                                   class="form-control @error('category') is-invalid @enderror" 
                                                   value="{{ old('category') }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="registration_link" class="form-label">Lien d'inscription</label>
                                            <input type="url" name="registration_link" id="registration_link" 
                                                   class="form-control @error('registration_link') is-invalid @enderror" 
                                                   value="{{ old('registration_link') }}" placeholder="https://...">
                                            @error('registration_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                                <input class="form-check-input" type="checkbox" name="is_published" 
                                                       id="is_published" value="1" checked>
                                                <label class="form-check-label" for="is_published">
                                                    Publié immédiatement
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="featured" 
                                                       id="featured" value="1">
                                                <label class="form-check-label" for="featured">
                                                    Mettre à la une
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Ajouter l'événement
                                    </button>
                                    <a href="{{ route('events.index') }}" class="btn btn-secondary">
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
        
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }

    // Génération automatique du slug
    document.getElementById('title').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value) {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Supprime les caractères spéciaux
                .replace(/\s+/g, '-') // Remplace les espaces par des tirets
                .replace(/--+/g, '-'); // Remplace les tirets multiples par un seul
            slugInput.value = slug;
        }
    });
</script>
@endpush