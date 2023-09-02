<?php
  /**
   * BNorderBook: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения списка текущих ордеров сервиса Binance API.
   */  
  class BNorderBook extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/depth';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNorderBook::SendQuery($symbol)
      *                              BNorderBook::SendQuery($symbol, $limit)
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  integer  $limit             Количество ордеров, о которых возвращается информация. 
      *                                     Если параметр не указан - возвращается информация о 100 ордерах. 
      *                                     Максимальное количество ордеров - 5000. 
      *
      * @return array                       Ассоциативный массив, содержащий элементы:
      *                                          integer   lastUpdateId                  Идентификатор последнего обновления
      *                                          array     bids                          Массив, содержащий индексированные массивы с информацей 
      *                                                                                  об ордерах типа "bid".
      *                                                                                  Каждый из индексированных массивов содержит два элемента:
      *                                                                                  Первый элемент -  цена заявки.
      *                                                                                  Второй элемент -  размер лота.
      *                                          array     asks                          Массив, содержащий индексированные массивы с информацей 
      *                                                                                  об ордерах типа "ask".
      *                                                                                  Каждый из индексированных массивов содержит два элемента:
      *                                                                                  Первый элемент -  цена заявки.
      *                                                                                  Второй элемент -  размер лота.
      */
     static public function SendQuery($symbol = NULL, $limit = NULL) {
        self::SaveArguments($symbol, $limit);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  integer  $limit             Количество ордеров, о которых возвращается информация. 
      */
     static protected function SaveArguments($symbol = NULL, $limit = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol'] = $symbol;
        }
        if (!is_null($limit)) {
           self::$arguments['limit']  = $limit;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (0 == count(self::$arguments)) {
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
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        if (!isset(self::$arguments['limit']) || self::$arguments['limit'] <= 100) {
           return 1;
        }
        if (self::$arguments['limit'] <= 500) {
           return 5;
        }
        if (self::$arguments['limit'] <= 1000) {
           return 10;
        }
        if (self::$arguments['limit'] <= 5000) {
           return 50;
        }
     }
 }
?>

