<?php
   /**
   * Parse40xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами, связанными с SAPI
   */
   trait Parse40xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -40хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse40xxCodes($response) {
        switch ($response['code']) {
           case -4001:
              $this->message = 'Недопустимая операция.';
              break;
           case -4002:
              $this->message = 'Неверное получение.';
              break;
           case -4003:
              $this->message = 'Введенный Вами адрес электронной почты недействителен.';
              break;
           case -4004:
              $this->message = 'Вы не вошли или не авторизовались.';
              break;
           case -4005:
              $this->message = 'Слишком много новых запросов.';
              break;
           case -4006:
              $this->message = 'Поддержка только основной учетной записи.';
              break;
           case -4007:
              $this->message = 'Проверка адреса не пройдена.';
              break;
           case -4008:
              $this->message = 'Проверка адресной метки не пройдена.';
              break;
           case -4010:
              $this->message = 'Подтверждено,что электронная почта из белого списка.';
              break;
           case -4011:
              $this->message = 'Не подтверждено,что электронная почта из белого списка.';
              break;
           case -4012:
              $this->message = 'Белый список не открывается.';
              break;
           case -4013:
              $this->message = '2FA не открывается.';
              break;
           case -4014:
              $this->message = 'В течение 2 минут после входа в систему вывод средств запрещен.';
              break;
           case -4015:
              $this->message = 'Вывод ограничен.';
              break;
           case -4016:
              $this->message = 'В течение 24 часов после смены пароля вывод средств запрещен.';
              break;
           case -4017:
              $this->message = 'В течение 24 часов после релиза 2FA вывод средств запрещен.';
              break;
           case -4018:
              $this->message = 'У нас нет этого актива.';
              break;
           case -4019:
              $this->message = 'Текущий актив не открыт для вывода.';
              break;
           case -4021:
              $this->message = $this->Parse4021($response['msg']);
              break;
           case -4022:
              $this->message = $this->Parse4022($response['msg']);
              break;
           case -4023:
              $this->message = 'Сумма вывода активов в течение 24 часов превышает минимально допустимую сумму.';
              break;
           case -4024:
              $this->message = 'У нас нет этого актива.';
              break;
           case -4025:
              $this->message = 'Количество удерживаемых активов меньше нуля.';
              break;
           case -4026:
              $this->message = 'У вас недостаточно средств на балансе.';
              break;
           case -4028:
              $this->message = 'Сумма вывода должна быть больше размера комиссии.';
              break;
           case -4029:
              $this->message = 'Записи о снятии не существует.';
              break;
           case -4030:
              $this->message = 'Подтверждение успешного вывода активов.';
              break;
           case -4031:
              $this->message = 'Отмена не удалась.';
              break;
           case -4032:
              $this->message = 'Отменить исключение проверки.';
              break;
           case -4033:
              $this->message = 'Незаконный адрес.';
              break;
           case -4034:
              $this->message = 'Адрес подозревается в подделке.';
              break;
           case -4035:
              $this->message = 'Этот адрес не входит в белый список. Пожалуйста, присоединитесь и попробуйте еще раз.';
              break;
           case -4035:
              $this->message = 'Этот адрес не входит в белый список. Пожалуйста, присоединитесь и попробуйте еще раз.';
              break;
           case -4036:
              $this->message = $this->Parse4036($response['msg']);
              break;
           case -4037:
              $this->message = 'Повторная отправка почты не удалась.';
              break;
           case -4038:
              $this->message = 'Повторите попытку через 5 минут.';
              break;
           case -4039:
              $this->message = 'Пользователь не существует.';
              break;
           case -4040:
              $this->message = 'Этот адрес не взимается.';
              break;
           case -4041:
              $this->message = 'Повторите попытку через одну минуту.';
              break;
           case -4042:
              $this->message = 'Этот актив не может снова получить депозитный адрес.';
              break;
           case -4043:
              $this->message = 'За 24 часа было использовано более 100 адресов пополнения.';
              break;
           case -4044:
              $this->message = 'Эта страна из черного списка.';
              break;
           case -4045:
              $this->message = 'Невозможно приобрести активы.';
              break;
           case -4046:
              $this->message = 'Соглашение не подтверждено.';
              break;
           case -4047:
              $this->message = 'Интервал времени должен быть в пределах 0–90 дней.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }

     }
     /**
      * Функция разбора сообщения об ошибке с кодом -4021
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse4021($message) {
        list($str1, $str2) = $this->GetVariableString($message);
        return 'Вывод активов должен быть ' . $str1 . ' кратным ' . $str2 . '.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -4022
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse4022($message) {
        list($str) = $this->GetVariableString($message);
        return 'Сумма вывода активов не должна быть меньше минимально допустимой суммы, равной ' . $str . '.';
     }
     /**
      * Функция разбора сообщения об ошибке с кодом -4022
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function Parse4036($message) {
        //'The new address needs to be withdrawn in {0} hours.'
        $message = substr($message, 0, 41);
        $message = substr($message, 0, -7);
        return 'Новый адрес необходимо отозвать через ' . $message . ' часов.';
     }
  }
?>