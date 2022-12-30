<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\tb_cbo;
use App\Models\tb_prof;
use App\Models\tb_equipe;
use App\Models\tb_lotacao;
use App\Models\tb_unidade_saude;

use App\Models\Categorias;
use App\Models\FormCat;
use App\Models\Form;
use Auth;

class SolicitacaoController extends Controller
{
    public function index ()
    {
        $usuariologado = Auth::user();
        // $solicitacao = Form::with('categorias')->get();
        
        if ($usuariologado->nivel == 'Medico') {
            $solicitacoes = Form::with('categorias')->where('usuario_id', '=', $usuariologado->id )->get();
        } else{
            $solicitacoes = Form::with('categorias')->where('enviado', 1)->get();
        }
        
        // dd($solicitacao)->all();
        return view('solicitacao.index', compact('solicitacoes'));
    }

    public function create()
    {
        $categorias = Categorias::all();
        
        $unidades = DB::connection('pgsql')->table('tb_unidade_saude')->select('no_unidade_saude')->where('no_unidade_saude','like','%Clinica da Familia%')->get();
        // dd($unidades[0]);
        // dd($unidades[0]->no_unidade_saude);
        return view('solicitacao.create',compact('categorias','unidades'));
    }
    
    public function store (Request $request)

    {

        $form = new Form;
        
        $form->usuario_id         = Auth::user()->id;
        $form->prof_sol         = Auth::user()->name;
        $form->unidade         = $request->unidade;
        $form->equipe          = $request->equipe;
        $form->acs             = $request->acs;
        $form->usuario         = $request->usuario;
        $form->dn              = $request->dn;
        $form->endereco        = $request->endereco;
        $form->telefone        = $request->telefone;
        $form->mv_solicitacao  = $request->mv_solicitacao;
        $form->relacao_caso    = $request->relacao_caso;
        
        
        $form->save();

        $array_bugado = $request->categoria_id;
        


        if($request->categoria_id != null){
            foreach($array_bugado as $desbuga)
            {   
                $categoria = new FormCat;

                $categoria->categorias_id = $desbuga;
                $categoria->form_id = $form->id;

                $categoria->save();
            }
        }

        return redirect('/solicitacao');
    }


    public function show($id)
    {
        $solicitacao = Form::with('categorias')->find($id);
       
        
        return view('solicitacao.show', compact('solicitacao'));
       


    }

    public function edit($id){
        
        $categorias = Categorias::all();

        $solicitacao = Form::with('categorias')->find($id);
        if ($solicitacao->enviado == 1) {
            return back()->withErrors('Nem tenta');
        } else {
             return view('solicitacao.edit', compact('solicitacao','categorias'));
        }
        
    }
    public function update(Request $request, $id){
    
        $form = Form::with('categorias')->find($id);   
       
        $form->unidade         = $request->unidade;
        $form->equipe          = $request->equipe;
        $form->acs             = $request->acs;
        $form->usuario         = $request->usuario;
        $form->dn              = $request->dn;
        $form->endereco        = $request->endereco;
        $form->telefone        = $request->telefone;
        $form->mv_solicitacao  = $request->mv_solicitacao;
        $form->relacao_caso    = $request->relacao_caso;
       
        $form->fill($request->all());
        $form->save(); 

        // $array_bugado = $request->categoria_id;
        // if($request->categoria_id != null){
        // foreach($array_bugado as $desbuga)
        // {   
        //     $categoria = FormCat::find($id);

        //     $categoria->categorias_id = $desbuga;
        //     $categoria->form_id = $form->id;

        //     $categoria->save();
        // }
        // }
       
       $arr_cat = $request->categorias_id;
       $form->categorias()->sync($arr_cat);

        return redirect()->route('solicitacao.index');

    }

    public function send($id){

        $send = Form::find($id);

        $send->enviado = '1';
        $send->data_enviado    = date('Y/m/d');

        $send->save();
        
        return redirect()->route('solicitacao.index');
    }


    public function getEquipes($unidade)
    {

        $equipes = DB::connection('pgsql')->table('tb_equipe')->select('no_equipe')->where('co_unidade_saude','=',2);
        // dd($unidade);
        // $unidades = DB::connection('pgsql')->table('tb_unidade_saude')->select('no_unidade_saude')->where('no_unidade_saude','like','%Clinica da Familia%')->get();
        
        return response()->json(
            $equipes,
            200
        );

    }

}
