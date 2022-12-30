@extends('gentelella.layouts.app')
@section('content')

<link href="{{ asset('css/tom-select.bootstrap5.min.css') }}" rel="stylesheet" />

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
                        <select onchange="getEquipe()" name="unidade" id="unidade" class="form-control">
                            <option selected value="">Selecione a unidade</option>
                                @for ($i = 0; $i < count($unidades); $i++)
                                    <option value="{{$unidades[$i]->no_unidade_saude}}">{{$unidades[$i]->no_unidade_saude}}</option>
                                @endfor

                        </select>
                            
                        {{-- <select name="unidade" id="estado" onchange="buscaCidades(this.value)" class="form-control">
                            <option selected value="">Selecione a unidade</option>
                            <option value="Clínica da Família Banco de Areia">Clínica da Família Banco de Areia</option>
                            <option value="Clinica da familia Jucelino">Clinica da familia Jucelino</option>
                        </select>    --}}
                    </div>
                    <div class=" form-group col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label" >Equipe</label>
                        <select name="equipe" id="equipe"class="form-control">
                            {{-- <option value="a">a</option> --}}
                            <option value="" selected>Selecione a unidade para carregar as opções</option>
                        </select>
                    </div>    
                    <div class=" form-group col-md-4 col-sm-4 col-xs-4">
                        <label class="control-label" >ACS</label>
                        <select name="acs" id="acs"class="form-control">
                            {{-- <option value="a">a</option> --}}
                            <option value="" selected>Selecione a equipe para carregar as opções</option>
                        </select>	
                    </div>
                    <div class=" form-group col-md-9 col-sm-9 col-xs-12">
                        <label class="control-label" >Nome do Paciente</label>
                        <input type="text" id="usuario" class="form-control" placeholder="Paciente" name="usuario" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
                        <label class="control-label" for="nascimento">Data de Nascimento</label>
                        <input required class="form-control datepicker" name="dn" id="dn" type="date" placeholder="dd/mm/aaaa" >
                    </div>
                    <div class=" form-group col-md-9 col-sm-9 col-xs-12">
                        <label class="control-label" >Endereço</label>
                        <input type="text" id="endereco" class="form-control" placeholder="Endereço" name="endereco" minlength="4" maxlength="100"
                       required >	
                    </div>
                    <div class=" form-group col-md-3 col-sm-3 col-xs-12">
                        <label class="control-label" >Telefone</label>
                        <input type="tel" id="telefone" class="form-control" placeholder="(21)xxxxx-xxxx" name="telefone" minlength="4" maxlength="14"
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
<script src="{{ asset('js/vanillaMasker.min.js')}}"></script>
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
<script>

    const unidadeSelect = document.getElementById('unidade');
    const equipeSelect = document.getElementById('equipe');
    const acsSelect = document.getElementById('acs');

    const getEquipe = async () => {

        if(unidadeSelect.value){
            unidadeSelect.setAttribute('disabled', 'disabled');
			equipeSelect.setAttribute('disabled', 'disabled');
			equipeSelect.innerHTML = "";
			const loading = document.createElement('option');
			loading.value = "";
			loading.innerText = "Carregando...";
			equipeSelect.append(loading);
            
            try {
                
                const response = await axios.get('api/equipes', {
				    params: {
						unidade: unidadeSelect.value
					}
				});

                const equipes = response.data;

                console.log(equipes)



            }catch(error) {
                console.log(error);
				unidadeSelect.removeAttribute('disabled');
				equipeSelect.removeAttribute('disabled');
            }

        }


    }

</script>
<script>
   
    VMasker($("#telefone")).maskPattern("(99)99999-9999");
    

</script>

  
@endpush