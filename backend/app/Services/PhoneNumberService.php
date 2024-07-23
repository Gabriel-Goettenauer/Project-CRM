<?php

namespace App\Services;

class PhoneNumberService
{
    // Lista de DDDs válidos no Brasil e suas localidades
    protected $validDDDs = [
        '11' => 'São Paulo', '12' => 'São Paulo', '13' => 'São Paulo', '14' => 'São Paulo', '15' => 'São Paulo', 
        '16' => 'São Paulo', '17' => 'São Paulo', '18' => 'São Paulo', '19' => 'São Paulo', '21' => 'Rio de Janeiro', 
        '22' => 'Rio de Janeiro', '24' => 'Rio de Janeiro', '27' => 'Espírito Santo', '28' => 'Espírito Santo', 
        '31' => 'Minas Gerais', '32' => 'Minas Gerais', '33' => 'Minas Gerais', '34' => 'Minas Gerais', '35' => 'Minas Gerais', 
        '37' => 'Minas Gerais', '38' => 'Minas Gerais', '41' => 'Paraná', '42' => 'Paraná', '43' => 'Paraná', 
        '44' => 'Paraná', '45' => 'Paraná', '46' => 'Paraná', '47' => 'Santa Catarina', '48' => 'Santa Catarina', 
        '49' => 'Santa Catarina', '51' => 'Rio Grande do Sul', '53' => 'Rio Grande do Sul', '54' => 'Rio Grande do Sul', 
        '55' => 'Rio Grande do Sul', '61' => 'Distrito Federal', '62' => 'Goiás', '63' => 'Tocantins', '64' => 'Goiás', 
        '65' => 'Mato Grosso', '66' => 'Mato Grosso', '67' => 'Mato Grosso do Sul', '68' => 'Acre', '69' => 'Rondônia', 
        '71' => 'Bahia', '73' => 'Bahia', '74' => 'Bahia', '75' => 'Bahia', '77' => 'Bahia', '79' => 'Sergipe', 
        '81' => 'Pernambuco', '82' => 'Alagoas', '83' => 'Paraíba', '84' => 'Rio Grande do Norte', '85' => 'Ceará', 
        '86' => 'Piauí', '87' => 'Pernambuco', '88' => 'Ceará', '89' => 'Piauí', '91' => 'Pará', '92' => 'Amazonas', 
        '93' => 'Pará', '94' => 'Pará', '95' => 'Roraima', '96' => 'Amapá', '97' => 'Amazonas', '98' => 'Maranhão', 
        '99' => 'Maranhão'
    ];

    // Regex para validar números de telefone brasileiros (fixos e móveis)
    protected $phonePattern = '/^(?:\+55)?(?:\(?(\d{2})\)?\s?)?(\d{4,5}\-?\d{4})$/';

    public function formatPhoneNumber($phoneNumber)
    {
        // Remover caracteres não numéricos
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Verificar se o número tem 10 dígitos (fixo) ou 11 dígitos (móvel)
        if (strlen($phoneNumber) === 10) {
            // Verificar o prefixo para determinar se é fixo ou móvel
            $prefix = substr($phoneNumber, 2, 1);

            if ($prefix >= '2' && $prefix <= '5') {
                // Número fixo, não adicionar o 9
                return $phoneNumber;
            } else {
                throw new \Exception('Número fixo inválido.');
            }
        }

        if (strlen($phoneNumber) === 11) {
            // Verificar se é um número móvel
            if ($phoneNumber[2] === '9') {
                return $phoneNumber;
            } else {
                throw new \Exception('Número móvel inválido.');
            }
        }

        // Se o número não atender a essas condições, é inválido
        throw new \Exception('Número de telefone inválido.');
    }

    public function validatePhoneNumber($phoneNumber)
    {
        // Remover caracteres não numéricos
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Validar número de telefone com regex
        if (preg_match($this->phonePattern, $phoneNumber)) {
            // Extrair DDD e número
            $ddd = substr($phoneNumber, 0, 2);
            $length = strlen($phoneNumber);
            
            // Validar DDD
            if (!array_key_exists($ddd, $this->validDDDs)) {
                return false;
            }
            
            if ($length === 10) {
                // Verificar se é um número fixo com prefixo válido
                $prefix = $phoneNumber[2];
                return $prefix >= '2' && $prefix <= '5';
            } elseif ($length === 11) {
                // Verificar se é um número móvel
                return $phoneNumber[2] === '9';
            }
        }

        return false;
    }

    public function getDDDLocation($ddd)
    {
        return $this->validDDDs[$ddd] ?? 'DDD inválido';
    }
}
