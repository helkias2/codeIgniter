<?php 
    verificarNumero($lista);
    function  verificarNumero($lista){
        $novoNum = array();
        foreach($lista as $key => $value){
            if($value->boneco1 != 0){
                $novoNum1[] = $value->boneco1;
            }
            if($value->boneco2 != 0){
                $novoNum2[] = $value->boneco2;
            }
        }
        $nov1= count($novoNum1);
        $nov2= count($novoNum2);

        if($nov1 > $nov2){
            $nov = ceil(($nov1 * 100) / 100);
            echo "Valor  ".$nov; 
        }else{
            $nov = ceil(($nov2 * 100) / 100);
            echo "Valor  ".$nov;
        }
    }

    // Validar dados com PHP
    // Valida se é do tipo Array()
    // Valida se é do tipo String
    // Valida se é do tipo Integer
    // Valida o formato do E-mail
    // Valida o CPF
    // Valida o CNPJ
    // Valida o formato da Data
    // Valida a extensão do Arquivo
    // Valida o CEP
    // Valida formato do número de Telefone
    // Gerar senha letras minusculo e maiuculas e numero

    /// --------------------------------
    // O PHP possui várias funções nativas para validações de tipo, entre elas temos “is_array()”, 
    // essa função retorna TRUE ou FALSE na verificação se o valor passado como parâmetro é um “ARRAY”
    // $valor = array('nome' => 'William');
    
    if(is_array($lista)):
        echo 'É um Array.';
    else:
        echo 'Não é um Array.';
    endif;  

    $valor = 'William123';

    //------------------------------
    //Tipo String

    //Podemos usar outra função nativa do PHP “is_string()” 
    //para validar se o valor passado como parâmetro é do tipo “STRING”, 
    //o retorno é booleano (TRUE ou FALSE), essa é fácil identificar porque o valor está delimitado com apóstrofos:

    if(is_string($valor)):
        echo 'É do tipo String.';
    else:
        echo 'Não é do tipo String.';
    endif; 

    //---------------------------------
    // Tipo Integer

    // Mais uma função nativa “is_integer()”, essa função valida se o valor 
    // passado como parâmetro é do tipo “INTEGER” e retorno TRUE ou FALSE:
    $valor = 2016;
    if(is_integer($valor)):
    echo 'É do tipo Integer.';
    else:
    echo 'Não é do tipo Integer.';
    endif; 

    //---------------------------------
    // Um detalhe importante, se for passado como parâmetro uma variável com valores
    // delimitados por apóstrofo ou aspas, o retorno da função “is_integer()” será FALSE:

    $valor = '2016';

    if(is_integer($valor)):
        echo 'É do tipo Integer.';
    else:
        echo 'Não é do tipo Integer.';
    endif;  

    //---------------------------------

    // Formato de E-mail
    // Mais uma vez o PHP nos ajuda com filters, fornecendo diversos tipos de validação e para 
    // validar e-mails existe uma opção “FILTER_VALIDATE_EMAIL” que retorna TRUE ou  FALSE:

    $valor = 'wllfl@ig.com.br';
    if(filter_var($valor, FILTER_VALIDATE_EMAIL)):
        echo 'E-mail válido.';
    else:
        echo 'E-mail inválido.';
    endif; 

    

// Saída E-mail válido  

    //---------------------------------

    // Se o leitor preferir uma rotina usando REGEX para validar e-mail, segue abaixo uma opção:
    function isEmailValido($email){

        $alfabeto_MiN = "/[a-z]/";
        $caaixa_alta = "/[ˆa-z]/";
        $conta = "/[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        $pattern = $conta.$domino.$extensao;
    
        if (preg_match($pattern, $email))
            return true;
        else
            return false;
        }
    
    //---------------------------------
    
    // Validar CPF

    // Essa função para validar CPF coletei na internet já tem um tempo, 
    // mas infelizmente não me lembro o nome do autor para dar os créditos, 
    // basicamente recebe o CPF como parâmetro e retorna TRUE ou FALSE:

    function isCPFValido($valor){

        $valor = str_replace(array('.','-','/'), "", $valor);
        $cpf = str_pad(preg_replace('[^0-9]', '', $valor), 11, '0', STR_PAD_LEFT);
        
        if (strlen($cpf) != 11 || 
            $cpf == '00000000000' ||
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999'):
            return false;
        else: 
            for ($t = 9; $t < 11; $t++):
                for ($d = 0, $c = 0; $c < $t; $c++) :
                    $d += $cpf{$c} * (($t + 1) - $c);
                endfor;
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d):
                    return false;
                endif;
            endfor;
            return true;
        endif;
    }
    
    $valor = '34291199287';
    
    if(isCPFValido($valor)):
        echo 'CPF válido.';
    else:
        echo 'CPF inválido.';
    endif; 
    
    // Saída CPF válido   

    //---------------------------------

