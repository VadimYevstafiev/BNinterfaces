<?php
  /**
   * BNdisableFastWithdrawSwitch: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса отключения возможности быстрого вывода средств (без транзакций внутри сети,
   * идентификатора транзакций и комиссии за снытие средств) из сервиса Binance API
   */  
  class BNdisableFastWithdrawSwitch extends BNinterfaceSAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/sapi/v1/account/disableFastWithdrawSwitch';
     /**
      * Допустимые аргументы функции BNdisableFastWithdrawSwitch::SendQuery()
      *                              BNdisableFastWithdrawSwitch::SendQuery($recvWindow)
      *
      * @param  integer  $recvWindow        Период (в миллисекундах), в течении которого
      *                                     запрос действителен
      *
      * @return bool                        TRUE - если отключено
      *                                     FALSE - если не отключено
      */
     static public function SendQuery($recvWindow = NULL) {
        self::SaveArguments($recvWindow);
        return self::ExecuteSendQuery();
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
 }
?>

