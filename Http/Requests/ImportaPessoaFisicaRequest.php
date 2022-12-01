<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportaPessoaFisicaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'cpf' => [
                'required',
                'string',
            ],
            'nome' => [
                'string',
            ],
            'rg' => [
                'string',
            ],
            'nomepai' => [
                'string',
                'nullable',
            ],
            'nomemae' => [
                'string',
                'nullable',
            ],
            'datanascimento' => [
                'date',
            ],
            'sexo' => [
                'integer',
            ],
            'estadocivil' => [
                'integer',
            ],
            'nacionalidade' => [
                'integer',
            ],
            'anochegada' => [
                'integer',
            ],
            'cidadenatural.codigo' => [
                'integer',
            ],
            'cidadenatural.localidade' => [
                'integer',
            ],
            'cidadenatural.nome' => [
                'string',
            ],
            'cidadenatural.nomeabreviado' => [
                'string',
            ],
            'cidadenatural.ceplogradouro' => [
                'string',
            ],
            'cidadenatural.cep' => [
                'string',
            ],
            'cidadenatural.codigodne' => [
                'string',
            ],
            'cidadenatural.codigoreceita' => [
                'string',
            ],
            'cidadenatural.codigoibge' => [
                'string',
            ],
            'cidadenatural.codigosinpas' => [
                'string',
            ],
            'cidadenatural.estado.siglapais' => [
                'string',
            ],
            'cidadenatural.estado.sigla' => [
                'string',
            ],
            'cidadenatural.estado.nome' => [
                'string',
            ],
            'grauinstrucao' => [
                'integer',
            ],
            'anoinstrucao' => [
                'integer',
            ],
            'aposentado' => [
                'boolean',
            ],
            'corpele' => [
                'integer',
            ],
            'corolhos' => [
                'integer',
            ],
            'corcabelo' => [
                'integer',
            ],
            'altura' => [
                'string',
            ],
            'peso' => [
                'string',
            ],
            'tiporh' => [
                'integer',
            ],
            'fatorrh' => [
                'integer',
            ],
            'tipodeficiencia' => [
                'integer',
            ],
            'sinalparticular' => [
                'string',
            ],
            'rgorgaoemissor' => [
                'string',
            ],
            'rgdataemissao' => [
                'date',
            ],
            'rgestadoemissor' => [
                'string',
            ],
            'numeroctps' => [
                'integer',
            ],
            'seriectps' => [
                'integer',
            ],
            'dataemissaoctps' => [
                'date',
            ],
            'estadoemissorctps' => [
                'string',
            ],
            'tituloeleitor' => [
                'integer',
            ],
            'zonaeleitoral' => [
                'integer',
            ],
            'secaoeleitoral' => [
                'integer',
            ],
            'cnhcategoria' => [
                'string',
            ],
            'cnhnumero' => [
                'integer',
            ],
            'cnhdatavalidade' => [
                'date',
            ],
            'cnhobservacao' => [
                'string',
            ],
            'numerocarteirareservista' => [
                'integer',
            ],
            'orgaocarteirareservista' => [
                'string',
            ],
            'categoriacarteirareservista' => [
                'string',
            ],
            'dataemissaocarteirareservista' => [
                'date',
            ],
            'numerocartaosus' => [
                'string',
            ],
            'observacoes' => [
                'string',
            ],
        ];
    }
}
