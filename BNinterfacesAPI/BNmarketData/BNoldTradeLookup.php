<?php
  /**
   * BNoldTradeLookup: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения списка старых рыночных сделок сервиса Binance API.
   */  
  class BNoldTradeLookup extends BNinterfaceAPI {
     use AddAPIkey;
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/historicalTrades';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNoldTradeLookup::SendQuery($symbol)
      *                              BNoldTradeLookup::SendQuery($symbol, limit: $limit)
      *                              BNoldTradeLookup::SendQuery($symbol, fromId: $fromId)
      *                              BNoldTradeLookup::SendQuery($symbol, limit: $limit, fromId: $fromId)
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  integer  $limit             Количество старых рыночных сделок, о которых возвращается информация. 
      *                                     Если параметр не указан - возвращается информация о 500 сделках. 
      *                                     Максимальное количество сделок - 1000.
      * @param  integer  $fromId            Идентификатор сделки, начиная с которой возвращается информация. 
      *                                     Если параметр не указан - возвращается информация о самых последних сделках.
      *
      * @return array                       Массив, содержащий ассоциативные массивы с информацей 
      *                                     о старых рыночных сделках.
      *                                     Каждый из ассоциативных массивов содержит следующие элементы:
      *                                          integer   id                            Идентификатор сделки.
      *                                          string    price                         Цена сделки.
      *                                          string    qty                           Объем сделки.
      *                                          string    quoteQty                      Условная стоимость сделки.
      *                                                                                  Определяется как произведение цены на объем.
      *                                          integer   time                          Время исполнения сделки.
      *                                          bool      isBuyerMaker                  Сообщение, является ли покупатель инициатором сделки:
      *                                                                                  TRUE - является. FALSE - не является.
      *                                          bool      isBestMatch                   Сообщение, была ли сделка лучшей по цене:
      *                                                                                  TRUE - была. FALSE - не была.
      */
     static public function SendQuery($symbol = NULL, $limit = NULL, $fromId = NULL) {
        self::SaveArguments($symbol, $limit, $fromId);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  integer  $limit             Количество старых рыночных сделок, о которых возвращается информация. 
      * @param  integer  $fromId            Идентификатор сделки, начиная с которой возвращается информация. 
      */
     static protected function SaveArguments($symbol = NULL, $limit = NULL, $fromId = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol'] = $symbol;
        }
        if (!is_null($limit)) {
           self::$arguments['limit']  = $limit;
        }
        if (!is_null($fromId)) {
           self::$arguments['fromId'] = $fromId;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (count(self::$arguments) < 1 || count(self::$arguments) > 3) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое количество аргументов, переданных функции SendQuery().');
        }
        if (!is_string(self::$arguments['symbol'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента symbol, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['limit']) && !is_integer(self::$arguments['limit'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента limit, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['fromId']) && !is_integer(self::$arguments['fromId'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента fromId, переданного функции SendQuery().');
        }
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        return 5;
     }
 }
?>