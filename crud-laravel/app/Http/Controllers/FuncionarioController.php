<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionario = Funcionario::all();
        $paginate = DB::table('funcionarios')->paginate(20);

        $search = request('search');

        if($search) {
            $funcionario = Funcionario::where([
                ['nome', 'like','%'.$search.'%']
            ])->get();
        } else {
            $funcionario = Funcionario::all();
        }
        
        return view('funcionario.indexFuncionario', ['funcionario'=>$funcionario, 'paginate'=>$paginate, 'search'=>$search]);
    }

    public function create()
    {
        $setorOption = config('enums.setores');
        return view('funcionario.createFuncionario', ['setorOption'=>$setorOption]);
    }

    public function store(Request $request)
    {
        $funcionario = new Funcionario;

        $funcionario->nome = $request->nome;
        $funcionario->email = $request->email;
        $funcionario->cpf = $request->cpf;
        $funcionario->numeroCelular = $request->numeroCelular;
        $funcionario->dataNascimento = $request->dataNascimento;
        $funcionario->setor = $request->setor;

        $funcionario->save();
        return redirect('/funcionarios')->with('msg', 'Funcionario Cadastrado com Sucesso');

    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id)->delete();

        return redirect('/funcionarios')->with('msg', 'O Funcionario foi excluido com Sucesso!');
    }

    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $setorOption = config('enums.setores');
        
        return view('funcionario.editFuncionario', ['funcionario' => $funcionario, 'setorOption' => $setorOption]);
    }

    public function update(Request $request)
    {   

        Funcionario::findOrFail($request->id)->update($request->all());

        return redirect('/funcionarios')->with('msg', 'Funcionario Editado com Sucesso!');
    }
}
