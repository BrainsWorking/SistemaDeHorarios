<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Session;


class InstituicaoController extends Controller
{
    private $totalPorPag = 10;

    public function index(){
        $instituicao = Instituicao::count();

        if($instituicao == 0){
            return redirect()->route('instituicao.cadastrar');
        }else{
            $instituicao = Instituicao::get()->first();

            return redirect()->route('instituicao.editar', $instituicao->id);
            
        }

        return view('instituicao.index', compact('instituicoes'));        
    }

    public function cadastrar(){
        return view('instituicao.formInstituicao');
    }

    public function editar($id){
        $instituicao = Instituicao::find($id);
        return view('instituicao.formInstituicao', compact('instituicao'));
    }

    public function salvar(Request $request){
        try{
            DB::transaction(function () use ($request) {

                $dataForm = $request->all();

                Instituicao::create($dataForm);

            }, 3); 
            return redirect()->route('instituicao')->with('success', 'Instituição modificada.');
        }    
        catch(\Exception $e){
            return redirect()->route('instituicao.cadastrar')->with('error', 'Falha ao cadastrar.');
        }
    }

    public function atualizar(Request $request, $id){
        try{
            $dataForm = $request->all();
            DB::transaction(function () use ($dataForm, $id) {
                $instituicao = Instituicao::find($id);
                $instituicao->update($dataForm);
            }, 3);

            return redirect()->route('instituicao')->with('success', 'Instituição editada.');
        }    
        catch(\Exception $e){
            return redirect()->route('instituicao.editar')->with('error', 'Falha ao editar.');
        }
    }

    public function deletar($id){
        try{
            DB::transaction(function () use ($id) {
                Instituicao::find($id)->delete();
            }, 3);
            return redirect()->route('instituicao')->with('success', 'Exclusão realizada com sucesso.');
        }
        catch(\Exception $e){
            return redirect()->route('instituicao')->with('error', 'Erro na exclusão.');
        }
    }
}
