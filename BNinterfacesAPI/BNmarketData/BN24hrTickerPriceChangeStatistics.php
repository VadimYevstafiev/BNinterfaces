<?php
  /**
   * BN24hrTickerPriceChangeStatistics: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения cтатистики изменения цен за последние 24 часа сервиса Binance API.
   * (Необходимо быть осторожным при обращении к этому сервису без указания символа).
   */  
  class BN24hrTickerPriceChangeStatistics extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/ticker/24hr';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BN24hrTickerPriceChangeStatistics::SendQuery()
      *                              BN24hrTickerPriceChangeStatistics::SendQuery($symbol)
      *                              BN24hrTickerPriceChangeStatistics::SendQuery($symbol, type: $type)
      *                              BN24hrTickerPriceChangeStatistics::SendQuery(symbols: $symbols)
      *                              BN24hrTickerPriceChangeStatistics::SendQuery(symbols: $symbols, type: $type)
      *                              BN24hrTickerPriceChangeStatistics::SendQuery(type: $type)
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      *                                     (Возвращается информация о торговой паре,
      *                                     соответствующей указанному символу)
      * @param  array    $symbols           Массив символов торговых пар.
      *                                     (Возвращается информация о торговых парах,
      *                                     соответствующих символам, указанным в массиве)
      * @param  string   $type              Определяет формат возвращаемой информации.
      *                                     Возможные значения: 'FULL' или 'MINI'.
      *                                     По умолчанию - 'FULL'.
      *
      * @return array                       Ассоциативный массив или массив ассоциативных массивов, содержащие элементы:
      *                                     В формате FULL
      *                                          string    symbol              Символ торговой пары, по которой предоставляется информация
      *                                          string    priceChange         Абсолютное изменение цены за 24 часа
      *                                          string    priceChangePercent  Относительное изменение цены за 24 часа в процентах
      *                                          string    weightedAvgPrice    Отношение quoteVolume / volume
      *                                          string    prevClosePrice      Цена закрытия предыдущего временного интервала
      *                                          string    lastPrice           Цена последней сделки за 24 часа
      *                                          string    lastQty             Сумма последней сделки за 24 часа
      *                                          string    bidPrice            Цена последней сделки типа "bid" за 24 часа
      *                                          string    bidQty              Сумма последней сделки типа "bid" за 24 часа
      *                                          string    askPrice            Цена последней сделки типа "ask" за 24 часа
      *                                          string    askQty              Сумма последней сделки типа "ask" за 24 часа
      *                                          string    openPrice           Цена первой сделки за последние 24 часа
      *                                          string    highPrice           Самая высокая цена за последние 24 часа
      *                                          string    lowPrice            Самая низкая цена за последние 24 часа
      *                                          string    volume              Общий объем сделок за последние 24 часа
      *                                          string    quoteVolume         Сумма произведений (price * volume) для всех сделок
      *                                                                        за последние 24 часа
      *                                          integer   openTime            Время первой сделки за последние 24 часа
      *                                          integer   closeTime           Время последней сделки за последние 24 часа
      *                                          integer   firstId             Идентификатор первой сделки за последние 24 часа
      *                                          integer   lastId              Идентификатор последней сделки за последние 24 часа
      *                                          integer   count               Идентификатор последней сделки за последние 24 часа
      *
      *                                     В формате MINI
      *                                          string    symbol              Символ торговой пары, по которой предоставляется информация
      *                                          string    openPrice           Цена первой сделки за последние 24 часа
      *                                          string    highPrice           Самая высокая цена за последние 24 часа
      *                                          string    lowPrice            Самая низкая цена за последние 24 часа
      *                                          string    lastPrice           Цена последней сделки за 24 часа
      *                                          string    volume              Общий объем сделок за последние 24 часа
      *                                          string    quoteVolume         Сумма произведений (price * volume) для всех сделок
      *                                                                        за последние 24 часа
      *                                          integer   openTime            Время первой сделки за последние 24 часа
      *                                          integer   closeTime           Время последней сделки за последние 24 часа
      *                                          integer   firstId             Идентификатор первой сделки за последние 24 часа
      *                                          integer   lastId              Идентификатор последней сделки за последние 24 часа
      *                                          integer   count               Идентификатор последней сделки за последние 24 часа
      */
     static public function SendQuery($symbol = NULL, $symbols = NULL, $type = NULL) {
        self::SaveArguments($symbol, $symbols, $type);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      * @param  array    $symbols           Массив символов торговых пар.
      * @param  string   $type              Определяет формат возвращаемой информации.
      */
     static protected function SaveArguments($symbol = NULL, $symbols = NULL, $type = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol']  = $symbol;
        }
        if (!is_null($symbols)) {
           self::$arguments['symbols'] = $symbols;
        }
        if (!is_null($type)) {
           self::$arguments['type']    = $type;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (count(self::$arguments) > 2) {
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
           return 1;
        }
        if (isset(self::$arguments['symbols'])) {
           $count = count(self::$arguments['symbols']);
           if ($count <= 20) {
              return 1;
           } else if ($count <= 100) {
              return 20;
           } else {
              return 40;
           }
        }
        return 40;
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