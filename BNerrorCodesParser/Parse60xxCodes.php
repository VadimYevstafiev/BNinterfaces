<?php
   /**
   * Parse60xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами со сбрережениями
   */
   trait Parse60xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -60хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse60xxCodes($response) {
        switch ($response['code']) {
           case -6001:
              $this->message = 'Продукт не существует.';
              break;
           case -6003:
              $this->message = 'Продукт не существует или у вас нет разрешения.';
              break;
           case -6004:
              $this->message = 'Товар не в статусе покупки.';
              break;
           case -6005:
              $this->message = 'Меньше минимального лимита покупки.';
              break;
           case -6006:
              $this->message = 'Ошибка суммы погашения.';
              break;
           case -6007:
              $this->message = 'Не в срок выкупа.';
              break;
           case -6008:
              $this->message = 'Товар не в статусе погашения.';
              break;
           case -6009:
              $this->message = 'Слишком высокая частота запросов.';
              break;
           case -6011:
              $this->message = 'Превышение максимально допустимого количества покупок на пользователя.';
              break;
           case -6012:
              $this->message = 'Недостаточно средств на балансе.';
              break;
           case -6013:
              $this->message = 'Не удалось совершить покупку.';
              break;
           case -6014:
              $this->message = 'Превышение лимита, разрешенного для покупки.';
              break;
           case -6015:
              $this->message = 'Пустое тело запроса.';
              break;
           case -6016:
              $this->message = 'Ошибка параметра.';
              break;
           case -6017:
              $this->message = 'Нет в белом списке.';
              break;
           case -6018:
              $this->message = 'Актива недостаточно.';
              break;
           case -6019:
              $this->message = 'Нужно подтвердить.';
              break;
           case -6020:
              $this->message = 'Проект не существует.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>