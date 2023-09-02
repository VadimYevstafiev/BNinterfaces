<?php
  /**
   * UseUIDlimits: Трейт, обеспечивающий дополнение HTTP-заголовков запроса
   *  к сервису Binance API заголовком с действительным API-ключом
   */
  trait UseUIDlimits {
     /**
      * Функция установки лимитов сервиса Binance API
      */
     protected function SetLimitBN() {
        $this->headerLimit = 'x-sapi-used-uid-weight-1m';
        $this->limitKey    = 'UID';
        $this->limitValue  = 180000;
     }
  }
?>