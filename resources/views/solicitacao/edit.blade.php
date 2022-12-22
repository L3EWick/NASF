@extends('gentelella.layouts.app')
@section('content')


<div class="x_panel modal-content">
	<div class="x-title">
		<h2>Solicitação</h2>
	</div>


    
   
    <form action="{{action('SolicitacaoController@update', $solicitacao->id)}}"  method="POST" >
        {{ csrf_field() }}
        @method('PATCH')     
        <div class="row">
            <div class=" form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" >Categorias:</label>
                <select name="categorias_id[]" id="categorias_id"  multiple class="form-control">
                    @foreach ($solicitacao->categorias as $categoria)
                        <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option> 
                    @endforeach
                   
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}" >{{$categoria->nome}}</option> 
                    @endforeach

                </select>
            </div>
        </div>   
        
        <div class=" form-group col-md-4 col-sm-4 col-xs-4">
            <label class="control-label" >Unidade</label>
            <select name="unidade" id="estado" onchange="buscaCidades(this.value)" class="form-control">
                <option selected value="{{$solicitacao->unidade}}">{{$solicitacao->unidade}}</option>
                <option value="Clínica da Família Banco de Areia">Clínica da Família Banco de Areia</option>
                <option value="Clinica da familia Jucelino">Clinica da familia Jucelino</option>
            </select>   
        </div>
        <div class=" form-group col-md-4 col-sm-4 col-xs-4">
            <label class="control-label" >Equipe</label>
            <select name="equipe" id="cidade"class="form-control">
                <option selected value="{{$solicitacao->equipe}}">{{$solicitacao->equipe}}</option>
            </select>
        </div>    
            <div class=" form-group col-md-4 col-sm-4 col-xs-4">
                <label class="control-label" >ACS:</label>
                <input type="text" id="acs" class="form-control"  value="{{$solicitacao->acs}}" name="acs" minlength="4" maxlength="100"
            required >	
            </div>
            <div class=" form-group col-md-9 col-sm-9 col-xs-12">
                <label class="control-label" >Usuário:</label>
                <input type="text" id="usuario" class="form-control"  value="{{$solicitacao->usuario}}" name="usuario" minlength="4" maxlength="100"
            required >	
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
                <label class="control-label" for="nascimento">D.N:</label>
                <input required class="form-control datepicker" name="dn" id="dn"  type="date" value="{{$solicitacao->dn}}">
            </div>
            <div class=" form-group col-md-9 col-sm-9 col-xs-12">
                <label class="control-label" >Endereço:</label>
                <input type="text" id="endereco" class="form-control"  value="{{$solicitacao->endereco}}" name="endereco" minlength="4" maxlength="100"
            required >	
            </div>
            <div class=" form-group col-md-3 col-sm-3 col-xs-12">
                <label class="control-label" >Telefone:</label>
                <input type="text" id="telefone" class="form-control"  value="{{$solicitacao->telefone}}" name="telefone" minlength="4" maxlength="100"
            required >	
            </div>
            <div class=" form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" >Motivo da Solicitação:</label>
                <input type="text" id="mv_solicitacao" class="form-control"  value="{{$solicitacao->mv_solicitacao}}" name="mv_solicitacao" minlength="4" maxlength="100"
                >	
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="form-label fw-normal" for="nomeCompleto">Breve relato do caso:</label>   
                    <textarea class="form-control" id="relato" rows="3"   name="relacao_caso">{{$solicitacao->relacao_caso}}</textarea>
            </div>
        

            <div class="clearfix"></div>
            <div class="ln_solid"> </div>
                <br>
                <div class="card-footer text-center">
                    <button type="update" id="btn_salvar" class="btn btn-primary" >Salvar</button>
                </div>
    </form>
	
	
</div>	

@endsection

@push('scripts')
<script src="{{ asset('js/vanillaMasker.min.js')}}"></script>
<script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
<script type="text/javascript">
	new TomSelect('#categorias_id',{
		maxOptions: 150,
		sortField: {
			field: 'text',
			direction: 'asc'
		}
	});

	
</script>
<script>
   
    VMasker($("#telefone")).maskPattern("(99)99999-9999");
    

</script>
<script>
    // ESTE SERIA O CONTEÚDO DO .js
    var json_cidades = {
      "estados": [
        {
          "sigla": "Clínica da Família Banco de Areia",
          "nome": "Clínica da Família Banco de Areia",
          "cidades": [
            "Selecione Uma Equipe",
            "aiai",
            "testandosapor"
    
        ]
        },
        {
          "sigla": "Clinica da familia Jucelino",
          "nome": "Clinica da familia Jucelino",
          "cidades": [
            "Selecione Uma Equipe",
            "aiai",
            "aiai",
            "testandosapor"
    
          ]
        }
      ]
    };
    // FIM DO .js
    
    function buscaCidades(e){
       document.querySelector("#cidade").innerHTML = '';
       var cidade_select = document.querySelector("#cidade");
    
       var num_estados = json_cidades.estados.length;
       var j_index = -1;
    
       // aqui eu pego o index do Estado dentro do JSON
       for(var x=0;x<num_estados;x++){
          if(json_cidades.estados[x].sigla == e){
             j_index = x;
          }
       }
    
       if(j_index != -1){
      
          // aqui eu percorro todas as cidades e crio os OPTIONS
          json_cidades.estados[j_index].cidades.forEach(function(cidade){
             var cid_opts = document.createElement('option');
             cid_opts.setAttribute('value',cidade)
             cid_opts.innerHTML = cidade;
             cidade_select.appendChild(cid_opts);
          });
       }else{
          document.querySelector("#cidade").innerHTML = '';
       }
    }
    </script>
@endpush