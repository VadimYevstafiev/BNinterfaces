<?php
  /**
   * BNcandlestickData: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения данных для свечных/столбиковых графиков сервиса Binance API.
   */  
  class BNcandlestickData extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/klines';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNcandlestickData::SendQuery($symbol, $interval)
      *                              BNcandlestickData::SendQuery($symbol, $interval, startTime: $startTime, endTime: $endTime)
      *                              BNcandlestickData::SendQuery($symbol, $interval, startTime: $startTime, endTime: $endTime, limit: $limit)
      *                              BNcandlestickData::SendQuery($symbol, $interval, limit: $limit)
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  string   $interval          Интервал графика. Допустимые значения:
      *                                     '1s'  - 1 секунда;
      *                                     '1m'  - 1 минута;
      *                                     '3m'  - 3 минуты;
      *                                     '5m'  - 5 минут;
      *                                     '15m' - 15 минут;
      *                                     '30m' - 30 минут;
      *                                     '1h'  - 1 час;
      *                                     '2h'  - 2 часа;
      *                                     '4h'  - 4 часа;
      *                                     '6h'  - 6 часов;
      *                                     '8h'  - 8 часов;
      *                                     '12h' - 12 часов;
      *                                     '1d'  - 1 день;
      *                                     '3d'  - 1 дня;
      *                                     '1w'  - 1 неделя;
      *                                     '1M'  - 1 месяц.
      * @param  integer  $startTime         Стартовая временная метка в милисекундах, начиная с которой возвращается информация.
      * @param  integer  $endTime           Конечная временная метка в милисекундах, по которую включительно возвращается информация.
      *                                     Если параметры $startTime и $endTime не указаны - возвращается информация о самых последних
      *                                     временных интервалах.
      * @param  integer  $limit             Количество временных интервалов, о которых возвращается информация. 
      *                                     Если параметр не указан - возвращается информация о 500 интервалах. 
      *                                     Максимальное количество интервалов - 1000. 
      *
      * @return array                       Массив, содержащий индексированные массивы с информацей 
      *                                     о свечах. Свечи идентифицируются по времени открытия.
      *                                     Каждый из индексированных массивов содержит следующие элементы:
      *                                          integer                                 Время открытия для свечи.
      *                                          string                                  Цена открытия.
      *                                          string                                  Самая высокая цена.
      *                                          string                                  Самая низкая цена.
      *                                          string                                  Цена закрытия.
      *                                          string                                  Объем торгов.
      *                                          integer                                 Время закрытия для свечи.
      *                                          string                                  Объем актива, который в торговой паре
      *                                                                                  выступает в качестве средства платежа.
      *                                          integer                                 Количество сделок.
      *                                          string                                  Выкупленный тейкером объем актива, который в торговой паре
      *                                                                                  выступает в качестве товара.
      *                                          string                                  Выкупленный тейкером объем актива, который в торговой паре
      *                                                                                  выступает в качестве средства платежа.
      *                                          string                                  Неиспользуемое поле (игнорируется).
      */
     static public function SendQuery($symbol = NULL, $interval = NULL, $startTime = NULL, $endTime = NULL, $limit = NULL) {
        self::SaveArguments($symbol, $interval, $startTime, $endTime, $limit);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Символ торговой пары, по которой запрашивается информация
      * @param  string   $interval          Интервал графика.
      * @param  integer  $startTime         Стартовая временная метка в милисекундах, начиная с которой возвращается информация.
      * @param  integer  $endTime           Конечная временная метка в милисекундах, по которую включительно возвращается информация.
      * @param  integer  $limit             Количество временных интервалов, о которых возвращается информация. 
      */
     static protected function SaveArguments($symbol = NULL, $interval = NULL, $startTime = NULL, $endTime = NULL, $limit = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol']    = $symbol;
        }
        if (!is_null($interval)) {
           self::$arguments['interval']  = $interval;
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
        if (count(self::$arguments) < 2) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое количество аргументов, переданных функции SendQuery().');
        }
        if (!is_string(self::$arguments['symbol'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента symbol, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['interval']) 
            && !in_array(self::$arguments['interval'], array('1s', '1m', '3m', '5m', '15m', '30m', '1h', '2h', '4h', '6h', '8h', '12h', '1d', '3d', '1w', '1M'))) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента interval, переданного функции SendQuery().');
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