// Validar CNPJ

// Abaixo tem outra função que peguei na internet mas também não tenho o nome do
// autor, essa função valida se o CNPJ é válido e retorna TRUE ou FALSE:

function isCNPJValido($valor){

    $cnpj = str_pad(str_replace(array('.','-','/'),'',$valor),14,'0',STR_PAD_LEFT);
    
    if (strlen($cnpj) != 14):
        return false;
    else:
        for($t = 12; $t < 14; $t++):
            for($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++):
                $d += $cnpj{$c} * $p;
                $p  = ($p < 3) ? 9 : --$p;
            endfor;
            $d = ((10 * $d) % 11) % 10;
            if($cnpj{$c} != $d):
                return false;
            endif;
        endfor;
        return true;
    endif;
}

$valor = '36172186000103';

if(isCNPJValido($valor)):
    echo 'CNPJ válido.';
else:
    echo 'CNPJ inválido.';
endif; 

// Saída CNPJ válido 

//----------------------------------------

// Validar Data

// Para validar se o formato de uma data está correto o PHP fornece a função “checkdate()“, 
// ela recebe 3 parâmetros (mes, dia, ano), para usar é necessário apenas executar a função “explode” 
// para separar os valores de uma data enviada pelo usuário
$valor = '25/12/2016';
$arraData = explode('/', $valor);

if(checkdate($arraData[1], $arraData[0], $arraData[2])):
    echo 'Data válida.';
else:
    echo 'Data inválida.';
endif; 

// Saída Data válida  

// Validar Extensão de Arquivo

// Quando estamos trabalhando com upload de imagens no PHP, recebemos após
// uma submissão de formulário a variável “$_FILES[]” que contém todos os 
// dados do arquivo enviado pelo upload. É sempre uma boa prática validar se a extensão desse arquivo é aceita, pois 
// formulários de upload acabam sendo um porta para invasões, a rotina abaixo ajuda nessa validação:

$extensoes_aceitas[] = array('bmp' ,'png', 'svg', 'jpeg', 'jpg');

$array_extensoes   = explode('.', $_FILES['foto']['name']);
$extensao = strtolower(end($array_extensoes));

if (array_search($extensao, $extensoes_aceitas) === false):
    echo 'Extensão válida';
else:
    echo 'Extensão inválida';
endif;
//-----------------------------------
// Validar o CEP
// Validação de CEP é sempre complicado, o que podemos fazer para reduzir erros é validar a estrutura 
// do CEP usando um REGEX, sugiro colocar uma máscara com JavaScript no front-end assim evita que os usuários digitem sujeiras 
// no campo CEP:

$valor = '18135-690';

if (preg_match('/[0-9]{5,5}([-]?[0-9]{3})?$/', $valor)):
    echo 'CEP válido';
else:
    echo 'CEP inválido';
endif;

// Saída CEP válido 

//----------------------------------------

// Validar número de Telefone
// Validação de telefone principalmente número de celular se tornou outra dor de cabeça depois 
// que adicionaram mais um dígito, porém essa alteração não vale para todos os estados então sempre fica a dúvida de aceitar ou não esse dígito.
// Uma saída é usar um REGEX que aceite os 2 formatos, número de celular com com 9 dígitos e com 8 dígitos:

$valor = '(99) 99999-9999';

if (preg_match('/^\([0-9]{2}\)?\s?[0-9]{4,5}-[0-9]{4}$/', $valor)):
    echo 'Fone válido';
else:
    echo 'Fone inválido';
