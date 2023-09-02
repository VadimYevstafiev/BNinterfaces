<?php
  /**
   * BNrollingWindowPriceChangeStatistics: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения cтатистики изменения цен за последний произвольный период времени сервиса Binance API.
   */  
  class BNrollingWindowPriceChangeStatistics extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/ticker';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNrollingWindowPriceChangeStatistics::SendQuery($symbol)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery($symbol, windowSize: $windowSize)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery($symbol, type: $type)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery($symbol, windowSize: $windowSize, type: $type)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery(symbols: $symbols)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery(symbols: $symbols, windowSize: $windowSize)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery(symbols: $symbols, type: $type)
      *                              BNrollingWindowPriceChangeStatistics::SendQuery(symbols: $symbols, windowSize: $windowSize, type: $type)
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      *                                     (Возвращается информация о торговой паре,
      *                                     соответствующей указанному символу)
      * @param  array    $symbols           Массив символов торговых пар.
      *                                     (Возвращается информация о торговых парах,
      *                                     соответствующих символам, указанным в массиве)
      * @param  string   $windowSize 	    Определяет величину периода, за который возвращается
      *                                     информация.
      *                                     Возможные значения:
      *                                     1m,2m....59m - для минут;
      *                                     1h, 2h....23h - для часов;
      *                                     1d...7d - для дней.
      *                                     По умолчанию - 1d.
      * @param  string   $type              Определяет формат возвращаемой информации.
      *                                     Возможные значения: 'FULL' или 'MINI'.
      *                                     По умолчанию - 'FULL'.
      *
      * @return array                       Ассоциативный массив или массив ассоциативных массивов, содержащие элементы:
      *                                     В формате FULL
      *                                          string    symbol              Символ торговой пары, по которой предоставляется информация
      *                                          string    priceChange         Абсолютное изменение цены за указанный период времени
      *                                          string    priceChangePercent  Относительное изменение цены за указанный период времени в процентах
      *                                          string    weightedAvgPrice    Отношение quoteVolume / volume
      *                                          string    openPrice           Цена первой сделки за указанный период времени
      *                                          string    highPrice           Самая высокая цена за указанный период времени
      *                                          string    lowPrice            Самая низкая цена за указанный период времени
      *                                          string    lastPrice           Цена последней сделки за указанный период времени
      *                                          string    volume              Общий объем сделок за указанный период времени
      *                                          string    quoteVolume         Сумма произведений (price * volume) для всех сделок
      *                                                                        за указанный период времени
      *                                          integer  openTime             Время первой сделки за указанный период времени
      *                                          integer  closeTime            Время последней сделки за указанный период времени
      *                                          integer  firstId              Идентификатор первой сделки за указанный период времени
      *                                          integer  lastId               Идентификатор последней сделки за указанный период времени
      *                                          integer  count                Идентификатор последней сделки за указанный период времени
      *                                     В формате MINI
      *                                          string    symbol              Символ торговой пары, по которой предоставляется информация
      *                                          string    openPrice           Цена первой сделки за указанный период времени
      *                                          string    highPrice           Самая высокая цена за указанный период времени
      *                                          string    lowPrice            Самая низкая цена за указанный период времени
      *                                          string    lastPrice           Цена последней сделки за указанный период времени
      *                                          string    volume              Общий объем сделок за указанный период времени
      *                                          string    quoteVolume         Сумма произведений (price * volume) для всех сделок
      *                                                                        за указанный период времени
      *                                          integer  openTime             Время первой сделки за указанный период времени
      *                                          integer  closeTime            Время последней сделки за указанный период времени
      *                                          integer  firstId              Идентификатор первой сделки за указанный период времени
      *                                          integer  lastId               Идентификатор последней сделки за указанный период времени
      *                                          integer  count                Идентификатор последней сделки за указанный период времени
      */
     static public function SendQuery($symbol = NULL, $symbols = NULL, $windowSize = NULL, $type = NULL) {
        self::SaveArguments($symbol, $symbols, $windowSize, $type);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      * @param  array    $symbols           Массив символов торговых пар.
      * @param  string   $windowSize 	    Определяет величину периода, за который возвращается
      *                                     информация.
      * @param  string   $type              Определяет формат возвращаемой информации.
      */
     static protected function SaveArguments($symbol = NULL, $symbols = NULL, $windowSize = NULL, $type = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol']     = $symbol;
        }
        if (!is_null($symbols)) {
           self::$arguments['symbols']    = $symbols;
        }
        if (!is_null($windowSize)) {
           self::$arguments['windowSize'] = $windowSize;
        }
        if (!is_null($type)) {
           self::$arguments['type']       = $type;
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
        if (isset(self::$arguments['windowSize']) && (0 == preg_match('/^([1-9]m|[1-5][0-9]m|[1-9]h|1[0-9]h|2[0-3]h|[1-7]d)$/', self::$arguments['windowSize']))) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое значение аргумента windowSize, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['type']) && !in_array(self::$arguments['type'], array('FULL', 'MINI'))) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое значение аргумента type, переданного функции SendQuery().');
        }
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        if (isset(self::$arguments['symbol'])) {
           return 2;
        }
        if (isset(self::$arguments['symbols'])) {
           $count = count(self::$arguments['symbols']);
           if ($count < 50) {
              return $count * 2;
           }
        }
        return 100;
     }
 }
?>