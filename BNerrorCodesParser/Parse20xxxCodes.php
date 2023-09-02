<?php
   /**
   * Parse20xxxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с фьючерсами Algo
   */
   trait Parse20xxxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -20ххx
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse20xxxCodes($response) {
        switch ($response['code']) {
           case -20121:
              $this->message = 'Недопустимый символ.';
              break;
           case -20124:
              $this->message = 'Неверный идентификатор Algo или он был завершен.';
              break;
           case -20130:
              $this->message = 'Для параметра отправлены неверные данные.';
              break;
           case -20132:
              $this->message = 'Идентификатор клиента Algo дублируется.';
              break;
           case -20194:
              $this->message = 'Продолжительность слишком мала для выполнения всего необходимого объема.';
              break;
           case -20195:
              $this->message = 'Общий размер слишком мал.';
              break;
           case -20196:
              $this->message = 'Общий размер слишком велик.';
              break;
           case -20198:
              $this->message = 'Достигнуто максимально допустимое количество открытых ордеров.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>