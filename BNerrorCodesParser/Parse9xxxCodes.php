<?php
   /**
   * Parse9xxxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных сбоями фильтра
   */
   trait Parse9xxxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -9xхх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse9xxxCodes($response) {
        $this->message = $response['msg'];
        switch ($response['msg']) {
           case 'Filter failure: PRICE_FILTER':
              $this->message .= 'Параметр price слишком высок, слишком низок и/или не соответствует правилу размера тика для символа.';
              break;
           case 'Filter failure: PERCENT_PRICE':
              $this->message .= 'Параметр price на X% выше или на X% ниже средневзвешенной цены за последние Y минут.';
              break;
           case 'Filter failure: PERCENT_PRICE_BY_SIDE':
              $this->message .= 'Параметр price X% слишком высок или Y% слишком низок с lastPrice этой стороны (т.е. BUY/SELL).';
              break;
           case 'Filter failure: LOT_SIZE':
              $this->message .= 'Параметр quantity ордера слишком высок, слишком низок и/или не соответствует правилу размера шага для символа.';
              break;
           case 'Filter failure: MIN_NOTIONAL':
              $this->message .= 'Условная стоимость ордера (price* quantity) меньше допустимой.';
              break;
           case 'Filter failure: ICEBERG_PARTS':
              $this->message .= 'Ордер типа ICEBERG будет разбит на слишком много частей; параметр icebergQty слишком мал.';
              break;
           case 'Filter failure: MARKET_LOT_SIZE':
              $this->message .= 'Параметр quantity ордера типа MARKET слишком высок, слишком низок и/или не соответствует правилу размера шага для символа.';
              break;
           case 'Filter failure: MAX_POSITION':
              $this->message .= 'Позиция счета достигла максимального установленного предела. Он состоит из суммы баланса базового актива и суммы количества всех открытых BUY ордеров.';
              break;
           case 'Filter failure: MAX_NUM_ALGO_ORDERS':
              $this->message .= 'На счете слишком много открытых ордеров стоп-лосс и/или тейк-профит по символу.';
              break;
           case 'Filter failure: MAX_NUM_ICEBERG_ORDERS':
              $this->message .= 'На счете слишком много открытых айсберг-ордеров по символу.';
              break;
           case 'Filter failure: TRAILING_DELTA':
              $this->message .= 'Параметр trailingDelta находится за пределами определенного диапазона фильтра для этого типа ордера.';
              break;
           case 'Filter failure: EXCHANGE_MAX_NUM_ORDERS':
              $this->message .= 'На аккаунте слишком много открытых ордеров на бирже.';
              break;
           case 'Filter failure: EXCHANGE_MAX_NUM_ALGO_ORDERS':
              $this->message .= 'На счете слишком много открытых ордеров стоп-лосс и/или тейк-профит на бирже.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>