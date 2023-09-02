<?php
   /**
   * ParseOrderRejectionIssuesCodes: Трейт, определяющий функции разбора сообщений об ошибках
   * сервиса Binance API, обусловленных проблемами с отклонением ордеров
   */
   trait ParseOrderRejectionIssuesCodes {
     /**
      * Функция разбора сообщения об ошибке, обусловленных проблемами с отклонением ордеров
      *
      * @param  string   $message           Текстовое сообщение об ошибке
      *
      * @return string                      Текстовое сообщение об ошибке
      */
     protected function ParseOrderRejectionIssues($message) {
        switch ($message) {
           case 'Unknown order sent.':
              $output = 'Отправлен неизвестный ордер. Ордер (идентификаторы orderId, clientOrderId или origClientOrderId) не найден.';
              break;
           case 'Unknown order sent.':
              $output = 'Отправлен дубликат ордера. Идентификатор clientOrderId уже используется.';
              break;
           case 'Market is closed.':
              $output = 'Рынок закрыт. Символ не торгуется.';
              break;
           case 'Account has insufficient balance for requested action.':
              $output = 'На аккаунте недостаточно средств для запрошенного действия.';
              break;
           case 'Market orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа MARKET.';
              break;
           case 'Iceberg orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа icebergQty.';
              break;
           case 'Stop loss orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа STOP_LOSS.';
              break;
           case 'Stop loss limit orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа STOP_LOSS_LIMIT.';
              break;
           case 'Take profit orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа TAKE_PROFIT.';
              break;
           case 'Take profit limit orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа TAKE_PROFIT_LIMIT.';
              break;
           case 'Price * QTY is zero or less.':
              $output = 'Для этого символа значение price * quantity слишком мало.';
              break;
           case 'IcebergQty exceeds QTY.':
              $output = 'Для этого символа значение icebergQty должно быть меньше чем объем ордера.';
              break;
           case 'This action is disabled on this account.':
              $output = 'Это действие отключено для этого аккаунта. Связаться со службой поддержки; некоторые действия были отключены в этой учетной записи.';
              break;
           case 'Unsupported order combination':
              $output = 'Неподдерживаемая комбинация параметров ордера. Комбинация параметров orderType, timeInForce, stopPrice и/или icebergQty недопустима.';
              break;
           case 'Order would trigger immediately.':
              $output = 'Орден сработает немедленно. Стоп-цена ордера недопустима по сравнению с ценой последней сделки.';
              break;
           case 'Cancel order is invalid. Check origClientOrderId and orderId.':
              $output = 'Отмена ордера недопустима. Параметры origClientOrderId или orderId не были отправлены. Проверьте origClientOrderId и orderId.';
              break;
           case 'Order would immediately match and take.':
              $output = 'Ордер бы сразу сопоставили и забрали. Ордер типа LIMIT_MAKER будет немедленно соответствовать и торговаться, а не будет чистым ордером мейкера.';
              break;
           case 'The relationship of the prices for the orders is not correct.':
              $output = 'Соотношение цен на ордера некорректное. Цены, установленные в ордере типа OCO, нарушают правила ценообразования.</p><p>Эти правила следующие:</p><p>Для ордеров типа SELL: Limit Price > Last Price > Stop Price.</p><p>Для ордеров типа BUY: Limit Price < Last Price < Stop Price. ';
              break;
           case 'OCO orders are not supported for this symbol':
              $output = 'Для этого символа не поддерживаются ордера типа OCO.';
              break;
           case 'Quote order qty market orders are not support for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера типа MARKET, использующие параметр quoteOrderQty.';
              break;
           case 'Trailing stop orders are not supported for this symbol.':
              $output = 'Для этого символа не поддерживаются ордера, использующие параметр trailingDelta.';
              break;
           case 'Order cancel-replace is not supported for this symbol.':
              $output = 'Для этого символа не поддерживается интерфейс POST /api/v3/order/cancelReplace.';
              break;
           default:
              $message = 'Получен недопустимый ответ сервиса Binance API: ' . strval($message);
        }
        return $output;
     }
  }
?>