@extends('Administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Créer une nouvelle catégorie</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('administration.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
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

                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icône</label>
                                    <input type="file" name="icon" id="icon" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           accept="image/*" onchange="previewImage(event)">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="icon-preview" src="#" alt="Prévisualisation" 
                                             class="img-fluid rounded" style="display: none; max-height: 100px;">
                                    </div>
                                    <small class="text-muted">Format: PNG, JPG, SVG. Taille max: 2MB</small>
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
                                            Catégorie active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Créer la catégorie</button>
                            <a href="{{ route('administration.categories.index') }}" class="btn btn-secondary">Annuler</a>
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
    function previewImage(event) {
        const reader = new FileReader();
        const imagePreview = document.getElementById('icon-preview');
        
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Générer automatiquement le slug à partir du nom
    document.getElementById('name').addEventListener('blur', function() {
        if (!document.getElementById('slug').value) {
            const name = this.value;
            const slug = name.toLowerCase()
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