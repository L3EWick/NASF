@extends('gentelella.layouts.app')
@section('content')

<link href="{{ asset('css/tom-select.bootstrap5.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/filepreview.css') }}">

<div class="x_panel modal-content">
    <div class="x_title">
       <h2>Nova Solicitação</h2>
       <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
        <form action="{{url('/solicitacao')}}"  method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="form-group row">
                    
                    <div class=" form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label" >Categoria:</label>
                        <select name="categoria_id[]" id="categoria_id" multiple class="form-control">
                            <option value="">Adicionar Categoria</option>  
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                                
                        </select>
                    </div>
                   
                    <div class=" form-group col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label" >Unidade</label>
                        <input type="text" id="unidade" class="form-control" placeholder="Unidade" name="unidade" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class=" form-group col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label" >Equipe</label>
                        <input type="text" id="equipe" class="form-control" placeholder="Equipe" name="equipe" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class=" form-group col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label" >ACS</label>
                        <input type="text" id="acs" class="form-control" placeholder="ACS" name="acs" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class=" form-group col-md-9 col-sm-9 col-xs-12">
                        <label class="control-label" >Usuário</label>
                        <input type="text" id="usuario" class="form-control" placeholder="Usuário" name="usuario" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
                        <label class="control-label" for="nascimento">D.N</label>
                        <input required class="form-control datepicker" name="dn" id="dn" type="date" placeholder="dd/mm/aaaa" >
                    </div>
                    <div class=" form-group col-md-9 col-sm-9 col-xs-12">
                        <label class="control-label" >Endereço</label>
                        <input type="text" id="endereco" class="form-control" placeholder="Endereço" name="endereco" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class=" form-group col-md-3 col-sm-3 col-xs-12">
                        <label class="control-label" >Telefone</label>
                        <input type="text" id="telefone" class="form-control" placeholder="Tel" name="telefone" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class=" form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label" >Motivo da Solicitação</label>
                        <input type="text" id="mv_solicitacao" class="form-control" placeholder="Hipótese Diagnóstica" name="mv_solicitacao" minlength="4" maxlength="100"
                        >	
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="form-label fw-normal" for="nomeCompleto">Breve relato do caso:</label>   
                            <textarea class="form-control" id="relato" rows="3"  name="relacao_caso"></textarea>
                    </div>
                 

            
            <br>
            <div class="card-footer text-center">
                <button type="submit" id="btn_salvar" class="btn btn-primary">Salvar</button>
            </div>
         </form>
   </div>
</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
<script type="text/javascript">
    new TomSelect('#categoria_id',{
        maxOptions: 150,
        sortField: {
            field: 'text',
            direction: 'asc'
        }
    });



</script>

  
@endpush