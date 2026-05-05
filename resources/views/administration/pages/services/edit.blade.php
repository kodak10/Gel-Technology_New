@extends('Administration.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Modifier le service : {{ $service->title }}</h4>
                    <div>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                    <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Colonne gauche - Informations principales -->
                            <div class="col-lg-8">
                                <!-- Informations de base -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Informations de base</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Titre du service <span class="text-danger">*</span></label>
                                                    <input type="text" name="title" id="title" 
                                                           class="form-control @error('title') is-invalid @enderror" 
                                                           value="{{ old('title', $service->title) }}" required>
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="solution_id" class="form-label">Solution associée <span class="text-danger">*</span></label>
                                                    <select name="solution_id" id="solution_id" 
                                                            class="form-select @error('solution_id') is-invalid @enderror" required>
                                                        <option value="">Sélectionnez une solution</option>
                                                        @foreach($solutions as $solutionItem)
                                                            <option value="{{ $solutionItem->id }}" 
                                                                {{ old('solution_id', $service->solution_id) == $solutionItem->id ? 'selected' : '' }}>
                                                                {{ $solutionItem->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('solution_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="slug" class="form-label">Slug (URL)</label>
                                                    <input type="text" name="slug" id="slug" 
                                                           class="form-control @error('slug') is-invalid @enderror" 
                                                           value="{{ old('slug', $service->slug) }}">
                                                    @error('slug')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">Laisser vide pour générer automatiquement</small>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="order" class="form-label">Ordre d'affichage</label>
                                                    <input type="number" name="order" id="order" 
                                                           class="form-control @error('order') is-invalid @enderror" 
                                                           value="{{ old('order', $service->order) }}" min="0">
                                                    @error('order')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <small class="text-muted">Détermine l'ordre dans les listes</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description courte</label>
                                            <textarea name="description" id="description" rows="3" 
                                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Maximum 500 caractères. Sera affiché dans les listes.</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="full_description" class="form-label">Description complète</label>
                                            <textarea name="full_description" id="full_description" rows="6" 
                                                      class="form-control @error('full_description') is-invalid @enderror">{{ old('full_description', $service->full_description) }}</textarea>
                                            @error('full_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Sera affiché dans la page détaillée du service.</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fonctionnalités/Avantages -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Fonctionnalités/Avantages</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="features-container">
                                            @php
                                                $features = $service->features_list ?: [];
                                            @endphp
                                            
                                            @if(count($features) > 0)
                                                @foreach($features as $index => $feature)
                                                    <div class="card mb-3 feature-item" id="feature-{{ $index }}">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                                <h6 class="mb-0">Fonctionnalité #{{ $index + 1 }}</h6>
                                                                <button type="button" class="btn btn-sm btn-outline-danger remove-feature" data-index="{{ $index }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Titre <span class="text-danger">*</span></label>
                                                                        <input type="text" name="features[{{ $index }}][title]" 
                                                                               class="form-control feature-title" 
                                                                               value="{{ $feature['title'] }}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Icône (code FontAwesome)</label>
                                                                        <input type="text" name="features[{{ $index }}][icon]" 
                                                                               class="form-control" 
                                                                               value="{{ $feature['icon'] ?? '' }}"
                                                                               placeholder="Ex: fas fa-check">
                                                                        <small class="text-muted">Laissez vide pour utiliser l'icône par défaut</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label class="form-label">Description</label>
                                                                <textarea name="features[{{ $index }}][description]" 
                                                                          class="form-control" 
                                                                          rows="2">{{ $feature['description'] ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="alert alert-info">
                                                    Aucune fonctionnalité définie. Ajoutez-en une ci-dessous.
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <button type="button" class="btn btn-outline-primary mt-2" id="add-feature">
                                            <i class="fas fa-plus me-1"></i> Ajouter une fonctionnalité
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Colonne droite - Médias et paramètres -->
                            <div class="col-lg-4">
                                <!-- Image principale -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Image principale</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 text-center">
                                            @if($service->image_path)
                                                <img src="{{ $service->image_url }}" alt="{{ $service->title }}" 
                                                     id="current-image-preview" 
                                                     class="img-fluid rounded mb-3" style="max-height: 200px;">
                                            @else
                                                <div class="alert alert-info">
                                                    Aucune image définie
                                                </div>
                                            @endif
                                            
                                            <label for="image" class="form-label">Changer l'image</label>
                                            <input type="file" name="image" id="image" 
                                                   class="form-control @error('image') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'new-image-preview')">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                            <div class="mt-2" id="new-image-preview-container" style="display: none;">
                                                <img id="new-image-preview" src="#" alt="Nouvelle image" 
                                                     class="img-fluid rounded" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Icône -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Icône</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 text-center">
                                            @if($service->icon)
                                                <img src="{{ $service->icon_url }}" alt="Icône {{ $service->title }}" 
                                                     id="current-icon-preview" 
                                                     class="img-fluid rounded mb-3" style="max-height: 100px;">
                                            @endif
                                            
                                            <label for="icon" class="form-label">Changer l'icône</label>
                                            <input type="file" name="icon" id="icon" 
                                                   class="form-control @error('icon') is-invalid @enderror" 
                                                   accept="image/*" onchange="previewImage(event, 'new-icon-preview')">
                                            @error('icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                            <div class="mt-2" id="new-icon-preview-container" style="display: none;">
                                                <img id="new-icon-preview" src="#" alt="Nouvelle icône" 
                                                     class="img-fluid rounded" style="max-height: 100px;">
                                            </div>
                                            <small class="text-muted d-block mt-2">Recommandé: 64x64 pixels, format SVG ou PNG</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Documents -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Documents</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Brochure -->
                                        <div class="mb-3">
                                            <label class="form-label">Brochure actuelle</label>
                                            @if($service->brochure_path)
                                                <div class="d-flex align-items-center gap-2 mb-2 p-2 bg-light rounded">
                                                    <i class="fas fa-file-pdf text-danger"></i>
                                                    <span class="flex-grow-1">{{ basename($service->brochure_path) }}</span>
                                                    <a href="{{ $service->brochure_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="alert alert-info p-2">
                                                    Aucune brochure définie
                                                </div>
                                            @endif
                                            
                                            <label for="brochure" class="form-label">Changer la brochure</label>
                                            <input type="file" name="brochure" id="brochure" 
                                                   class="form-control @error('brochure') is-invalid @enderror" 
                                                   accept=".pdf,.doc,.docx">
                                            @error('brochure')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Dépliant -->
                                        <div class="mb-3">
                                            <label class="form-label">Dépliant actuel</label>
                                            @if($service->leaflet_path)
                                                <div class="d-flex align-items-center gap-2 mb-2 p-2 bg-light rounded">
                                                    <i class="fas fa-file-alt text-primary"></i>
                                                    <span class="flex-grow-1">{{ basename($service->leaflet_path) }}</span>
                                                    <a href="{{ $service->leaflet_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="alert alert-info p-2">
                                                    Aucun dépliant défini
                                                </div>
                                            @endif
                                            
                                            <label for="leaflet" class="form-label">Changer le dépliant</label>
                                            <input type="file" name="leaflet" id="leaflet" 
                                                   class="form-control @error('leaflet') is-invalid @enderror" 
                                                   accept=".pdf,.doc,.docx">
                                            @error('leaflet')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Paramètres -->
                                <div class="card mb-4">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Paramètres</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active" 
                                                       id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    Service actif
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="featured" 
                                                       id="featured" value="1" {{ old('featured', $service->featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured">
                                                    Mettre en avant
                                                </label>
                                                <small class="text-muted d-block">Le service sera mis en évidence</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informations du service -->
                                <div class="card">
                                    <div class="card-header bg-light-subtle">
                                        <h5 class="card-title mb-0">Informations</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2">
                                                <strong>Créé le :</strong> 
                                                <span class="text-muted">{{ $service->created_at->format('d/m/Y H:i') }}</span>
                                            </li>
                                            <li class="mb-2">
                                                <strong>Modifié le :</strong> 
                                                <span class="text-muted">{{ $service->updated_at->format('d/m/Y H:i') }}</span>
                                            </li>
                                            <li>
                                                <strong>Nombre de fonctionnalités :</strong> 
                                                <span class="badge bg-primary">{{ count($features) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('services.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-1"></i> Annuler
                                        </a>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Mettre à jour
                                        </button>
                                        <a href="{{ route('services.create') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-plus me-1"></i> Créer un nouveau
                                        </a>
                                    </div>
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
    let featureIndex = {{ count($features) }};
    
    // Gestion des fonctionnalités
    document.addEventListener('DOMContentLoaded', function() {
        // Ajouter une fonctionnalité
        document.getElementById('add-feature').addEventListener('click', function() {
            const container = document.getElementById('features-container');
            
            // Supprimer le message d'alerte si présent
            const alertElement = container.querySelector('.alert-info');
            if (alertElement) {
                alertElement.remove();
            }
            
            const featureHtml = `
                <div class="card mb-3 feature-item" id="feature-${featureIndex}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="mb-0">Fonctionnalité #${featureIndex + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-feature" data-index="${featureIndex}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" name="features[${featureIndex}][title]" 
                                           class="form-control feature-title" 
                                           value=""
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Icône (code FontAwesome)</label>
                                    <input type="text" name="features[${featureIndex}][icon]" 
                                           class="form-control" 
                                           value=""
                                           placeholder="Ex: fas fa-check">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="features[${featureIndex}][description]" 
                                      class="form-control" 
                                      rows="2"></textarea>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', featureHtml);
            featureIndex++;
        });

        // Supprimer une fonctionnalité
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-feature')) {
                const button = e.target.closest('.remove-feature');
                const index = button.getAttribute('data-index');
                const featureElement = document.getElementById(`feature-${index}`);
                
                if (featureElement) {
                    featureElement.remove();
                    reorderFeatures();
                }
            }
        });

        // Prévisualisation d'image
        function previewImage(event, previewId) {
            const reader = new FileReader();
            const imagePreview = document.getElementById(previewId);
            const container = document.getElementById(`${previewId}-container`);
            
            reader.onload = function() {
                imagePreview.src = reader.result;
                if (container) {
                    container.style.display = 'block';
                }
            }
            
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Attacher l'événement aux champs d'image
        document.getElementById('image').addEventListener('change', function(e) {
            previewImage(e, 'new-image-preview');
        });

        document.getElementById('icon').addEventListener('change', function(e) {
            previewImage(e, 'new-icon-preview');
        });

        // Réorganiser les fonctionnalités après suppression
        function reorderFeatures() {
            const featureItems = document.querySelectorAll('.feature-item');
            if (featureItems.length === 0) {
                const container = document.getElementById('features-container');
                container.innerHTML = `
                    <div class="alert alert-info">
                        Aucune fonctionnalité définie. Ajoutez-en une ci-dessous.
                    </div>
                `;
                featureIndex = 0;
                return;
            }
            
            featureItems.forEach((item, index) => {
                // Mettre à jour l'ID
                item.id = `feature-${index}`;
                
                // Mettre à jour le titre
                const titleElement = item.querySelector('h6');
                if (titleElement) {
                    titleElement.textContent = `Fonctionnalité #${index + 1}`;
                }
                
                // Mettre à jour le bouton de suppression
                const removeButton = item.querySelector('.remove-feature');
                if (removeButton) {
                    removeButton.setAttribute('data-index', index);
                }
                
                // Mettre à jour les noms des inputs
                const inputs = item.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const oldName = input.getAttribute('name');
                    if (oldName) {
                        const newName = oldName.replace(/features\[\d+\]/, `features[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
            
            featureIndex = featureItems.length;
        }

        // Générer automatiquement le slug
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

        // Validation des fonctionnalités avant soumission
        document.querySelector('form').addEventListener('submit', function(e) {
            const featureTitles = document.querySelectorAll('.feature-title');
            let hasEmptyTitle = false;
            
            featureTitles.forEach(titleInput => {
                if (!titleInput.value.trim()) {
                    hasEmptyTitle = true;
                    titleInput.classList.add('is-invalid');
                } else {
                    titleInput.classList.remove('is-invalid');
                }
            });
            
            if (hasEmptyTitle) {
                e.preventDefault();
                alert('Veuillez remplir tous les titres des fonctionnalités.');
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    .feature-item {
        border-left: 4px solid #3b82f6;
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    
    .feature-item .card-body {
        padding: 1rem;
    }
    
    .form-check-input:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    
    .form-check-label {
        font-weight: 500;
    }
    
    /* Styles pour les aperçus d'images */
    #new-image-preview-container,
    #new-icon-preview-container {
        margin-top: 10px;
    }
    
    #current-image-preview,
    #current-icon-preview,
    #new-image-preview,
    #new-icon-preview {
        max-width: 100%;
        height: auto;
    }
</style>
@endpush