<?php
  /**
   * BNsystemStatus: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса информации о состоянии сервиса Binance API
   */  
  class BNsystemStatus extends BNinterfaceSAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/sapi/v1/system/status';
     /**
      * Функция отправки запроса и обработки ответа 
      *
      * @return array                       Ассоциативный массив, содержащий элементы: 
      *                                          integer   status         Код состояния сервиса:
      *                                                                      0 -  сервис работает нормально
      *                                                                      1 -  сервис на техническом обслуживании
      *                                          string    msg            Текстовое сообщение о состоянии сервиса:
      *                                                                      "normal" -  сервис работает нормально
      *                                                                      "system_maintenance" -  сервис на техническом обслуживании
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