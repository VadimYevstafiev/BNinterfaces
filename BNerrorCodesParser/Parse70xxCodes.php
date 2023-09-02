<?php
   /**
   * Parse70xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с фьючерсами
   */
   trait Parse70xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -70хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse70xxCodes($response) {
        switch ($response['code']) {
           case -7001:
              $this->message = 'Диапазон дат не поддерживается.';
              break;
           case -7002:
              $this->message = 'Тип запроса данных не поддерживается.';
              break;  
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);        
        }
     }
  }
?>