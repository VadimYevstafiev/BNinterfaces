<?php
   /**
   * Parse13xxxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с BLVT
   */
   trait Parse13xxxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -13ххx
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse13xxxCodes($response) {
        switch ($response['code']) {
           case -13000:
              $this->message = 'Выкуп токена сейчас запрещен.';
              break;
           case -13001:
              $this->message = 'Превышение индивидуального 24-часового лимита выкупа токена.';
              break;
           case -13002:
              $this->message = 'Превышение общего 24-часового лимита выкупа токена.';
              break;
           case -13003:
              $this->message = 'Подписка на токен сейчас запрещена.';
              break;
           case -13004:
              $this->message = 'Превышение индивидуального 24-часового лимита подписки на токены.';
              break;
           case -13005:
              $this->message = 'Превышение общего 24-часового лимита подписки на токены.';
              break;
           case -13006:
              $this->message = 'Сумма подписки слишком мала.';
              break;
           case -13007:
              $this->message = 'Соглашение не подписано.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>