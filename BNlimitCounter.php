<?php
  /**
   * BNlimitCounter: Класс счетчика использованных лимитов сервиса Binance API
   */
  class BNlimitCounter {
     use SingletonPattern;
     /**
      * @param  array    $counter           Счетчик использованных лимитов сервиса Binance API
      */
     protected $counter = array();
     /**
      * Функция получения значения использованного лимита сервиса Binance API по идентификатору
      *
      * @param  string   $limitKey          Идентификатор использованного лимита сервиса Binance API
      *
      * @return array                       Значение использованного лимита сервиса Binance API
      *                                     по идентификатору
      */
     static public function GetLimit($limitKey) {
        self::GetInstance();
        return self::$instance->counter[$limitKey];
     }
     /**
      * Функция обновления счетчика использованных лимитов сервиса Binance API
      *
      * @param  string   $limitKey          Идентификатор использованного лимита сервиса Binance API
      * @param  string   $usedWeight        Значение использованного лимита сервиса Binance API
      */
     static public function RefreshLimit($limitKey, $usedWeight) {
        self::GetInstance();
        self::$instance->counter[$limitKey] = (int) $usedWeight;
     }
     /**
      * Конструктор
      *
      * @param array     $arguments     Массив аргументов конструктора  
      */
     private function __construct ($arguments) {
        $this->counter['IP'] = 0;
        $this->counter['UID'] = 0;
     }
  }
?>