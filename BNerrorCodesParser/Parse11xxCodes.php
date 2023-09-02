<?php
   /**
   * Parse11xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных общими проблемами с запросом
   */
   trait Parse11xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -11хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse11xxCodes($response) {
        switch ($response['code']) {
           case -1100:
              $this->message = $this->Parse1100($response['msg']);  //Проверен
              break;
           case -1101:
              $this->message = $this->Parse1101($response['msg']);  //Проверен
              break;
           case -1102:
              $this->message = $this->Parse1102($response['msg']);  //Проверен
              break;
           case -1103:
              $this->message = 'Был отправлен неизвестный параметр.';
              break;
           case -1104:
              $this->message = $this->Parse1104($response['msg']);  //Проверен
              break;
           case -1105:
              $this->message = $this->Parse1105($response['msg']);  //Проверен
              break;
           case -1106:
              $this->message = $this->Parse1106($response['msg']);
              break;
           case -1111:
              $this->message = 'Точность превышает максимальное значение, установленное для этого актива.';
              break;
           case -1112:
              $this->message = 'Нет ордеров для этого символа.';
              break;
           case -1114:
              $this->message = 'Параметр TimeInForce был отправляен, когда он не требовался.';
              break;
           case -1115:
              $this->message = 'Недопустимое значение параметра TimeInForce.';
              break;
           case -1116:
              $this->message = 'Недопустимое значение параметра orderType.';
              break;
           case -1117:
              $this->message = 'Недопустимая сторона.';
              break;
           case -1118:
              $this->message = 'Новый идентификатор ордера клиента был пуст.';
              break;
           case -1119:
              $this->message = 'Исходный идентификатор ордера клиента был пуст.';
              break;
           case -1120:
              $this->message = 'Недопустимое значение интервала.';
              break;
           case -1121:
              $this->message = 'Недопустимое значение символа.'; //Проверен
              break;
           case -1125:
              $this->message = 'Параметр listenKey не был создан.';
              break;
           case -1127:
              $this->message = $this->Parse1127($response['msg']); //Проверен
              break;
           case -1128:
              $this->message = 'Недопустимая комбинация необязательных параметров.'; //Проверен
              break;
           case -1130:
              $this->message = $this->Parse1130($response['msg']);
              break;
           case -1131:
              $this->message = 'Значение параметра recvWindow должно быть меньше 60000.';
              break;
           case -1134:
              $this->message = 'Значение параметра StrategyType меньше 1000000.';
              break;
           case -1139:
              $this->message = 'Недопустимый тип тикера.';  //Проверен
              break;
           case -1141:
              $this->message = 'Недопустимый тип торгов.';  //Проверен
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1100
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1100($message) {
        if (str_contains($message, 'Illegal characters found in a parameter.')) {
           $length = strlen('Illegal characters found in a parameter.');
           $message = substr($message, 0, $length);
           $output = 'В параметре обнаружены недопустимые символы.';
           if (strlen($message) > 0) {
              $output .= $message;
           }
           return $output;
        }
        list($str1, $str2) = $this->GetVariableString($message);   //Проверен
        return 'Параметр ' . $str1 . ' имеет недопустимое значение; допустимый диапазон - ' . $str2 . '.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1101
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1101($message) {
        if (str_contains($message, 'Too many parameters sent for this endpoint.')) {
           return 'Для этой конечной точки отправлено слишком много параметров.';
        }
        if (str_contains($message, 'Duplicate values for parameter')) {   //Проверен
           list($str) = $this->GetVariableString($message);
           return 'Обнаружены повторяющиеся значения параметра ' . $str . '.';
        }
        if (str_contains($message, 'Too many parameters; expected')) {   //Проверен
           list($str1, $str2) = $this->GetVariableString($message);
           return 'Слишком много параметров; ожидалось ' . $str1 . ', а получено ' . $str2 . '.';
        }
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1102
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1102($message) {
        if (str_contains($message, 'A mandatory parameter was not sent, was empty/null, or malformed.')) {
           return 'Обязательный параметр не был отправлен, был пустым/нулевым или имел неправильный формат.';
        }
        if (str_contains($message, 'Mandatory parameter')) {
           list($str) = $this->GetVariableString($message);
           return 'Обязательный параметр ' . $str . ' не был отправлен, был пуст/нулевой или имел неверный формат.';  //Проверен
        }
        list($str1, $str2) = $this->GetVariableString($message);
        return 'Параметры ' . $str1 . ' или ' . $str2 . ' должны были быть отправлены, но оба были пустыми/нулевыми!';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1104
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1104($message) {
        if (str_contains($message, 'Not all sent parameters were read; read')) {
           list($str1, $str2) = $this->GetVariableString($message);
           return 'Не все отправленные параметры были прочитаны; прочитано ' . $str1 . ' параметров из ' . $str2 . ' отправленных.';  //Проверен
        }
        return 'Не все отправленные параметры были прочитаны.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1105
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1105($message) {
        if (str_contains($message, 'A parameter was empty.')) {
           return 'Параметр пуст.';
        }
        list($str) = $this->GetVariableString($message);    //Проверен
        return 'Параметр ' . $str . ' пуст.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1106
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1106($message) {
        if (str_contains($message, 'A parameter was sent when not required.')) {
           return 'Параметр был отправлен, когда он не требовался.';
        }
        list($str) = $this->GetVariableString($message);
        return 'Параметр ' . $str . ' был отправлен, когда он не требовался.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1127
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1127($message) {
        if (str_contains($message, 'Lookup interval is too big.')) {
           return 'Интервал поиска слишком велик.';
        }
        list($str) = sscanf($message, 'More than %s hours between startTime and endTime.');  //Проверен
        $format = 'Разница между значениями параметров startTime и endTime превышает %s часов.';
        return sprintf($format, $str);
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -1130
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse1130($message) {
        if (str_contains($message, 'Invalid data sent for a parameter.')) {
           return 'Отправлено неверное значение параметра.';
        }
        list($str) = $this->GetVariableString($message);
        return 'Отправлено неверное значение параметра ' . $str . '.';
     }
  }
?>