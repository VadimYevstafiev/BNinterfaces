<?php
  /**
   * BNexchangeInformation: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения текущих правил биржевой торговли и информации о символах сервиса Binance API.
   */  
  class BNexchangeInformation extends BNinterfaceAPI {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/exchangeInfo';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNexchangeInformation::SendQuery()
      *                              BNexchangeInformation::SendQuery($symbol)
      *                              BNexchangeInformation::SendQuery(symbols: $symbols)
      *                              BNexchangeInformation::SendQuery(permissions: $permissions)
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      *                                     (Возвращается информация о торговой паре,
      *                                     соответствующей указанному символу)
      * @param  array    $symbols           Массив символов торговых пар.
      *                                     (Возвращается информация о торговых парах,
      *                                     соответствующих символам, указанным в массиве)
      * @param  string|array $permissions   Единичный символ или массив символов типов торгов.
      *                                     (Возвращается информация о типах торгов,
      *                                     соответствующих указанному символу или символам)
      *
      * @return array                       Ассоциативный массив, содержащий следующие элементы: 
      *                                          string    timezone                      Идентификатор часового пояса
      *                                          integer   serverTime                    Текущее время сервера в милисекундах
      *                                          array     rateLimits                    Массив с информацией об ограничениях скорости сервиса
      *                                                                                  Содержит следующие элементы:
      *                                                                                       string    rateLimitType            Тип ограничения скорости сервиса.
      *                                                                                                                          Возможные значения:
      *                                                                                                                          "REQUEST_WEIGHT" - лимит по IP
      *                                                                                                                          "ORDERS" - лимит ордеров
      *                                                                                                                          "RAW_REQUESTS" - лимит по количеству запросов
      *                                                                                       string    interval                 Единица времени для интервала ограничений скорости сервиса.
      *                                                                                                                          Возможные значения:
      *                                                                                                                          "SECOND" - секунда
      *                                                                                                                          "MINUTE" - минута
      *                                                                                                                          "HOUR"   - час
      *                                                                                                                          "DAY"    - день
      *                                                                                       integer   intervalNum              Значение интервала ограничений скорости сервиса.
      *                                                                                       integer   limit                    Значение лимита.
      *                                          array     symbols                       Массив, содержащий индексированные массивы с информацией 
      *                                                                                  о торговых парах.
      *                                                                                  Каждый из индексированных массивов содержит следующие элементы:
      *                                                                                       string    symbol                   Символ торговой пары.
      *                                                                                       string    status                   Состояние торгов по паре.
      *                                                                                                                          Возможные значения:
      *                                                                                                                          "PRE_TRADING"   -
      *                                                                                                                          "TRADING"       -
      *                                                                                                                          "POST_TRADING"  -
      *                                                                                                                          "END_OF_DAY"    -
      *                                                                                                                          "HALT"          -
      *                                                                                                                          "AUCTION_MATCH" -
      *                                                                                                                          "BREAK"         -
      *                                                                                       string    baseAsset                Символ актива, который в торговой паре выступает в качестве товара.
      *                                                                                       integer   baseAssetPrecision       Точность, с которой подсчитывается актив baseAsset.
      *                                          string    quoteAsset                    Символ актива, который в торговой паре выступает в качестве средства платежа.
      *                                          integer   quoteAssetPrecision           Точность, с которой подсчитывается актив quoteAsset.
      *                                          integer   baseCommissionPrecision       Точность, с которой подсчитывается комиссия, номинированная в активе baseAsset.
      *                                          integer   quoteCommissionPrecision      Точность, с которой подсчитывается комиссия, номинированная в активе quoteAsset.
      *                                          array     orderTypes                    Массив с типами ордеров, доступных для данной тороговой пары.
      *                                                                                  Возможные значения:
      *                                                                                  "LIMIT"             - лимитный ордер
      *                                                                                  "MARKET"            - рыночный ордер
      *                                                                                  "STOP_LOSS"         - ордер "стоп-лосс"
      *                                                                                  "STOP_LOSS_LIMIT"   - лимитный ордер "стоп-лосс"
      *                                                                                  "TAKE_PROFIT"       - ордер "тейк-профит"
      *                                                                                  "TAKE_PROFIT_LIMIT" - лимитный ордер "тейк-профит"
      *                                                                                  "LIMIT_MAKER"       - лимитный ордер-мейкер
      *                                          bool      icebergAllowed                Сообщение, допускаются ли ордера типа "Айсберг". Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          bool      ocoAllowed                    Сообщение, допускаются ли ордера типа "OCO". Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          bool      quoteOrderQtyMarketAllowed    Сообщение, допускаются ли ордера типа "Quote Order Qty". Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          bool      allowTrailingStop             Сообщение, допускаются ли трейлинг-стоп-ордера. Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          bool      cancelReplaceAllowed          Сообщение, допускается ли отмена существующего ордера и размещение
      *                                                                                  нового ордера по тому же символу. Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          bool      isSpotTradingAllowed          Сообщение, допускается ли спотовая тоговля. Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          bool      isMarginTradingAllowed        Сообщение, допускается ли маржинальная тоговля. Возможные значения:
      *                                                                                  TRUE - допускаются. FALSE - не допускаются.
      *                                          array     filters                       Массив, содержащий индексированные массивы с фильтрами, определяющими правила торговли
      *                                                                                  по торговой паре.
      *                                                                                  Массив 1:
      *                                                                                       string    filterType               Тип фильтра. Значение: "PRICE_FILTER".
      *                                                                                       string    minPrice                 Минимальное допустимое значение цены.
      *                                                                                       string    maxPrice                 Максимальное допустимое значение цены.
      *                                                                                       string    tickSize                 Минимальный шаг изменения цены.
      *                                                                                  Массив 2:
      *                                                                                       string    filterType               Тип фильтра. Значение: "PERCENT_PRICE".
      *                                                                                       string    multiplierUp             Коэффициент, во сколько раз цена может быть больше средней цены.
      *                                                                                       string    multiplierDown           Коэффициент, во сколько раз цена может быть меньше средней цены.
      *                                                                                       integer   avgPriceMins             Количество минут, за которое рассчитывается средняя цена.
      *                                                                                  Массив 3:
      *                                                                                       string    filterType               Тип фильтра. Значение: "LOT_SIZE".
      *                                                                                       string    minQty                   Минимальная сумма сделки. Номинирована в активе baseAsset.
      *                                                                                       string    maxQty                   Максимальный сумма сделки. Номинирована в активе baseAsset.
      *                                                                                       integer   stepSize                 Минимальный шаг изменения суммы сделки. Номинирована в активе baseAsset.
      *                                                                                  Массив 4:
      *                                                                                       string    filterType               Тип фильтра. Значение: "MIN_NOTIONAL".
      *                                                                                       string    minNotional              Минимально допустимая условная стоимость ордера по символу.
      *                                                                                                                          Определяется как произведение цены на объем.
      *                                                                                       bool      applyToMarket            Сообщение, применяется ли это фильтр к ордерам типа "MARKET":
      *                                                                                                                          TRUE - применяется. FALSE - не применяется.
      *                                                                                       integer   avgPriceMins             Количество минут за которые расчитывается средняя цена
      *                                                                                                                          для расчета условной стоимости ордеров типа "MARKET".
      *                                                                                  Массив 5:
      *                                                                                       string    filterType               Тип фильтра. Значение: "ICEBERG_PARTS".
      *                                                                                       string    limit                    Максимальное количество частей, которые может иметь айсберг-ордер.
      *                                                                                  Массив 6:
      *                                                                                       string    filterType               Тип фильтра. Значение: "MARKET_LOT_SIZE".
      *                                                                                       string    minQty                   Минимальный размер рыночного ордера. Номинирован в активе baseAsset.
      *                                                                                       string    maxQty                   Максимальный размер рыночного ордера.Номинирован в активе baseAsset.
      *                                                                                       integer   stepSize                 Минимальный шаг изменения размера рыночного ордера.Номинирован в активе baseAsset.
      *                                                                                  Массив 7:
      *                                                                                       string    filterType               Тип фильтра. Значение: "TRAILING_DELTA".
      *                                                                                       integer   minTrailingAboveDelta    Минимальное значение скользящей дельты выше рыночной цены.
      *                                                                                       integer   maxTrailingAboveDelta    Максимальное значение скользящей дельты выше рыночной цены.
      *                                                                                       integer   minTrailingBelowDelta    Минимальное значение скользящей дельты ниже рыночной цены.
      *                                                                                       integer   maxTrailingBelowDelta    Максимальное значение скользящей дельты ниже рыночной цены.
      *                                                                                  Массив 8:
      *                                                                                       string    filterType               Тип фильтра. Значение: "MAX_NUM_ORDERS".
      *                                                                                       integer   maxNumOrders             Максимальное количество ордеров, которое может быть открыто на счете по символу
      *                                                                                                                          на счете по символу. Учитываются как «алго»-ордера, так и обычные ордера.
      *                                                                                  Массив 9:
      *                                                                                       string       filterType            Тип фильтра. Значение: "MAX_NUM_ALGO_ORDERS".
      *                                                                                       integer      maxNumOrders          Максимальное количество "алго" ордеров, которые счет может открыть по символу.
      *                                                                                                                          "Алго" ордера - ордера типа "STOP_LOSS", "STOP_LOSS_LIMIT", "TAKE_PROFIT" и "TAKE_PROFIT_LIMIT".
      *                                          array     permissions                   Массив, содержащие допустимые типы торгов по паре:
      *                                                                                  Возможные значения:
      *                                                                                  "SPOT"              - спотовая торговля
      *                                                                                  "MARGIN"            - маржинальная торговля
      *                                                                                  "LEVERAGED"         - 
      *                                                                                  "TRD_GRP_002"       - 
      *                                                                                  "TRD_GRP_003"       - 
      *                                                                                  "TRD_GRP_004"       - 
      *                                                                                  "TRD_GRP_005"       - 
      */
     static public function SendQuery($symbol = NULL, $symbols = NULL, $permissions = NULL) {
        self::SaveArguments($symbol, $symbols, $permissions);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $symbol            Единичный символ торговой пары. 
      * @param  array    $symbols           Массив символов торговых пар.
      * @param  string   $permission        Единичный символ типа торгов.
      * @param  array    $permission        Массив символов типов торгов.
      */
     static protected function SaveArguments($symbol = NULL, $symbols = NULL, $permissions = NULL) {
        if (!is_null($symbol)) {
           self::$arguments['symbol']      = $symbol;
        }
        if (!is_null($symbols)) {
           self::$arguments['symbols']     = $symbols;
        }
        if (!is_null($permissions)) {
           self::$arguments['permissions'] = $permissions;
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
        if (isset(self::$arguments['permissions']) && (!is_string(self::$arguments['permissions']) && !is_array(self::$arguments['permissions']))) {
              throw new BNinterfaceException(get_called_class(),
                                             'Недопустимый тип аргумента permissions, переданного функции SendQuery().');

        }
        if (is_array(self::$arguments['permissions'])) {
           if (!$this::CheckArrayElementsType(self::$arguments['permissions'], 'string')) {
               throw new BNinterfaceException(get_called_class(),
                                             'Недопустимый тип одного из элементов аргумента permissions, переданного функции SendQuery().');
           }
        }
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        return 10;
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