@extends('administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Modifier la catégorie</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('administration.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug (URL)</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                           value="{{ old('slug', $category->slug) }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" rows="4" 
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Icône actuelle</label>
                                    @if($category->icon)
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" 
                                                 style="max-height: 100px;">
                                        </div>
                                    @endif
                                    
                                    <label for="icon" class="form-label">Changer l'icône</label>
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
                                </div>

                                <div class="mb-3">
                                    <label for="color" class="form-label">Couleur associée</label>
                                    <input type="color" name="color" id="color" 
                                           class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           value="{{ old('color', $category->color ?: '#3b82f6') }}">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="order" class="form-label">Ordre d'affichage</label>
                                    <input type="number" name="order" id="order" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           value="{{ old('order', $category->order) }}" min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" 
                                               id="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Catégorie active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
</script>
@endpush