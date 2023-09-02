<?php
  /**
   * SignedGET: Трейт, обеспечивающий авторизованные запросы типа GET
   * интерфейсов сервиса Binance API
   */  
  trait SignedGET {
     use AddAPIkey, AddSignature;
     /**
      * Конструктор запроса
      *
      * @return string                  URL для передачи запроса 
      */
     protected function ConstructRequest() {
        $queryString = ConstructHTTPqueryString::Execute($this::ConstructQueryString());
        $queryString = $this::SignString($queryString);
        $output = $this::ConstructAbsolutePath() . '?' . $queryString;
        return $output;
     }

 }
?>

