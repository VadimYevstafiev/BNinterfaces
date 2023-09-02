<?php
  /**
   * BNsymbolPriceTicker: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения последней цены для торговой пары или группы торговых пар
   * сервиса Binance API.
   */  
  class BNsymbolPriceTicker extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/ticker/price';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNsymbolPriceTicker::SendQuery()
      *                              BNsymbolPriceTicker::SendQuery($symbol)
      *                              BNsymbolPriceTicker::SendQuery(symbols: $symbols)
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      *                                     (Возвращается информация о торговой паре,
      *                                     соответствующей указанному символу)
      * @param  array    $symbols           Массив символов торговых пар.
      *                                     (Возвращается информация о торговых парах,
      *                                     соответствующих символам, указанным в массиве)
      *
      * @return array                       Ассоциативный массив или массив ассоциативных массивов, содержащие элементы:
      *                                          string    symbol              Символ торговой пары, по которой предоставляется информация
      *                                          string    price               Последняя цена

      */
     static public function SendQuery($symbol = NULL, $symbols = NULL) {
        self::SaveArguments($symbol, $symbols);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      * @param  array    $symbols           Массив символов торговых пар.
      */
     static protected function SaveArguments($symbol = NULL, $symbols = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol']  = $symbol;
        }
        if (!is_null($symbols)) {
           self::$arguments['symbols'] = $symbols;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (count(self::$arguments) > 1) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое количество аргументов, переданных функции SendQuery().');
        }
        if (isset(self::$arguments['symbol']) && !is_string(self::$arguments['symbol'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента symbol, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['symbols']) && is_array(self::$arguments['symbols'])) {
           if (!$this::CheckArrayElementsType(self::$arguments['symbols'], 'string')) {
              throw new BNinterfaceException(get_called_class(),
                                             'Недопустимый тип одного из элементов аргумента symbols, переданного функции SendQuery().');
           }
        }
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        if (isset(self::$arguments['symbol'])) {
           return 1;
        }
        return 2;
     }
     /**
      * Конструктор строки запроса
      *
      * @return string                  Строка запроса 
      */
     protected function ConstructQueryString(){
        if (count(self::$arguments) > 0) {
           return self::$arguments;
        }
     }
 }
?>