<?php
  /**
   * BNcurrentAveragePrice: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения текущей средней цены для символа сервиса Binance API.
   */  
  class BNcurrentAveragePrice extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/avgPrice';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNcurrentAveragePrice::SendQuery($symbol)
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      *
      * @return array                       Ассоциативный массив, содержащий элементы:
      *                                          integer   mins      Период, в минутах, за который производится усреднение цены
      *                                          string    price     Значение средней цены 
      */
     static public function SendQuery($symbol = NULL) {
        self::SaveArguments($symbol);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      */
     static protected function SaveArguments($symbol = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol'] = $symbol;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (1 != count(self::$arguments)) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое количество аргументов, переданных функции SendQuery().');
        }
        if (!is_string(self::$arguments['symbol'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента symbol, переданного функции SendQuery().');
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

