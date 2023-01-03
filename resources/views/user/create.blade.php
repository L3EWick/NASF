@extends('gentelella.layouts.app')

@section('content')

<div class="x_panel modal-content ">

	<div class="x_title">
	   <h2>Novo Funcionário </h2>
	   <div class="clearfix"></div>
	</div>

	<div class="x_panel ">
	   <div class="x_content">
	   		<form id="formulario_user" class="form-horizontal form-label-left" method="post" action="{{ route('user.store') }}">
				{{ csrf_field()}}
				<div id="desabilita">
					<div class="form-group row">
						<div class=" form-group col-md-6 col-sm-6 col-xs-12">
							<label class="control-label" >Nome</label>
							<input type="text" id="name" class="form-control " name="name" minlength="4" maxlength="100" required >	
						</div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label">Permissão do novo Usuario</label>
                                <select id="nivel" class="form-control" name="nivel" required>
                                    <option value="">Selecione...</option>                                 
                                    <option value="Admin">Administrador</option>
                                    <option value="Medico">Médico</option>
									<option value="Nasf">NASF</option>
                                </select>
                        </div>
					</div>
					<div class="form-group row">
						


						<div class="form-group col-md-6 col-sm-6 col-xs-12 ">
							<label class="control-label" for="email">Email</label>
							<input type="email" id="email" class="form-control" name="email" required>	
						</div>

					</div>
				</div>
      		 
   	   
				{{-- BOTÕES --}}
				<div class="clearfix"></div>
				<div class="ln_solid"> </div>
					<div class="footer text-right"> {{-- col-md-3 col-md-offset-9 --}}
						<button id="btn_voltar" class="botoes-acao btn btn-round btn-primary" >
							<span class="icone-botoes-acao mdi mdi-backburger"></span>   
							<span class="texto-botoes-acao"> CANCELAR </span>
							<div class="ripple-container"></div>
						</button>
				
						<button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
							<span class="icone-botoes-acao mdi mdi-send"></span>
							<span class="texto-botoes-acao"> SALVAR </span>
							<div class="ripple-container"></div>
						</button>
					</div>
			</form>
	   </div>
	</div>
@endsection

@push('scripts')
    {{-- Vanilla Masker --}}
    <script src="{{ asset('js/vanillaMasker.min.js')}}"></script>

    <script>
        VMasker ($("#cpf")).maskPattern("999.999.999-99");
		VMasker ($("#cep")).maskPattern("99999-999");
        VMasker ($("#telefone")).maskPattern("(99)99999-9999"); 
		// VMasker ($("#nascimento")).maskPattern("99/99/9999"); 
		// VMasker ($("#admissao")).maskPattern("99/99/9999");
        $(document).ready(function(){
            //botão de voltar
			$("#btn_voltar").click(function(){
				event.preventDefault();
				window.location.href = "{{ URL::route('user.index') }}"; 
			});
        });
    </script>
@endpush