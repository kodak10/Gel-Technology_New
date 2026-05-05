@extends('administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Modifier l'événement : {{ $event->title }}</h4>
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
                    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
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
                                                   value="{{ old('title', $event->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Slug (URL)</label>
                                            <input type="text" name="slug" id="slug" 
                                                   class="form-control @error('slug') is-invalid @enderror" 
                                                   value="{{ old('slug', $event->slug) }}">
                                            @error('slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Laissez vide pour générer automatiquement depuis le titre</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="excerpt" class="form-label">Extrait</label>
                                            <textarea name="excerpt" id="excerpt" 
                                                      class="form-control @error('excerpt') is-invalid @enderror" 
                                                      rows="3">{{ old('excerpt', $event->excerpt) }}</textarea>
                                            @error('excerpt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                                            <textarea name="content" id="content" 
                                                      class="form-control @error('content') is-invalid @enderror" 
                                                      rows="10" required>{{ old('content', $event->content) }}</textarea>
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
                                        <div class="text-center mb-3">
                                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}" 
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
                                                 class="img-fluid rounded" style="max-height: 150px;">
                                            <p class="text-muted small mt-2">Nouvelle image</p>
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
                                                   value="{{ old('date', $event->date->format('Y-m-d')) }}" required>
                                            @error('date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <label for="time_start" class="form-label">Heure de début</label>
                                                <input type="time" name="time_start" id="time_start" 
                                                       class="form-control @error('time_start') is-invalid @enderror" 
                                                       value="{{ old('time_start', $event->time_start ? $event->time_start->format('H:i') : '') }}">
                                                @error('time_start')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="time_end" class="form-label">Heure de fin</label>
                                                <input type="time" name="time_end" id="time_end" 
                                                       class="form-control @error('time_end') is-invalid @enderror" 
                                                       value="{{ old('time_end', $event->time_end ? $event->time_end->format('H:i') : '') }}">
                                                @error('time_end')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="location" class="form-label">Lieu</label>
                                            <input type="text" name="location" id="location" 
                                                   class="form-control @error('location') is-invalid @enderror" 
                                                   value="{{ old('location', $event->location) }}">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Catégorie</label>
                                            <input type="text" name="category" id="category" 
                                                   class="form-control @error('category') is-invalid @enderror" 
                                                   value="{{ old('category', $event->category) }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="registration_link" class="form-label">Lien d'inscription</label>
                                            <input type="url" name="registration_link" id="registration_link" 
                                                   class="form-control @error('registration_link') is-invalid @enderror" 
                                                   value="{{ old('registration_link', $event->registration_link) }}">
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
                                                       id="is_published" value="1" {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_published">
                                                    Publié
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="featured" 
                                                       id="featured" value="1" {{ old('featured', $event->featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured">
                                                    À la une
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Vues: {{ $event->views }}<br>
                                                Ajouté le: {{ $event->created_at->format('d/m/Y H:i') }}<br>
                                                Modifié le: {{ $event->updated_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Mettre à jour
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
        const container = document.getElementById(previewId + '-container');
        
        reader.onload = function() {
            imagePreview.src = reader.result;
            if (container) {
                container.style.display = 'block';
            }
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }

    // Génération automatique du slug
    document.getElementById('title').addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.value === '{{ $event->slug }}') {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-');
            slugInput.value = slug;
        }
    });
</script>
@endpush