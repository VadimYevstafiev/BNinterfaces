<?php
  /**
   * AddAPIkey: Трейт, обеспечивающий дополнение HTTP-заголовков запроса
   *  к сервису Binance API заголовком с действительным API-ключом
   */
  trait AddAPIkey {
     /**
      * @param  string   $APIkey            API-ключ
      */
     protected $APIkey = 'LNXazqMQp5nmfSwevSA71PvzEbgmqxnVqmDcP44Kpngi2PloIwKVIUffoNMBu7Ap';
     /**
      * Функция переопределения массива HTTP-заголовков запроса cURL
      *
      * @param  string   $input             Ответ сервиса
      *
      */
     protected function SetRequestHeaders() {
        $requestHeaders = array('X-MBX-APIKEY' => $this->APIkey);
        $this->curl->SetRequestHeaders($requestHeaders);
     }
  }
?>