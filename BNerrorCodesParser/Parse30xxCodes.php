<?php
   /**
   * Parse30xxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами, связанными с SAPI
   */
   trait Parse30xxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -30хх
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse30xxCodes($response) {
        switch ($response['code']) {
           case -3000:
              $this->message = 'Внутренняя ошибка сервера.';
              $this->code = 10;
              break;
           case -3001:
              $this->message = 'Сначала включите 2FA.';
              break;
           case -3002:
              $this->message = 'У нас нет этого актива.';
              break;
           case -3003:
              $this->message = 'Маржинальный аккаунт не существует.';  //Проверен
              break;
           case -3004:
              $this->message = 'Торговля запрещена.';
              break;
           case -3005:
              $this->message = 'Вывод не разрешен.';
              break;
           case -3006:
              $this->message = 'Сумма займа превышает максимально допустимую сумму займа.';
              break;
           case -3007:
              $this->message = 'У вас есть ожидающая транзакция, повторите попытку позже.';
              break;
           case -3008:
              $this->message = 'Брать взаймы запрещено.';
              break;
           case -3009:
              $this->message = 'Этот актив в настоящее время не может быть переведен на маржинальный счет.';
              break;
           case -3010:
              $this->message = 'Возврат не допускается.';
              break;
           case -3011:
              $this->message = 'Дата ввода недействительна.';
              break;
           case -3012:
              $this->message = 'Заем запрещен для этого актива.';
              break;
           case -3013:
              $this->message = 'Сумма займа превышает минимально допустимую сумму займа.';
              break;
           case -3014:
              $this->message = 'Заем заблокирован для этого аккаунта.';
              break;
           case -3015:
              $this->message = 'Сумма погашения превышает сумму займа.';
              break;
           case -3016:
              $this->message = 'Сумма погашения меньше минимально допустимой суммы погашения.';
              break;
           case -3017:
              $this->message = 'Этот актив в настоящее время не может быть переведен на маржинальный счет.';
              break;
           case -3018:
              $this->message = 'Для этого аккаунта заблокирован перевод.';
              break;
           case -3019:
              $this->message = 'Для этого аккаунта заблокирован перевод.';
              break;
           case -3020:
              $this->message = 'Сумма перевода превышает максимально допустимую сумму.';
              break;
           case -3021:
              $this->message = 'Маржинальный счет не может торговать этой торговой парой.';
              break;
           case -3022:
              $this->message = 'Для Вашего аккаунта запрещена торговля.';
              break;
           case -3023:
              $this->message = 'Вы не можете перевести/разместить ордер ниже текущего уровня маржи.';
              break;
           case -3024:
              $this->message = 'Неоплаченный долг слишком мал после такого погашения.';
              break;
           case -3025:
              $this->message = 'Дата ввода недействительна.';
              break;
           case -3026:
              $this->message = 'Ваш входной параметр недействителен.';
              break;
           case -3027:
              $this->message = 'Недопустимый маржинальный актив.';
              break;
           case -3028:
              $this->message = 'Недопустимая маржинальная пара.';
              break;
           case -3029:
              $this->message = 'Трансфер не удался.';
              break;
           case -3036:
              $this->message = 'Этот счет не разрешено погашать.';
              break;
           case -3037:
              $this->message = 'PNL очищается. Подождите секунду.';
              break;
           case -3038:
              $this->message = 'Ключ прослушивания не найден.';
              break;
           case -3041:
              $this->message = 'Не хватает средств на балансе.';
              break;
           case -3042:
              $this->message = 'PriceIndex недоступен для этой маржинальной пары.';
              break;
           case -3043:
              $message = 'Трансфер не разрешен.';
              break;
           case -3044:
              $this->message = 'Система занята.';
              $this->code = 10;
              break;
           case -3045:
              $this->message = 'Сейчас в системе недостаточно ресурсов.';
              break;
           case -3999:
              $this->message = 'Эта функция доступна только для приглашенных пользователей.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>