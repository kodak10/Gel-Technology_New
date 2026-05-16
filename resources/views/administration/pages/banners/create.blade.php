@extends('administration.layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Créer une nouvelle bannière</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('administration.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre principal</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                           value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sub_title" class="form-label">Sous-titre</label>
                                    <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" 
                                           value="{{ old('sub_title') }}">
                                    @error('sub_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" rows="4" 
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button_text" class="form-label">Texte du bouton</label>
                                            <input type="text" name="button_text" id="button_text" 
                                                   class="form-control @error('button_text') is-invalid @enderror" 
                                                   value="{{ old('button_text', 'Our Services') }}">
                                            @error('button_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="button_link" class="form-label">Lien du bouton</label>
                                            <input type="text" name="button_link" id="button_link" 
                                                   class="form-control @error('button_link') is-invalid @enderror" 
                                                   value="{{ old('button_link', 'services') }}">
                                            @error('button_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="background_image" class="form-label">Image de fond</label>
                                    <input type="file" name="background_image" id="background_image" 
                                           class="form-control @error('background_image') is-invalid @enderror" 
                                           accept="image/*" onchange="previewImage(event)">
                                    @error('background_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="image-preview" src="#" alt="Prévisualisation" 
                                             class="img-fluid rounded" style="display: none; max-height: 200px;">
                                    </div>
                                    <small class="text-muted">Formats acceptés : jpeg, png, jpg, webp. Max 2MB</small>
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
                                               id="is_active" value="1" {{ old('is_active') ? 'checked' : 'checked' }}>
                                        <label class="form-check-label" for="is_active">
                                            Bannière active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Créer la bannière</button>
                            <a href="{{ route('administration.banners.index') }}" class="btn btn-secondary">Annuler</a>
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
        const imagePreview = document.getElementById('image-preview');
        
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