@extends('gentelella.layouts.app')


@section('content')
<div class="x_panel modal-content">
    <div class="x_title">
       <h2>Solicitações</h2>
       <ul class="nav navbar-right panel_toolbox">
         @if (Auth::user()->nivel == 'Medico' )
          <a href="{{url('solicitacao/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Nova Sala"> Nova Solicitação </a>
         @endif
         </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_solicitacao" class="table table-hover table-striped compact">
           


            <thead>
                <tr>
                    <th>Unidade</th>
                    <th>Categoria</th>
                    <th>Data de Solicitacao</th>       
                    @if (Auth::user()->nivel == 'Medico' )
                     <th>Situação</th>            
                    @endif
                    <th></th>
                    {{-- <th>Foto</th> --}}
  
                 </tr>
           
            </thead>
            <tbody>
               @foreach ($solicitacoes as $solicitacao)
                   <tr>
                     <td>{{$solicitacao->unidade}}</td>
                     
                     <td>@foreach ($solicitacao->categorias as $categoria)
                        {{$categoria->nome}}
                        <br>
                    @endforeach
                      </td>
                   <td>
                     @if ($solicitacao->enviado == 1)
                     {{ date('d/m/y', strtotime($solicitacao->data_enviado)) }}
                     @endif
                   
                   </td>
                   @if (Auth::user()->nivel == 'Medico' )
                      <td>
                        
                        @if ($solicitacao->comentario_enviado == 1)
                           
                             <p style="color: green;">Respondido</p>
                           
                        @elseif ($solicitacao->enviado == 1)
                            
                              <p style="color: rgb(17, 17, 187);">Aguardando Resposta...</p>
                        
                        @else      
                              <p style="color: grey">Aguardando Envio...</p>
                        @endif
                        
                      </td>
                   @endif
                   
                     <td> <a
                        id="btn_show"
                        class="btn btn-primary btn-xs action botao_acao btn_vizualiza" 
                        href="{{action('SolicitacaoController@show', $solicitacao->id)}}"
                        title="Vizualizar ">  
                       <i class="glyphicon glyphicon-eye-open "></i>
                     </a>
                     
                     @if ($solicitacao->enviado == 0)
                     <a
                        id="btn_edit"
                        class="btn btn-warning btn-xs action botao_acao btn_editar" 
                        href="{{action('SolicitacaoController@edit', $solicitacao->id)}}"
                        title="Editar ">  
                        <i class="glyphicon glyphicon-pencil "></i>
                     </a>
   
                     <a
                        id="btn_send"                     
                        class="btn btn-primary btn-xs action botao_acao btn_send" 
                        href="{{route('send', $solicitacao->id)}}"
                        title="Enviar">  
                        <i class="glyphicon glyphicon-send "></i>
                     </a>
                  </td>
                   </tr>
                   @endif
                   @if (Auth::user()->nivel == 'Nasf' )
                      @if ($solicitacao->comentario_enviado == 0)
                        <a
                           id="btn_send"                     
                           class="btn btn-danger btn-xs action botao_acao btn_coment" 
                           href="{{route('solcreate', $solicitacao->id)}}"
                           title="Respoder">  
                           <i class="glyphicon glyphicon-comment "></i>
                        </a>
                        @endif
                   @endif
               @endforeach
            </tbody>
            {{-- <tbody>
               @foreach ($solicitacao as $form)
               @if (Auth::user()->id == $form->usuario_id )
               <tr>
                 <td>{{$form->unidade}}</td>
                 <td>
                  
                    @foreach ($form->categorias as $categoria)
                        {{$categoria->nome}}
                        <br>
                    @endforeach
                 </td>

                 <td> 
              

                  <a
                     id="btn_show"
                     class="btn btn-primary btn-xs action botao_acao btn_vizualiza" 
                     href="{{action('SolicitacaoController@show', $form->id)}}"
                     title="Vizualizar Funcionario">  
                    <i class="glyphicon glyphicon-eye-open "></i>
                  </a>
                  
                  <a
                     id="btn_edit"
                     class="btn btn-warning btn-xs action botao_acao btn_editar" 
                     href="{{action('SolicitacaoController@edit', $form->id)}}"
                     title="Editar Funcionario">  
                     <i class="glyphicon glyphicon-pencil "></i>
                  </a>

                  <a
                     id="btn_send"                     
                     class="btn btn-primary btn-xs action botao_acao btn_vizualiza" 
                     href="{{route('send', $form->id)}}"
                     title="Editar Funcionario">  
                     <i class="glyphicon glyphicon-send "></i>
                  </a>

                 

                 </td> 
               </tr>
               @endif
               @if (Auth::user()->nivel == 'Admin' )
               <tr>
                 <td>{{$form->unidade}}</td>
                 <td>
                  
                    @foreach ($form->categorias as $categoria)
                        {{$categoria->nome}}
                        <br>
                    @endforeach
                 </td>

                 <td> 
              

                 <a
                    id="btn_show"
                    class="btn btn-primary btn-xs action botao_acao btn_vizualiza" 
                    href="{{action('SolicitacaoController@show', $form->id)}}"
                    title="Vizualizar Funcionario">  
                    <i class="glyphicon glyphicon-eye-open "></i>
                 </a>
                 <a
                     id="btn_edit"
                     class="btn btn-warning btn-xs action botao_acao btn_editar" 
                     href="{{action('SolicitacaoController@edit', $form->id)}}"
                     title="Editar Funcionario">  
                     <i class="glyphicon glyphicon-pencil "></i>
                 </a>
                 <a
                     id="btn_send"
                     class="btn btn-primary btn-xs action botao_acao btn_vizualiza" 
                     href="{{route('send', $form->id)}}"
                     title="Editar Funcionario">  
                     <i class="glyphicon glyphicon-send "></i>
                </a>
                 

                 </td> 
               </tr>
               @endif
           @endforeach

                
            </tbody> --}}
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