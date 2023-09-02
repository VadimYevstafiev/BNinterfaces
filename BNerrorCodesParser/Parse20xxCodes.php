<?php
   /**
   * Parse20xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных общими проблемами с запросом
   */
   trait Parse20xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -20хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse20xxCodes($response) {
        switch ($response['code']) {
           case -2010:
              $this->message = 'Получено сообщение об ошибке при отклонении нового ордера.';
              $this->message .= $this->ParseOrderRejectionIssues($response['msg']);
              break;
           case -2011:
              $this->message = 'Получено сообщение об ошибке при отмене отклонения ордера.';
              $this->message .= $this->ParseOrderRejectionIssues($response['msg']);
              break;
           case -2013:
              $this->message = 'Ордер не существует.';
              break;
           case -2014:
              $this->message = 'Недопустимый формат API-ключа.'; //Проверен
              break;
           case -2015:
              $this->message = 'Недопустимые API-ключ, IP или право доступа.'; //Проверен
              break;
           case -2016:
              $this->message = 'Не удалось найти торговое окно для символа. Вместо этого попробуйте ticker/24hrs.';
              break;
           case -2021:
              $this->message = 'Команда отменить-заменить ордер выполнена частично неудачно.';
              $this->message .= $this->ParseOrderRejectionIssues($response['msg']);
              break;
           case -2022:
              $this->message = 'Команда отменить-заменить ордер выполнена неудачно.';
              $this->message .= $this->ParseOrderRejectionIssues($response['msg']);
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>