@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Créer un nouveau service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Informations de base -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Informations de base</h5>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                               value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="solution_id" class="form-label">Solution associée <span class="text-danger">*</span></label>
                                                <select name="solution_id" id="solution_id" class="form-select @error('solution_id') is-invalid @enderror" required>
                                                    <option value="">Sélectionnez une solution</option>
                                                    @foreach($solutions as $solution)
                                                        <option value="{{ $solution->id }}" {{ old('solution_id') == $solution->id ? 'selected' : '' }}>
                                                            {{ $solution->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('solution_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug (URL)</label>
                                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                                       value="{{ old('slug') }}">
                                                @error('slug')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Laisser vide pour générer automatiquement</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description courte</label>
                                        <textarea name="description" id="description" rows="3" 
                                                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Maximum 500 caractères. Sera affiché dans les listes.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="full_description" class="form-label">Description complète</label>
                                        <textarea name="full_description" id="full_description" rows="6" 
                                                  class="form-control @error('full_description') is-invalid @enderror">{{ old('full_description') }}</textarea>
                                        @error('full_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Sera affiché dans la page détaillée du service.</small>
                                    </div>
                                </div>

                                <!-- Fonctionnalités -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Fonctionnalités/Avantages</h5>
                                    <div id="features-container">
                                        <!-- Features will be added here dynamically -->
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addFeature()">
                                        <i class="fa fa-plus"></i> Ajouter une fonctionnalité
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- Images et fichiers -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Médias</h5>
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
                                        <small class="text-muted">Recommandé: 800x600 pixels, format WebP, JPEG ou PNG</small>
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
                                        <small class="text-muted">Recommandé: 64x64 pixels, format SVG ou PNG</small>
                                    </div>
                                </div>

                                <!-- Documents -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Documents</h5>
                                    <div class="mb-3">
                                        <label for="brochure" class="form-label">Brochure</label>
                                        <input type="file" name="brochure" id="brochure" 
                                               class="form-control @error('brochure') is-invalid @enderror" 
                                               accept=".pdf,.doc,.docx">
                                        @error('brochure')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="leaflet" class="form-label">Dépliant</label>
                                        <input type="file" name="leaflet" id="leaflet" 
                                               class="form-control @error('leaflet') is-invalid @enderror" 
                                               accept=".pdf,.doc,.docx">
                                        @error('leaflet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Paramètres -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Paramètres</h5>
                                    <div class="mb-3">
                                        <label for="order" class="form-label">Ordre d'affichage</label>
                                        <input type="number" name="order" id="order" 
                                               class="form-control @error('order') is-invalid @enderror" 
                                               value="{{ old('order', 0) }}" min="0">
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Détermine l'ordre dans les listes</small>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" 
                                                   id="is_active" value="1" checked>
                                            <label class="form-check-label" for="is_active">
                                                Service actif
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
                                            <small class="text-muted d-block">Le service sera mis en évidence</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">Créer le service</button>
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
    let featureCount = 0;

    function addFeature(feature = null) {
        featureCount++;
        const container = document.getElementById('features-container');
        const featureId = 'feature-' + featureCount;
        
        const featureHtml = `
            <div class="card mb-3 feature-item" id="${featureId}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="mb-0">Fonctionnalité #${featureCount}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFeature('${featureId}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Titre <span class="text-danger">*</span></label>
                                <input type="text" name="features[${featureCount}][title]" 
                                       class="form-control" 
                                       value="${feature ? feature.title : ''}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Icône (code FontAwesome)</label>
                                <input type="text" name="features[${featureCount}][icon]" 
                                       class="form-control" 
                                       value="${feature ? feature.icon : ''}"
                                       placeholder="Ex: fas fa-check">
                                <small class="text-muted">Utilisez le code d'icône FontAwesome</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="features[${featureCount}][description]" 
                                  class="form-control" 
                                  rows="2">${feature ? feature.description : ''}</textarea>
                    </div>
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', featureHtml);
    }

    function removeFeature(id) {
        const element = document.getElementById(id);
        if (element) {
            element.remove();
            // Reorder remaining features
            const features = document.querySelectorAll('.feature-item');
            features.forEach((feature, index) => {
                const title = feature.querySelector('h6');
                if (title) {
                    title.textContent = `Fonctionnalité #${index + 1}`;
                }
            });
            featureCount = features.length;
        }
    }

    function previewImage(event, previewId) {
        const reader = new FileReader();
        const imagePreview = document.getElementById(previewId);
        
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }

    // Generate slug from title
    document.getElementById('title').addEventListener('blur', function() {
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

    // Add initial feature field
    document.addEventListener('DOMContentLoaded', function() {
        addFeature();
    });
</script>

@push('styles')
<style>
    .feature-item {
        border-left: 4px solid #3b82f6;
    }
    
    .feature-item .card-body {
        padding: 1rem;
    }
</style>
@endpush