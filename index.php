<?php
/**
 *
 *    ������DDNS-API By D-Jy
 *
 *    MIT License
 *
 */

date_default_timezone_set('UTC');

include_once 'alicloud-php-updaterecord/V20150109/AlicloudUpdateRecord.php';

use Roura\Alicloud\V20150109\AlicloudUpdateRecord;

/**
 *ʹ��˵��
 *eg. http://xxx.com/?ip=127.0.0.1&name=d-jy.net&type=A&rr=www
 *URLδָ������ʱ�Զ�������ǰ�豸ip eg. http://xxx.com
 */

//����˵����
//data	��¼ֵ	eg. x.x.x.x or xxx.com ....
//name	������	eg. d-jy.net
//type	��������	eg. A CNAME....
//rr	��������	eg. @ www ....

//id	AccessKeyId
//secret 	AccessKeySecret


//���ÿ�ʼ

//����������URL��δ����ʱ��Ч
$Name	= 'd-jy.net';	//ָ��������   eg. d-jy.net
$Type	= 'A';		//ָ���������� eg. A CNAME....
$rr	= 'www';		//ָ��������¼ eg. @ www ....

//����������������ҳ��ȡ
$AccessKeyId	= '';
$AccessKeySecret	= '';

//���ý���


//�������ݽ����޸�

$ip		= $_GET['ip'];	//��ȡIP
$data		= $_GET['data'];	//��ȡDATA
$KeyId		= $_GET['id'];	//��ȡAccessKeyId
$KeySecret	= $_GET['secret'];	//��ȡAccessKeySecret

$DomainName	= $_GET['name'];	//��ȡ����
$RecordType	= $_GET['type'];	//��ȡ�������� eg. A CNAME....
$RR	 	= $_GET['rr'];	//��ȡ������¼

$test		= $_GET['debug'];	//Debug

$updater         = new AlicloudUpdateRecord($AccessKeyId, $AccessKeySecret);

	//���IP�����ڻ���Ϊ��
	if((!isset($ip) || ($ip == ''))) {
		//��ȡIP
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		   $ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
 		   $ip= $_SERVER['REMOTE_ADDR'];
		}  
	}

	//���data�����ڻ���Ϊ��
	if((!isset($data) || ($data == ''))) {
		$data = $ip;
	}
	//���KeyId�����ڻ���Ϊ��
	if((!isset($AccessKeyId) || ($AccessKeyId == ''))) {
		$AccessKeyId = $KeyId;
	}
	//���KeySecret�����ڻ���Ϊ��
	if((!isset($AccessKeySecret) || ($AccessKeySecret == ''))) {
		$AccessKeySecret = $KeySecret;
	}

	//���DomainName�����ڻ���Ϊ��
	if((!isset($DomainName) || ($DomainName == ''))) {
		$DomainName = $Name;
	}
	//���RecordType�����ڻ���Ϊ��
	if((!isset($RecordType) || ($RecordType == ''))) {
		$RecordType = $Type;
	}
	//���RR�����ڻ���Ϊ��
	if((!isset($RR) || ($RR == ''))) {
		$RR = $rr;
	}


$updater->setDomainName($DomainName);
$updater->setRecordType($RecordType);
$updater->setRR($RR);
$updater->setValue($data);

//Debug
if((!isset($test) || ($test == 'false'))) {
echo "OK";
 }else{
	echo "<h1>Debug</h1>";
	echo "</br>";
	echo "Data: ";
	echo $data;
	echo "</br>";
	echo "DomainName: ";
	echo $DomainName;
	echo "</br>";
	echo "Type: ";
	echo $RecordType;
	echo "</br>";
	echo "RR: ";
	echo $RR;
	echo "</br>";
	echo "Result: ";
	print_r($updater->sendRequest());
	} 
