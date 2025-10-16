<?php
require_once __DIR__ . '/../vendor/autoload.php';

use NFePHP\NFCom\Make;

$nfcom = new Make();

$data = [
	'Id' => 1,
	'versao' => 1,
    'cUF'=> 1,
    'tpAmb'=> 1,
    'mod'=> 1,
    'serie'=> 1,
    'nNF'=> 1223,
    'cNF'=> 1,
    'cDV'=> 1,
    'dhEmi'=> 1,
    'tpEmis'=> 1,
    'nSiteAutoriz'=> 1,
    'cMunFG'=> 1,
    'finNFCom'=> 1,
    'tpFat'=> 1,
    'verProc'=> 1,
    'indPrePago'=> 1,
    'indCessaoMeiosRede'=> 1,
    'dhCont'=> 1,
    'xJust'=> 1,
];

$nfcom = new Make();

// Montagem dos dados do XML (exemplo)
$stdInfNFCom = new stdClass();
$stdInfNFCom->Id = 'NFCOM43251012345678000195620010000000011123456783'; // Chave de 44 dígitos com prefixo NFCOM
$nfcom->tagInfNFCom($stdInfNFCom);

$stdIde = new stdClass();
$stdIde->cUF = 43;
$stdIde->tpAmb = 2;
$stdIde->mod = 62;
$stdIde->serie = 1;
$stdIde->nNF = 1;
$stdIde->cNF = 12345678;
$stdIde->cDV = 9;
$stdIde->dhEmi = date('c');
$stdIde->tpEmis = 1;
$stdIde->nSiteAutoriz = 123456;
$stdIde->cMunFG = 4305108;
$stdIde->finNFCom = 1;
$stdIde->tpFat = 1;
$stdIde->verProc = '1.0';
$stdIde->indPrePago = 0;
$stdIde->indCessaoMeiosRede = 0;
$stdIde->dhCont = null;
$stdIde->xJust = null;
$nfcom->tagIde($stdIde);

$stdEmit = new stdClass();
$stdEmit->CNPJ = '12345678000195';
$stdEmit->xNome = 'Empresa Exemplo LTDA';
$stdEmit->xFant = 'Exemplo Fantasia';
$stdEmit->enderEmit = new stdClass();
$stdEmit->enderEmit->xLgr = 'Rua Exemplo';
$stdEmit->enderEmit->nro = '1234';
$stdEmit->enderEmit->xBairro = 'Bairro Exemplo';
$stdEmit->enderEmit->cMun = 4305108;
$stdEmit->enderEmit->xMun = 'Porto Alegre';
$stdEmit->enderEmit->UF = 'RS';
$stdEmit->enderEmit->CEP = '90000000';
$stdEmit->enderEmit->cPais = 1058;
$stdEmit->enderEmit->xPais = 'Brasil';
$stdEmit->enderEmit->fone = '5133334444';
$stdEmit->IE = '1234567890';
$stdEmit->CRT = 3;
$nfcom->tagEmit($stdEmit);

try {
	$nfcom->monta();
} catch (\Exception $e) {
	$error['nNF'] = $data['nNF'];
	$error['erros'] = $nfcom->getErrors();
	throw new \Exception(json_encode($error), 400);
}

var_dump($nfcom);

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="nfcom.xml"');
echo $nfcom->getXML();

