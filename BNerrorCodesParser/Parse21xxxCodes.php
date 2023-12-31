﻿<?php
   /**
   * Parse21xxxCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с маржинальным портфелем аккаунта
   */
   trait Parse21xxxCodes {
     /**
      * Функция разбора сообщений об ошибках с кодами группы -21ххx
      *
      * @param  array    $response          Ответ сервиса
      *
      */
     protected function Parse21xxxCodes($response) {
        switch ($response['code']) {
           case -21001:
              $this->message = 'Запрашиваемого ID нет в маржинальном портфеле аккаунта.';
              break;
           case -21002:
              $this->message = 'Маржинальный портфель аккаунта не поддерживает перевод с маржи на фьючерсы.';
              break;
           case -21003:
              $this->message = 'Не удалось получить маржинальные активы.';
              break;
           case -21004:
              $this->message = 'У пользователя нет ссуды на банкротство с маржей портфеля.';
              break;
           case -21005:
              $this->message = 'В спотовом кошельке пользователя недостаточно BUSD для погашения кредита на банкротство с маржей портфеля.';
              break;
           case -21006:
              $this->message = 'У пользователя был процесс погашения кредита на банкротство с маржей портфеля.';
              break;
           case -21007:
              $this->message = 'Пользователь не смог погасить ссуду на банкротство с маржей портфеля, поскольку ликвидация находилась в процессе.';
              break;
           default:
              $this->message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($response['msg']);
        }
     }
  }
?>