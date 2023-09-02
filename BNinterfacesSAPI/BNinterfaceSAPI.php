<?php
  /**
   * BNinterfaceSAPI: Абстрактный  класс конструктора запросов и обработчика ответов 
   * интерфейсов сервиса Binance API, связанных с /sapi/*
   */  
  abstract class BNinterfaceSAPI extends BNinterface {
     /**
      * Функция установки лимитов сервиса Binance API
      */
     protected function SetLimitBN() {
        $this->headerLimit = 'x-sapi-used-ip-weight-1m';
        $this->limitKey    = 'IP';
        $this->limitValue  = 12000;
     }
 }
?>

