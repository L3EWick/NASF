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
use Exception;
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
        
        $unidades = DB::connection('pgsql')->table('tb_unidade_saude')->select('no_unidade_saude','co_seq_unidade_saude')->where('no_unidade_saude','like','%Clinica da Familia%')->get();
        // dd($unidades[0]->no_unidade_saude);
        return view('solicitacao.create',compact('categorias','unidades'));
    }
    
    public function store (Request $request)
    {


    try{
    
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
   
    }catch (Exception $e){
        return $e->withErrors('Tente novamente!');
       
       exit;
    } 
    DB::commit();
       

        return redirect('/solicitacao');


}


    public function show($id)
    {
        $solicitacao = Form::with('categorias')->find($id);
       
        
        return view('solicitacao.show', compact('solicitacao'));
       


    }

    public function edit($id){
        
        $categorias = Categorias::all();

        $unidades = DB::connection('pgsql')->table('tb_unidade_saude')->select('no_unidade_saude','co_seq_unidade_saude')->where('no_unidade_saude','like','%Clinica da Familia%')->get();

        $solicitacao = Form::with('categorias')->find($id);
        if ($solicitacao->enviado == 1) {
            return back()->withErrors('Nem tenta');
        } else {
             return view('solicitacao.edit', compact('solicitacao','categorias','unidades'));
        }
        
    }
    public function update(Request $request, $id){
    
    try{
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
    }catch (Exception $e){
        return $e->withErrors('Tente novamente!');
       
       exit;
    } 
    DB::commit();

        return redirect()->route('solicitacao.index');

    }

    public function send($id){

        $send = Form::find($id);

        $send->enviado = '1';
        $send->data_enviado    = date('Y/m/d');

        $send->save();
        
        return redirect()->route('solicitacao.index');
    }


    public function getEquipes(Request $request)
    {
        $unidade = DB::connection('pgsql')->table('tb_unidade_saude')->select('co_seq_unidade_saude')->where('no_unidade_saude','=',$request->unidade_nome)->get();

        $equipes = DB::connection('pgsql')->table('tb_equipe')->select('no_equipe')->where('co_unidade_saude','=',$unidade[0]->co_seq_unidade_saude)->get();
      
        return $equipes;
    }

    public function getAcss(Request $request)
    {
        
        $equipe = $request->equipe_nome;
        
        
        $acss = DB::connection('pgsql')->table('tb_lotacao')
                                                ->join('tb_equipe','tb_equipe.co_seq_equipe','=','tb_lotacao.co_equipe')
                                                ->join('tb_prof','tb_prof.co_seq_prof','=','tb_lotacao.co_prof')
                                                ->join('tb_cbo','tb_cbo.co_cbo','=','tb_lotacao.co_cbo')
                                                ->select('tb_prof.no_profissional')
                                                ->where('tb_cbo.no_cbo','=','AGENTE COMUNITÁRIO DE SAÚDE')
                                                ->where('tb_equipe.no_equipe','=',$equipe)
                                                ->get();

        // $acss = DB::connection('pgsql')->table('tb_unidade_saude')
        // ->crossJoin('tb_equipe')
        // ->crossJoin('tb_lotacao')
        // ->crossJoin('tb_prof')
        // ->crossJoin('tb_cbo')
        // ->select('tb_prof.no_profissional')
        // ->where('tb_unidade_saude.co_seq_unidade_saude','=',DB::raw('tb_equipe.co_unidade_saude'))
        // ->where('tb_lotacao.co_prof','=',DB::raw('tb_prof.co_seq_prof'))
        // ->where('tb_lotacao.co_cbo','=',DB::raw('tb_cbo.co_cbo'))
        // ->where('tb_cbo.no_cbo','=','AGENTE COMUNITÁRIO DE SAÚDE')
        // ->where('tb_equipe.no_equipe','=','ESF TOPAZIO')
        // ->get();


        
        // $acss = DB::connection('pgsql')->table("tb_unidade_saude t1, tb_equipe t2, tb_lotacao t3, tb_prof t4, tb_cbo t5")
        //     ->select("t1.no_unidade_saude", "t2.no_equipe", "t5.no_cbo", "t4.no_profissional", "t1.no_bairro")
        //     ->where("t1.co_seq_unidade_saude", "=", 't2.co_unidade_saude')
        //     ->where("t3.co_prof", "=", 't4.co_seq_prof')
        //     ->where("t3.co_cbo", "=", 't5.co_cbo')
        //     ->where("t5.no_cbo", "=", 'agente')
        //     ->get();




        // $acss = DB::connection('pgsql')->table('tb_equipe')
        //                                     ->join('tb_unidade_saude','tb_unidade_saude.co_seq_unidade_saude','=','tb_equipe.co_unidade_saude') 
        //                                     ->join('tb_lotacao','tb_lotacao.co_prof','=','tb_prof.co_seq_prof')
        //                                     ->join('tb_prof','tb_prof.co_seq_prof','=','tb_lotacao.co_prof')
        //                                     ->join('tb_cbo','tb_cbo.co_cbo','=','tb_lotacao.co_cbo')
        //                                         ->select('tb_prof.no_profissional')
        //                                         ->where('tb_cbo.no_cbo','=','AGENTE COMUNITÁRIO DE SAÚDE')
        //                                         ->get();

        return $acss;

        // SELECT t1.no_unidade_saude, t2.no_equipe, t5.no_cbo, t4.no_profissional, t1.no_bairro

        // FROM 	
        //         tb_unidade_saude t1, 
        //         tb_equipe t2,
        //         tb_lotacao	t3,
        //         tb_prof t4,
        //         tb_cbo t5

        // WHERE 	t1.co_seq_unidade_saude = t2.co_unidade_saude
        // AND		t3.co_prof					= t4.co_seq_prof
        // AND 		t3.co_cbo					= t5.co_cbo
        // AND		t5.no_cbo					='AGENTE COMUNITÁRIO DE SAÚDE'

        // GROUP	BY 1,2,3,4,5
        // ORDER BY 1,2,4

        // $a = DB::connection('pgsql')->table('tb_prof')->select('no_profissional')->where('co_seq_prof','=',541)->get();
        // $acss = DB::connection('pgsql')->table('tb_cbo')->select('no_profissional')->where('no_cbo','=','AGENTE COMUNITÁRIO DE SAÚDE')->where('no_equipe','=','USB BANCO DE AREIA')->get();

        // $a = DB::connection('pgsql')->table('tb_prof')->
        
        // dd($a);
        // return $acss;
    }

}
