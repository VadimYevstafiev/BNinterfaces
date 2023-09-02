<?php
  /**
   * BNenableFastWithdrawSwitch: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса включения возможности быстрого вывода средств (без транзакций внутри сети,
   * идентификатора транзакций и комиссии за снытие средств) из сервиса Binance API
   * Для выполнения этого запроса необходимо, чтобы была включена опция "trade" для ключа API,
   * который запрашивает эту конечную точку.
   */  
  class BNenableFastWithdrawSwitch extends BNdisableFastWithdrawSwitch {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/sapi/v1/account/disableFastWithdrawSwitch';
     /**
      * Допустимые аргументы функции BNenableFastWithdrawSwitch::SendQuery()
      *                              BNenableFastWithdrawSwitch::SendQuery($recvWindow)
      *
      * @param  integer  $recvWindow        Период (в миллисекундах), в течении которого
      *                                     запрос действителен
      *
      * Ответ, возвращаемый сервисом
      * @return bool                        TRUE - если включено
      *                                     FALSE - если не включено
      */
 }
?>

