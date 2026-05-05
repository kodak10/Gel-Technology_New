@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Créer une nouvelle solution</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('administration.solutions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="categorie_solution_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
                                    <select name="categorie_solution_id" id="categorie_solution_id" 
                                            class="form-control @error('categorie_solution_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('categorie_solution_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categorie_solution_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                           value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug (URL)</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                           value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Laisser vide pour générer automatiquement</small>
                                </div>

                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Description courte</label>
                                    <textarea name="short_description" id="short_description" rows="3" 
                                              class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Maximum 500 caractères</small>
                                </div>

                                <div class="mb-3">
                                    <label for="full_description" class="form-label">Description complète</label>
                                    <textarea name="full_description" id="full_description" rows="6" 
                                              class="form-control @error('full_description') is-invalid @enderror">{{ old('full_description') }}</textarea>
                                    @error('full_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Lien personnalisé</label>
                                            <input type="text" name="link" id="link" 
                                                   class="form-control @error('link') is-invalid @enderror" 
                                                   value="{{ old('link') }}" placeholder="/solutions/ma-solution">
                                            @error('link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button_text" class="form-label">Texte du bouton</label>
                                            <input type="text" name="button_text" id="button_text" 
                                                   class="form-control @error('button_text') is-invalid @enderror" 
                                                   value="{{ old('button_text', 'Découvrir') }}">
                                            @error('button_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image principale</label>
                                    <input type="file" name="image" id="image" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           accept="image/*" onchange="previewImage(event, 'image-preview')">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="image-preview" src="#" alt="Prévisualisation" 
                                             class="img-fluid rounded" style="display: none; max-height: 200px;">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icône</label>
                                    <input type="file" name="icon" id="icon" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           accept="image/*" onchange="previewImage(event, 'icon-preview')">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="icon-preview" src="#" alt="Prévisualisation icône" 
                                             class="img-fluid rounded" style="display: none; max-height: 100px;">
                                    </div>
                                    <small class="text-muted">Recommandé: 64x64 pixels, format PNG ou SVG</small>
                                </div>

                                <div class="mb-3">
                                    <label for="color" class="form-label">Couleur associée</label>
                                    <input type="color" name="color" id="color" 
                                           class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           value="{{ old('color', '#3b82f6') }}">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
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

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" 
                                               id="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">
                                            Solution active
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="featured" 
                                               id="featured" value="1">
                                        <label class="form-check-label" for="featured">
                                            Mettre en avant
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Créer la solution</button>
                            <a href="{{ route('administration.solutions.index') }}" class="btn btn-secondary">Annuler</a>
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
        
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Générer automatiquement le slug à partir du titre
    document.getElementById('title')?.addEventListener('blur', function() {
        if (!document.getElementById('slug').value) {
            const title = this.value;
            const slug = title.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('slug').value = slug;
        }
    });
</script>
@endpush