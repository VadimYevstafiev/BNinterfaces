<?php
   /**
   * Parse10xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных общими проблемами с сервером или сетью 
   */
   trait Parse10xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -11хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse10xxCodes($response) {
        switch ($response['code']) {
           case -1000:
              $this->message = $this->Parse1000($response['msg']);
              break;
           case -1001:
              $this->message = 'Внутренняя ошибка; невозможно обработать Ваш запрос. Пожалуйста, попробуйте еще раз.';
              $this->code = 10;
              break;
           case -1002:
              $this->message = 'Вы не авторизованы для выполнения этого запроса.';
              break;
           case -1003:
              $this->message = $this->Parse1003($response['msg']);  //Проверен
              break;
           case -1004:
              $this->message = 'Сервер занят, подождите и повторите попытку.';
              $this->code = 10;
              break;
           case -1006:
              $this->message = 'От шины сообщений получен неожиданный ответ. Статус исполнения неизвестен.';
              break;
           case -1007:
              $this->message = 'Ожидается ответ от внутреннего сервера. Статус отправки неизвестен; статус выполнения неизвестен.';
              break;
           case -1008:
              $this->message = 'Спот-сервер в настоящее время перегружен другими запросами. Пожалуйста, повторите попытку через несколько минут.';
              $this->code = 10;
              break;
           case -1010:
              $this->message = 'Получено сообщение об ошибке сервера.';
              $this->message .= $this->ParseOrderRejectionIssues($response['msg']);
              break;
           case -1014:
              $this->message = 'Неподдерживаемая комбинация ордеров.';
              break;
           case -1015:
              $this->message = $this->Parse1015($response['msg']);
              break;
           case -1016:
              $this->message = 'Эта услуга больше недоступна.';
              break;
           case -1020:
              $this->message = 'Эта операция не поддерживается.';
              break;
           case -1021:
              $this->message = $this->Parse1021($response['msg']);  //Проверен
              break;
           case -1022:
              $this->message = 'Подпись для этого запроса недействительна.';
              break;
           case -1099:
              $this->message = 'Не найден, аутентифицирован или авторизован.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1000
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1000($message) {
        $length = strlen('An unknown error occurred while processing the request.');
        $message = substr($message, 0, $length);
        $output = 'При обработке запроса произошла неизвестная ошибка.';
        if (strlen($message) > 0) {
           $output .= $message;
        }
        return $output;
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1003
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1003($message) {
        if (str_contains($message, 'Too many requests; current request has limited.')) {  //Проверен
           return 'Слишком много запросов; текущий запрос был ограничен.';
        }
        if (str_contains($message, 'Too many requests queued.')) {
           return 'Слишком много запросов в очереди.';
        }
        if (str_contains($message, 'Way too much request weight used')) {
           list($str) = $this->GetVariableString($message);
           return 'Используется слишком большой вес запроса; IP забанен до ' . $str . '. Пожалуйста, используйте веб-сокет для оперативных обновлений, чтобы избежать банов.';
        }
        if (str_contains($message, 'Too much request weight used; please use the websocket for live updates to avoid polling the API.')) {
           return 'Используется слишком большой вес запроса; пожалуйста, используйте веб-сокет для оперативных обновлений, чтобы избежать опроса API.';
        }
        list($str1, $str2, $str3) = $this->GetVariableString($message);
        return 'Используется слишком большой вес запроса; текущий лимит составляет ' . $str1 . ' веса запроса на ' . $str2 . ' ' . $str3 . '. Пожалуйста, используйте веб-сокет для оперативных обновлений, чтобы избежать опроса API.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1015
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1015($message) {
        if (str_contains($message, 'Too many new orders; current')) {
           list($str1, $str2) = $this->GetVariableString($message);
           return 'Слишком много новых ордеров; текущий лимит составляет ' . $str1 . ' заказов на ' . $str2 . '.';
        }
        return 'Слишком много новых ордеров.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1021
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1021($message) {
        if (str_contains($message, 'Timestamp for this request is outside of the recvWindow.')) {  //Проверен
           return 'Отметка времени для этого запроса находится вне периода, определенного параметром recvWindow.';
        }
        return 'Отметка времени для этого запроса на 1000 мс опережает время сервера.';
     }
  }
?>