<?php
   /**
   * Parse10xxxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с перекрестным обеспечением фьючерсов
   */
   trait Parse10xxxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -10ххx
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse10xxxCodes($response) {
        switch ($response['code']) {
           case -10017:
              $this->message = 'Сумма погашения не должна быть больше суммы долга.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>