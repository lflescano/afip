<?php
namespace Dedalo\Afip\Test;

include dirname(__DIR__) . '../../vendor/autoload.php';

use Dedalo\Afip\Afip;

$data = array(
	'CantReg' 		=> 1, // Cantidad de comprobantes a registrar
	'PtoVta' 		=> 1, // Punto de venta
	'CbteTipo' 		=> 6, // Tipo de comprobante (ver tipos disponibles) 
	'Concepto' 		=> 1, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
	'DocTipo' 		=> 80, // Tipo de documento del comprador (ver tipos disponibles)
	'DocNro' 		=> 20111111112, // Numero de documento del comprador
	'CbteDesde' 	=> 20, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
	'CbteHasta' 	=> 20, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
	'CbteFch' 		=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
	'ImpTotal' 		=> 1297.91, // Importe total del comprobante
	'ImpTotConc' 	=> 0, // Importe neto no gravado
	'ImpNeto' 		=> 1103.99, // Importe neto gravado
	'ImpOpEx' 		=> 0, // Importe exento de IVA
	'ImpIVA' 		=> 193.92, //Importe total de IVA
	'ImpTrib' 		=> 0, //Importe total de tributos
	'FchServDesde' 	=> NULL, // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
	'FchServHasta' 	=> NULL, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
	'FchVtoPago' 	=> NULL, // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
	'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
	'MonCotiz' 		=> 1, // Cotización de la moneda usada (1 para pesos argentinos)  
//	'CbtesAsoc' 	=> array( // (Opcional) Comprobantes asociados
//		array(
//			'Tipo' 		=> 6, // Tipo de comprobante (ver tipos disponibles) 
//			'PtoVta' 	=> 1, // Punto de venta
//			'Nro' 		=> 1, // Numero de comprobante
//			'Cuit' 		=> 20111111112 // (Opcional) Cuit del emisor del comprobante
//			)
//		),
//	'Tributos' 		=> array( // (Opcional) Tributos asociados al comprobante
//		array(
//			'Id' 		=>  99, // Id del tipo de tributo (ver tipos disponibles) 
//			'Desc' 		=> 'Ingresos Brutos', // (Opcional) Descripcion
//			'BaseImp' 	=> 150, // Base imponible para el tributo
//			'Alic' 		=> 5.2, // Alícuota
//			'Importe' 	=> 7.8 // Importe del tributo
//		)
//	), 
	'Iva' 			=> array( // (Opcional) Alícuotas asociadas al comprobante
		array(
			'Id' 		=> 5, // Id del tipo de IVA (ver tipos disponibles) 
			'BaseImp' 	=> 742.89, // Base imponible
			'Importe' 	=> 156 // Importe 
		),
                array(
			'Id' 		=> 4, // Id del tipo de IVA (ver tipos disponibles) 
			'BaseImp' 	=> 361.1, // Base imponible
			'Importe' 	=> 37.92 // Importe 
		)
	), 
//	'Opcionales' 	=> array( // (Opcional) Campos auxiliares
//		array(
//			'Id' 		=> 17, // Codigo de tipo de opcion (ver tipos disponibles) 
//			'Valor' 	=> 2 // Valor 
//		)
//	), 
//	'Compradores' 	=> array( // (Opcional) Detalles de los clientes del comprobante 
//		array(
//			'DocTipo' 		=> 80, // Tipo de documento (ver tipos disponibles) 
//			'DocNro' 		=> 20111111112, // Numero de documento
//			'Porcentaje' 	=> 100 // Porcentaje de titularidad del comprador
//		)
//	)
);

$afip = new Afip(array('CUIT' => 20356089511, 'folderCert' => '../../resources', 'production' => FALSE));

// var_dump($afip->getWsfev1()->GetLastVoucher(1, 6));
// var_dump($afip->getWsfev1()->CreateVoucher($data));
// var_dump($afip->getWsfev1()->GetVoucherInfo(4, 1, 6));
// var_dump($afip->getWsSrPadronA5()->GetTaxpayerDetails(20356089511));  Solo para prod