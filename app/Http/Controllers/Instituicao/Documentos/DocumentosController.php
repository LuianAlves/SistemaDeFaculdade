<?php

namespace App\Http\Controllers\Instituicao\Documentos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function index() {
        return view('app.instituicao.documentos.index');
    }
}
