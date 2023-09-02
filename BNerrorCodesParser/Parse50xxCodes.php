<?php
   /**
   * Parse50xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами, связанными с SAPI
   */
   trait Parse50xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -50хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse50xxCodes($response) {
        switch ($response['code']) {
           case -5001:
              $this->message = 'Не разрешен перевод в микроактивы.';
              break;
           case -5002:
              $this->message = 'У вас недостаточно средств на балансе.';
              break;
           case -5003:
              $this->message = 'У вас нет этого актива.';
              break;
           case -5004:
              $this->message = $this->Parse5004($response['msg']);
              break;
           case -5005:
              $this->message = $this->Parse5005($response['msg']);
              break;
           case -5006:
              $this->message = 'Допускается только один трансфер в течении 24 часов.';
              break;
           case -5007:
              $this->message = 'Объем должен быть больше нуля.';
              break;
           case -5008:
              $this->message = 'Недостаточный объем возвратных активов.';
              break;
           case -5009:
              $this->message = 'Продукт не существует.';
              break;
           case -5010:
              $this->message = 'Не удалось передать актив.';
              break;
           case -5011:
              $this->message = 'Фьючерсный аккаунт не существует.';  //Проверен
              break;
           case -5012:
              $this->message = 'Передача активов находится на рассмотрении.';
              break;
           case -5021:
              $this->message = 'Этот родительский элемент не имеет отношения.';
              break;
           case -5022:
              $message = 'Фьючерсный аккаунт или подчиненное отношение не существуют.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -5004
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse5004($message) {
        if (str_contains($message, 'The residual balances have exceeded 0.001BTC, Please re-choose.')) {
           return 'Остаток на балансе превышает 0.001BTC. Пожалуйста, выберите еще раз.';
        }
        list($str) = $this->GetVariableString($message);
        return 'Остаток на балансе ' . $str . ' превышает 0.001BTC.  Пожалуйста, выберите еще раз.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -5005
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse5005($message) {
        if (str_contains($message, 'The residual balances of the BTC is too low')) {
           return 'Остаток на балансе слишком мал.';
        }
        list($str) = $this->GetVariableString($message);
        return 'Остаток на балансе ' . $str . ' слишком мал. Пожалуйста, выберите еще раз.';
     }
  }
?>