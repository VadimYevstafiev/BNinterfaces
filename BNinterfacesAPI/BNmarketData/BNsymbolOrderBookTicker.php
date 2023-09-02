<?php
  /**
   * BNsymbolOrderBookTicker: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса получения цены и объема в наиболее привлекательной заявке в книге ордеров
   * для торговой пары или группы торговых парсервиса Binance API.
   */  
  class BNsymbolOrderBookTicker extends BNsymbolPriceTicker {
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/api/v3/ticker/bookTicker';
     /**
      * Функция отправки запроса и обработки ответа
      * Допустимые аргументы функции BNsymbolOrderBookTicker::SendQuery()
      *                              BNsymbolOrderBookTicker::SendQuery($symbol)
      *                              BNsymbolOrderBookTicker::SendQuery(symbols: $symbols)
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
      *                                          string    bidPrice            Цена в наиболее привлекательной заявке типа "bid"
      *                                          string    bidQty              Сумма в наиболее привлекательной заявке "bid"
      *                                          string    askPrice            Цена в наиболее привлекательной заявке типа "ask"
      *                                          string    askQty              Сумма в наиболее привлекательной заявке типа "ask"
      */
 }
?>