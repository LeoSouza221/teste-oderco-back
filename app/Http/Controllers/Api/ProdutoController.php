<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function show() {

        try {
            $produto = Produto::all();

            return $produto;

        } catch(\Exception $erro) {
            return response(['mensagem'=>$erro], 500);
        }

    }
}