endif;


    /**
     * VERIFICA SE EMAIL VALIDO
     * ------------------------
     * 
     * Recebe uma string, verifica se a mesma trata-se 
     * de um endereço de email é valido.
     * 
     * @param  string - candidato a email
     * @return boolean
     */
    function isEmail($email) {
    	if(function_exists('filter_var')) {
        	return !filter_var($email, FILTER_VALIDATE_EMAIL) ? false : true;
    	}
        else {
	        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
	        if (preg_match($pattern, $email) === 1) {
	            return true;
	        }
    	}
        return false;
    }

    /**
     * VERIFICA SE CPF VALIDO
     * ----------------------
     * 
     * Verifica se um Número de CPF é valido
     *
     * @access public
     * @param string - numero do cpf com ou sem pontos e hifen a ser verificado
     * @return bool - true caso valido
     **/

     function isCpf( $cpf ){
        $d1 = 0;
        $d2 = 0;
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        
        /**
         * lista de cpf inválidos que serão ignorados
         * @var array
         */
        $cpfs_invalidos = array(
            '00000000000',
            '01234567890',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
        );

        # se o tamanho da string diferente de 11 ou 
        # na lista de cpf invalidos retorna false.
        if(strlen($cpf) != 11 || in_array($cpf, $cpfs_invalidos)) {
            return false;
        } 
        else {
            
            # inicia o processo para achar o primeiro
            # número verificador usando os primeiros 9 dígitos
            for($i = 0; $i < 9; $i++) {
            	# inicialmente $d1 vale zero e é somando.
            	# O loop passa por todos os 9 dígitos iniciais
                $d1 += $cpf[$i] * (10 - $i);
            }

            # acha o resto da divisão da soma acima por 11
            $r1 = $d1 % 11;

            # se $r1 maior que 1 retorna 11 menos $r1 se não
            # retona o valor zero para $d1
            $d1 = ($r1 > 1) ? (11 - $r1) : 0;
            
            # inicia o processo para achar o segundo
            # número verificador usando os primeiros 9 dígitos
            for($i = 0; $i < 9; $i++) {
            	# inicialmente $d2 vale zero e é somando.
            	# O loop passa por todos os 9 dígitos iniciais
                $d2 += $cpf[$i] * (11 - $i);
            }

            # $r2 será o resto da soma do cpf mais $d1 vezes 2
            # dividido por 11
            $r2 = ($d2 + ($d1 * 2)) % 11;

            # se $r2 mair que 1 retorna 11 menos $r2 se não
            # retorna o valor zeroa para $d2
            $d2 = ($r2 > 1) ? (11 - $r2) : 0;

            # retona true se os dois últimos dígitos do cpf
            # forem igual a concatenação de $d1 e $d2 e se não
            # deve retornar false.
            return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        }
    }

    /**
     * VERIFICA SE CNPJ VALIDO
     * -----------------------
     * 
     * Verifica se um Número de CNPJ é valido
     *
     * @access public
     * @param string - numero do CNPJ com ou sem pontos e hifen
     * @return bool - true caso valido
     **/
    function isCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        # Valida tamanho
        if (strlen($cnpj) != 14) return false;
        
        # Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) return false;
        
        # Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
    
    /** 
     * TENTA VERIFICAR SE UMA DATA É VALIDA
     * ------------------------------------
     * 
     * Verifica se uma data parece valida quanto a 
     * formatação., e verifica se é uma data gregoriana
     * válida. Note que, uma data pode ser valida em 
     * diversos formatos, Ex: 
     * 11/05/2017
     * 2017-11-05
     * 2017.11.05
     * 11 de Maio de 2017
     * Porém, existem casos de datas validas que podem 
     * causar certa confusão na interpretação por script:
     * 11/05/17
     * 17/11/05
     *
     * O Script a seguir tenta tratar apenas os casos em que, 
     * a data é formatada com 8 digitos e 10 caracteres. Ex:
     * 11/05/2017 e 2017/05/11 
     *
     * @access public
     * @param  [type]  $x [description]
     * @return boolean    [description]
     */
    function isData( $__data ) {

        # verifica se ano ou dia é o primeiro elemento.
        $__data = str_replace("/", "-", $__data);
        $_data  = explode("-", $__data);
        if(!is_array($_data)) 
            return false;

        # formata data para ficar no formato Americano
        # Y-m-d
        $__data = (strlen($_data[0]) == 4) 
            ? implode("-", $_data) 
            : implode("-", array_reverse($_data));

        # cria uma data a partir do valor encontrado
        $d = DateTime::createFromFormat('Y-m-d', $__data);
        
        return $d && $d->format('Y-m-d') === $__data && 
        checkdate( $d->format('m'), $d->format('d'), $d->format('Y') );
    }
    //-----------------------------------------
    
    
    
// ------------------- ---------------------//
    // Exemplos de como usar esta função
    
    // Retornar a senha com 10 caracteres como maiúsculas, minusculas, números e símbolos:
    // echo gerar_senha(10, true, true, true, true);

    // Retornar a senha com 8 caracteres como maiúsculas, minusculas e números:
    // echo gerar_senha(8, true, true, true, false);

    // Retornar a senha com 6 caracteres como maiúsculas e minusculas:
    // echo gerar_senha(6, true, true, false, false);    
// ------------------- ---------------------//


    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
    $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
    $nu = "0123456789"; // $nu contem os números
    $si = "!@#$%¨&*()_+="; // $si contem os símbolos
    
        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }
        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }
        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }
        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }
        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }



?>

