<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CertificadoRepositorie;
use PDF;

class CertificadoController extends Controller
{

    private $request;
    private $certificadoRepositorie;

    public function __construct(Request $request, CertificadoRepositorie $certificadoRepositorie)
    {
        $this->request = $request;
        $this->certificadoRepositorie = $certificadoRepositorie;
    }

    public function index()
    {
        return view('index.index');
    }

    public function cadastrarCertificado()
    {
        $dados = $this->request->all();

        $certificado = $this->certificadoRepositorie->cadastrarCertificado($dados);

        $nomePdf = $this->gerarCertificado($certificado);

        return $this->apagarCertificado($nomePdf);
        
    }

    public function apagarCertificado($nomePdf)
    {
        $this->certificadoRepositorie->apagarCertificado($nomePdf);
    }

    public function gerarCertificado($certificado)
    {  
        return $this->certificadoRepositorie->gerarCertificado($certificado);
    
    }
}
