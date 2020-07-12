<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


use App\ImpostoProduto;

class ImpostoProdutoController extends Controller
{
    public function status() {
        return ['status' => 500];
    }

    public function create(Request $request) {

        try {
            $validator = Validator::make($request->all(), [
                'uf' => 'required|max:2',
                'percentual' => 'required',
                'produto_id' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response(['mensagem'=>'Preencha todos os campos adequadamente'], 500);
            }

            $imposto = new ImpostoProduto();

            $imposto->uf = $request->uf;
            $imposto->percentual = $request->percentual;
            $imposto->produto_id = $request->produto_id;

            $verifica_imposto = ImpostoProduto::whereRaw('produto_id = ? and uf LIKE ?', [$imposto->produto_id, $imposto->uf])->get();

            if (!$verifica_imposto->isEmpty()) {
                return response(['mensagem'=>'Imposto ja cadastrado para produto'], 500);
            }

            $imposto->save();
            
            return response(['mensagem'=>'Sucesso'], 200);
        } catch(\Exception $erro) {
            return response(['mensagem'=>$erro], 500);
        }

    }

    public function show() {

        try {
            $imposto = ImpostoProduto::all('id', 'uf', 'produto_id', 'percentual');

            return $imposto;

        } catch(\Exception $erro) {
            return response(['mensagem'=>$erro], 500);
        }

    }

    public function update(Request $request) {

        try {
            $preco = $request->preco;
            $produto_id = $request->produto_id;
            $uf = $request->uf;
            
            $resultadoPercentual = ImpostoProduto::select('percentual')->whereRaw('produto_id = ? and uf LIKE ?', [$produto_id, $uf])->get();
            $percentual = $resultadoPercentual->first();

            if ($resultadoPercentual->isEmpty()) {
                return response(['mensagem'=>'Imposto não cadastrado para produto e uf'], 500);
            }

            $valor_imposto = (floatval($preco)/100) * floatval($percentual->percentual);

            return response(['produto_id'=>$produto_id, 
                'preco'=>$preco, 
                'uf'=>$uf,
                'valor_imposto'=>$valor_imposto], 200);
        } catch(\Exception $erro) {
            return response(['mensagem'=>$erro], 500);
        }
    }
}
