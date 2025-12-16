<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\jogos;

class JogosController extends Controller
{
    public function index()
        {
           try{
                $jogos = Jogos::All();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Jogos encontradas com sucesso',
                    'data' => [
                        'total' => $jogos->count(),
                        'items' => $jogos
                    ]
                ]);
            } catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao buscar os jogos no servidor',
                    'error' => $e->getMessage()
                ], 500);  
            }
        }

        public function store(Request $request)
        {
            // Validação dos dados recebidos
            $validador = Validator::make($request->all(), [
                'nome' => 'required|string',
                'genero' => 'required|string',
                'ano' => 'required|integer',
                'plataforma' => 'required|string'
            ]);

            if($validador->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Registro inválido',
                    'errors' => $validador->errors(),
                ], 400);
            }

            try{
                $jogo = Jogos::create([
                    'nome' => $request->nome,
                    'genero' => $request->genero,
                    'ano' => $request->ano,
                    'plataform' => $request->plataforma
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Jogo cadastrado com sucesso!',
                    'data' => $jogo,
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao cadastrar o jogo',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        public function show($id)
        {
            $jogo = Jogos::find($id);

            if($jogo) {
                return response()->json([
                    'success' => true,
                    'message' => 'Jogo localizado com sucesso!',
                    'data' => $jogo
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Jogo não localizado.',
                ], 404);
            }
        }

        public function update(Request $request, string $id)
        {
            $validador = Validator::make($request->all(), [
                'nome' => 'required|string',
                'genero' => 'required|string',
                'ano' => 'required|integer',
                'plataforma' => 'required|string'
            ]);

            if($validador->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Registros inválidos',
                    'errors' => $validador->errors()
                ], 400);
            }

            $registrosBanco = Jogos::find($id);

            if(!$registrosBanco){
                return response()->json([
                    'success' => false,
                    'message' => 'Jogo não encontrado'
                ], 404);
            }

            // Atualizando os dados
            $registrosBanco->nome = $request->nome;
            $registrosBanco->genero = $request->genero;
            $registrosBanco->ano = $request->ano;
            $registrosBanco->plataforma = $request->plataforma;
            
            if($registrosBanco->save()){
                    return response()->json([
                        'success' => true,
                        'message' => 'jogo atualizado com sucesso!',
                        'data' => $registrosBanco
                ], 200);
            } else{
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao atualizar o jogo'
                ], 500);
            }
        }

        public function destroy($id)
        {
            $jogo = Jogos::find($id);

            if (!$jogo) {
                return response()->json([
                    'success' => true,
                    'message' => 'Jogo não encontrado'
                ], 404);
            }
            
            try{
                $jogo->delete();

                return response()->json([
                    'success' => false,
                    'message' => 'Jogo deletado com sucesso'
                ], 200);
            } catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao apagar o jogo',
                    'error' => $e->getMessage()
                ], 500);  
            }
        }
}