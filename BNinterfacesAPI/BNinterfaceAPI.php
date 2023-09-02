<?php
  /**
   * BNinterfaceAPI: Абстрактный  класс конструктора запросов и обработчика ответов 
   * интерфейсов сервиса Binance API, связанных с /api/*
   */  
  abstract class BNinterfaceAPI extends BNinterface {
     /**
      * Функция установки лимитов сервиса Binance API
      */
     protected function SetLimitBN() {
        $this->headerLimit = 'x-mbx-used-weight-1m';
        $this->limitKey    = 'IP';
        $this->limitValue  = 1200;
     }
 }
?>

