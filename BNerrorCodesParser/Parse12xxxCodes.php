<?php
   /**
   * Parse12xxxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с ликвидностью свопов
   */
   trait Parse12xxxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -12ххx
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse12xxxCodes($response) {
        switch ($response['code']) {
           case -12014:
              $this->message = 'Более 1 запроса за 2 секунды.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>