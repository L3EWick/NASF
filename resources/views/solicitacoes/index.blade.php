@extends('gentelella.layouts.app')


@section('content')
<div class="x_panel modal-content">
    <div class="x_title">
       <h2>Solicitações</h2>
       {{-- <ul class="nav navbar-right panel_toolbox">
          <a href="{{url('solicitacao/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Nova Solicitação </a>
      </ul> --}}
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_solicitacao" class="table table-hover table-striped compact">
           


            <thead>
                <tr>
                    <th>Unidade</th>
                    <th></th>
                    <th>Categoria</th>
                    <th></th>
                    {{-- <th>Foto</th> --}}
  
                 </tr>
           
            </thead>
            <tbody>
              
                
            </tbody>
        </table>
      
       </div>
    </div>
 </div>



@endsection








@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    var tb_solicitacao = $("#tb_solicitacao").DataTable({
       language: {
             'url' : '{{ asset('js/portugues.json') }}',
       "decimal": ",",
       "thousands": "."
       },
       stateSave: true,
       stateDuration: -1,
       responsive: true,
    })
 });

</script>

@endpush