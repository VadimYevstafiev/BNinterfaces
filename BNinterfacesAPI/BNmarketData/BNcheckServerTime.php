<?php
  /**
   * BNcheckServerTime: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса проверки подключения к сервису Binance API и получения текущего времени сервера.
   */  
  class BNcheckServerTime extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/time';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNcheckServerTime::SendQuery()
      *
      * @return array                       Ассоциативный массив, содержащий элемент: 
      *                                          integer   serverTime     Текущее время сервера в милисекундах
      */
     static public function SendQuery() {
        self::SaveArguments();
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      */
     static protected function SaveArguments() {
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        return 1;
     }
     /**
      * Конструктор строки запроса
      *
      * @return string                  Строка запроса 
      */
     protected function ConstructQueryString() {
     }
 }
?>