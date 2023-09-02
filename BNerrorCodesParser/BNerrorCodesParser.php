<?php
  /**
   * BNerrorCodesParser: Класс функций разбора сообщений об ошибках
   * интерфейсов сервиса Binance API
   */  
  class BNerrorCodesParser {
     use ParseOrderRejectionIssuesCodes, Parse10xxCodes, Parse11xxCodes, Parse20xxCodes,
         Parse30xxCodes, Parse40xxCodes, Parse50xxCodes, Parse60xxCodes, Parse70xxCodes,
         Parse9xxxCodes, Parse10xxxCodes, Parse12xxxCodes, Parse13xxxCodes, Parse18xxxCodes,
         Parse20xxxCodes, Parse21xxxCodes;
     /**
      * @param  integer  $code              Служебный код
      * @param  string   $message           Текстовое сообщение об ошибке
      */
     protected $code;
     protected $message;
     /**
      * Статическая функция разбора и обработки сообщений об ошибке интерфейсов сервиса Binance API
      *
      * @param  array    $response          Ответ сервиса
      *
      * @return array                       Массив обработанного сообщения об ошибке интерфейсов сервиса Binance API
      */
      static public function ParseCode($response) {
        $instance = new static();
        $errorCode = strval($response['code']);
        $instance->code = 0;
        if (5 == strlen($errorCode)) {
           switch (substr($errorCode, 0, 3)) {
              case '-10':
                 $instance->Parse10xxCodes($response);
                 break;
              case '-11':
                 $instance->Parse11xxCodes($response);
                 break;
              case '-20':
                 $instance->Parse20xxCodes($response);
                 break;
              case '-30':
                 $instance->Parse30xxCodes($response);
                 break;
              case '-40':
                 $instance->Handle40xxCodes($response);
                 break;
              case '-50':
                 $instance->Parse50xxCodes($response);
                 break;
              case '-60':
                 $instance->Parse60xxCodes($response);
                 break;
              case '-70':
                 $instance->Parse70xxCodes($response);
                 break;
           }
           if ('-9' == substr($errorCode, 0, 2)) {
              $instance->Parse9xxxCodes($response);
           }
        }
        if (6 == strlen($errorCode)) {
           switch (substr($errorCode, 0, 3)) {
              case '-10':
                 $instance->Parse10xxxCodes($response);
                 break;
              case '-12':
                 $instance->Parse12xxxCodes($response);
                 break;
              case '-13':
                 $instance->Parse13xxxCodes($response);
                 break;
              case '-18':
                 $instance->Parse18xxxCodes($response);
                 break;
              case '-20':
                 $instance->Parsee20xxxCodes($response);
                 break;
              case '-21':
                 $instance->Parse21xxxCodes($response);
                 break;
           }
        }
        return array('code' => $instance->code, 'message' => $instance->message);
     }
     /**
      * Функция извлеченя строковых переменных из сообщения об ошибке
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return array                       Массив строковых переменных
      */
     protected function GetVariableString($message) {
         $array = str_split($message);
         $keys = array();
         foreach($array as $key => $value) {
            if ("'" == $value) {
               $keys[] = $key;
            }
         }
         $keys = array_chunk($keys, 2);
         $output = array();
         foreach($keys as $value) {
            $item = '';
            for ($i = $value[0]; $i <= $value[1]; $i++) {
               $item .= $array[$i];
            }
            $output[] = $item;
         }
         return $output;   
     }
 }
?>

