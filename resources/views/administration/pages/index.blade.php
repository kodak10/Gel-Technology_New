@extends('administration.layouts.master')

@section('content')
     <!-- Start Container Fluid -->
     <div class="container-fluid">
   </div>
   <!-- End Container Fluid -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialisation de DataTable
        $('.table').DataTable({
            responsive: true,  // Rendre la table responsive
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json' // Traduction en français
            }
        });
    });
</script>

@endpush