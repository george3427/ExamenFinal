@extends('layouts.app')


@section('style')
 <link href="{{asset('js/vue-table.css')}}  " rel="stylesheet" >
@endsection

@section('content')
<div id="app">

    <div class="container">
        
        <h1 class="mt-4">Articulos Publicados</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ url("/post/nuevo") }}" class="btn btn-primary me-md-2" type="button"><i class="fas fa-user fa-plus"></i> Nueva Publicación</a>
        </div>

        <!-- Vue componente table -->
		<div class="table-responsive" style="background-color: white; padding: 7px 7px 7px 7px; border-radius: 10px;">
		    <vuetable v-ref:vuetable
		    :api-url="apiFiltroUrl"
		    pagination-path=""
		    :fields="fields"
		    :sort-order="sortOrder"
		    :multi-sort="multiSort"
		    table-class="table table-bordered table-striped table-hover"
		    ascending-icon="glyphicon glyphicon-chevron-up"
		    descending-icon="glyphicon glyphicon-chevron-down"
		    pagination-class=""
		    pagination-info-class=""
		    pagination-component-class=""
		    pagination-info-no-data-template="No se han encontrado publicaciones"
		    :pagination-component="paginationComponent"
		    :item-actions="itemActions"
		    vuetable:action="delete-item"
		    :append-params="moreParams"
		    :per-page="perPage"
		    wrapper-class="vuetable-wrapper"
		    table-wrapper=".vuetable-wrapper"
		    loading-class="loading"
		    detail-row-component="my-detail-row"
		    detail-row-id="id"
		    detail-row-transition="expand"
		    row-class-callback="rowClassCB"
		    >
		    </vuetable>
		</div>
    </div>

</div>



@endsection

@section('scripts')

<script src="{{asset('js/vue.js')}}"></script>
<script src="{{asset('js/vue-table.js')}}"></script>
<script src="{{asset('js/vue-resource.min.js')}}"></script>
<script src="{{asset('js/vue-table-wiki.js')}}"></script>

<script >
vm.user_id = "{{ Auth::user()->id }}";
vm.user_role = "{{ Auth::user()->role->rol_tipo }}"; 
</script>

@endsection