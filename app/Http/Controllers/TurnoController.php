<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    public function index() {
        $turnos = Turno::join('horarios', 'turnos.id', '=', 'horarios.id')->get();



        return view('turno.index', compact('turnos'));
    }

    public function editar($id) {
        $turno = Turno::findOrFail($id);
        return view('turno.formTurno', compact('turno'));
    }

    public function atualizar(Request $request, $id){
        try{
            DB::transaction(function () use ($request, $id) {

                $turno = Turno::findOrFail($id);

                $turno->update($request->all());
                
                $turno->horarios()->sync([]);

                $horarios = $request->input('horario');

                foreach ($horarios as $horario) {
                    $horario = Horario::firstOrCreate($horario);
                
                    $turno->horarios()->attach($horario);
                }
            }, 3);

            return redirect()->route('turnos')->withSuccess('Edição realizada com sucesso');
        
        }catch(\Exception $e){
            return redirect()->route('turno.editar', $id)->withError('Erro na edição!');
        }
    }
    
    public function cadastrar(){
        return view('turno.formTurno');
    }

    public function salvar(Request $request){
        
        try{
            DB::transaction(function () use ($request) {
                
                $turno = Turno::firstOrCreate($request->only(['nome']));

                $horarios = $request->input('horario');
                
                foreach ($horarios as $horario) {
                    $horario = Horario::firstOrCreate($horario);
                
                    $turno->horarios()->attach($horario);
                }
            }, 3);
            
            return redirect()->route('turnos')->withSuccess('Turno cadastrado com sucesso');
        }catch(\Exception $e){
            return redirect()->route('turnos')->withError('Erro ao cadastrar turno');
        }
    }

    public function deletar($id){
        try {
            DB::transaction(function () use ($id) {
                $turno = Turno::find($id);

                $turno->delete();
            }, 3);

            return redirect()->route('turnos')->withSuccess('Exclusão realizada com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('turnos')->withError('Erro na exclusão!');
        }
    }
}
