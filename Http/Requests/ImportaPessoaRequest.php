<?php

namespace Modules\ConvenioIPM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportaPessoaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nomerazao' => [
                'required',
                'string',
            ],
            'tipopessoa' => [
                'required',
                'integer',
            ],
            'cpfcnpj' => [
                'required',
                'string',
                'regex:/\d{3}\.\d{3}\.\d{3}\-\d{2}|\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}/i',
            ],
            'rgie' => [
                'required',
                'string',
            ],
            'estrangeiro' => [
                'required',
                'integer',
            ],
            'situacao' => [
                'required',
                'integer',
            ],
            'nomefantasia' => [
                'required',
                'string',
            ],
            'observacoes' => [
                'string',
                'nullable',
            ],
            'orgaoemissor' => [
                'string',
                'nullable',
            ],
            'ufemissor' => [
                'string',
            ],
            'dataemissao' => [
                'date',
            ],
            'sexo' => [
                'integer',
            ],
            'nomepai' => [
                'string',
                'nullable',
            ],
            'nomemae' => [
                'string',
                'nullable',
            ],
            'grauinstrucao' => [
                'integer',
            ],
            'cnhnumero' => [
                'string',
                'nullable',
            ],
            'cnhcategoria' => [
                'string',
                'nullable',
            ],
            'cnhobservacao' => [
                'string',
                'nullable',
            ],
            'cnhvalidade' => [
                'date',
            ],
            'enderecos' => [
                'present',
                'array',
            ],
            'enderecos.*.tipo' => [
                'required',
                'integer',
            ],
            'enderecos.*.cep' => [
                'required',
                'string',
            ],
            'enderecos.*.complemento' => [
                'string',
            ],
            'enderecos.*.pontoreferencia' => [
                'string',
            ],
            'enderecos.*.numero' => [
                'string',
            ],
            'enderecos.*.cidade' => [
                'required',
            ],
            'enderecos.*.cidade.codigo' => [
                'required',
                'integer',
            ],
            'enderecos.*.cidade.localidade' => [
                'integer',
            ],
            'enderecos.*.cidade.nome' => [
                'required',
                'string',
            ],
            'enderecos.*.cidade.nomeabreviado' => [
                'string',
            ],
            'enderecos.*.cidade.ceplogradouro' => [
                'string',
            ],
            'enderecos.*.cidade.cep' => [
                'string',
            ],
            'enderecos.*.cidade.codigodne' => [
                'string',
            ],
            'enderecos.*.cidade.codigoreceita' => [
                'string',
            ],
            'enderecos.*.cidade.codigoibge' => [
                'string',
            ],
            'enderecos.*.cidade.codigosinpas' => [
                'string',
            ],
            'enderecos.*.estado' => [
                'required',
            ],
            'enderecos.*.estado.siglapais' => [
                'required',
                'string',
            ],
            'enderecos.*.estado.sigla' => [
                'required',
                'string',
            ],
            'enderecos.*.estado.nome' => [
                'required',
                'string',
            ],
            'enderecos.*.bairro' => [
                'required',
            ],
            'enderecos.*.bairro.nome' => [
                'required',
                'string',
            ],
            'enderecos.*.bairro.nomeabreviado' => [
                'string',
            ],
            'enderecos.*.bairro.situacao' => [
                'required',
                'string',
            ],
            'enderecos.*.bairro.codigodne' => [
                'string',
            ],
            'enderecos.*.logradouro' => [
                'required',
            ],
            'enderecos.*.logradouro.tipo' => [
                'required',
                'integer',
            ],
            'enderecos.*.logradouro.tipodescricao' => [
                'required',
            ],
            'enderecos.*.logradouro.tipodescricaoabreviado' => [
                'string',
            ],
            'enderecos.*.logradouro.situacao' => [
                'required',
                'integer',
            ],
            'enderecos.*.logradouro.nome' => [
                'required',
                'string',
            ],
            'enderecos.*.logradouro.nomeabreviado' => [
                'string',
            ],
            'enderecos.*.logradouro.complemento' => [
                'string',
            ],
            'enderecos.*.logradouro.nomegrandodne' => [
                'string',
            ],
            'contatos' => [
                'present',
                'array',
            ],
            'contatos.*.tipo' => [
                'required',
                'integer',
            ],
            'contatos.*.preferencial' => [
                'required',
                'boolean',
            ],
            'contatos.*.horario' => [
                'string',
            ],
            'contatos.*.descricao' => [
                'required',
                'string',
            ],
            'contatos.*.complemento' => [
                'string',
            ],
        ];
    }
}
