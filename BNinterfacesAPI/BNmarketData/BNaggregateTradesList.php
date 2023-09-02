<?php
  /**
   * BNaggregateTradesList: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения списка объединенных сделок сервиса Binance API.
   * (Сделки, которые выполнены в течении 100 милисекунд по одной и той же цене,
   * объединняются и представляются как одна сделка).
   */  
  class BNaggregateTradesList extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/aggTrades';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNaggregateTradesList::SendQuery($symbol, fromId: $fromId)
      *                              BNaggregateTradesList::SendQuery($symbol, fromId: $fromId, limit: $limit)
      *                              BNaggregateTradesList::SendQuery($symbol, startTime: $startTime, endTime: $endTime)
      *                              BNaggregateTradesList::SendQuery($symbol, startTime: $startTime, endTime: $endTime, limit: $limit)
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  integer  $fromId            Идентификатор сделки, начиная с которой возвращается информация. 
      *                                     Если параметр не указан - возвращается информация о самых последних сделках.
      * @param  integer  $startTime         Стартовая временная метка в милисекундах, начиная с которой возвращается информация.
      * @param  integer  $endTime           Конечная временная метка в милисекундах, по которую включительно возвращается информация.
      *                                     Если указаны параметры $startTime и $endTime, интервал между ними должен быть менее 1 часа.
      * @param  integer  $limit             Количество объединенных сделок, о которых возвращается информация. 
      *                                     Если параметр не указан - возвращается информация о 500 сделках. 
      *
      * @return array                       Массив, содержащий ассоциативные массивы с информацей 
      *                                     об объединенных сделках.
      *                                     Каждый из ассоциативных массивов содержит следующие элементы:
      *                                          integer   a                             Идентификатор объединенных сделок.
      *                                          string    p                             Цена сделок.
      *                                          string    q                             Общий объем сделок.
      *                                          integer   f                             Идентификатор первой сделки.
      *                                          integer   l                             Идентификатор последней сделки.
      *                                          integer   T                             Время исполнения сделок.
      *                                          bool      m                             Сообщение, является ли покупатель инициатором сделки:
      *                                                                                  TRUE - является. FALSE - не является.
      *                                          bool      M                             Сообщение, была ли сделки лучшими по цене:
      *                                                                                  TRUE - была. FALSE - не была.
      */
     static public function SendQuery($symbol = NULL, $fromId = NULL, $startTime = NULL, $endTime = NULL, $limit = NULL) {
        self::SaveArguments($symbol, $fromId, $startTime, $endTime, $limit);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  integer  $fromId            Идентификатор сделки, начиная с которой возвращается информация. 
      * @param  integer  $startTime         Стартовая временная метка в милисекундах, начиная с которой возвращается информация.
      * @param  integer  $endTime           Конечная временная метка в милисекундах, по которую включительно возвращается информация.
      * @param  integer  $limit             Количество объединенных сделок, о которых возвращается информация. 
      */
     static protected function SaveArguments($symbol = NULL, $fromId = NULL, $startTime = NULL, $endTime = NULL, $limit = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol']    = $symbol;
        }
        if (!is_null($fromId)) {
           self::$arguments['fromId']    = $fromId;
        }
        if (!is_null($startTime)) {
           self::$arguments['startTime'] = $startTime;
        }
        if (!is_null($endTime)) {
           self::$arguments['endTime']   = $endTime;
        }
        if (!is_null($limit)) {
           self::$arguments['limit']     = $limit;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (count(self::$arguments) < 2 || count(self::$arguments) > 4) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое количество аргументов, переданных функции SendQuery().');
        }
        if (!is_string(self::$arguments['symbol'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента symbol, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['fromId']) && (isset(self::$arguments['startTime']) || isset(self::$arguments['endTime']))) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое сочетание аргументов, переданных функции SendQuery().');
        }
        if (isset(self::$arguments['fromId']) && !is_integer(self::$arguments['fromId'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента fromId, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['startTime']) && !is_integer(self::$arguments['startTime'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента startTime, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['endTime']) && !is_integer(self::$arguments['endTime'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента endTime, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['limit']) && !is_integer(self::$arguments['limit'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента limit, переданного функции SendQuery().');
        }
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