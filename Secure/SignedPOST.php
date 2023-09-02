<?php
  /**
   * SignedPOST: Трейт, обеспечивающий авторизованные запросы типа POST
   * интерфейсов сервиса Binance API
   */  
  trait SignedPOST {
     use AddAPIkey, AddSignature;
     /**
      * Конструктор запроса
      *
      * @return string                  URL для передачи запроса 
      */
     protected function ConstructRequest() {
        $output['URL'] = $this::ConstructAbsolutePath();
        $requestBody = ConstructHTTPqueryString::Execute($this::ConstructQueryString());
        $output['PostData'] = $this::SignString($requestBody);
        return $output;
     }

 }
?>

