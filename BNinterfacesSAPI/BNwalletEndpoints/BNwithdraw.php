<?php
  /**
   * BNwithdraw: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса вывода средств с аккаунтов пользователя сервиса Binance API
   */  
  class BNwithdraw extends BNinterfaceSAPI {
     use SignedPOST;
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/sapi/v1/capital/withdraw/apply';
     /**
      * Допустимые аргументы функции BNwithdraw::SendQuery($coin, $address, $amount)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, addressTag: $addressTag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, name: $name, recvWindow: $recvWindow)

      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)



      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)



      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)

      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, transactionFeeFlag: $transactionFeeFlag, name: $name, walletType: $walletType, recvWindow: $recvWindow)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, name: $name)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, name: $name, walletType: $walletType)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, name: $name, walletType: $walletType, recvWindow: $recvWindow)



      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, network: $network, addressTag: $addressTag)
      *                              BNwithdraw::SendQuery($coin, $address, $amount, withdrawOrderId: $withdrawOrderId, network: $network, addressTag: $addressTag, transactionFeeFlag: $transactionFeeFlag)

      *
      * @param  string   $coin               Символ монеты.
      * @param  string   $address            Адрес в сети, на который выводятся средства.
      * @param  string   $amount             Сумма, которая выводится.
      * @param  string   $withdrawOrderId    Идентификатор клиента для вывода.
      * @param  string   $network            Имя сети, через которую выводятся средства.
      *                                      Если параметр не указывается - средства
      *                                      выводятся в сеть, установленную для этой
      *                                      монеты по умолчанию.
      * @param  string   $addressTag         Второй идентификатор адреса в сети, для монет,
      *                                      подобных XRP, XMR и т.д.
      * @param  bool     $transactionFeeFlag Флаг для внутренних переводов. Возможные значения:
      *                                         TRUE  - комиссия возвращается на счет назначения.
      *                                         FALSE - комиссия возвращается на счет отправителя.
      *                                         По умолчанию: FALSE.
      * @param  string   $name               Описание адреса. Пробел в имени должен быть закодирован в %20.
      * @param  integer  $walletType         Тип кошелька для вывода. Возможные значения:
      *                                         0 - спотовый кошелек.
      *                                         1 - кошелек для финансирования.
      *                                         По умолчанию: текущий «выбранный кошелек» в разделе
      *                                                       wallet->Fiat and Spot/Funding->Deposit.
      * @param  integer  $recvWindow         Период (в миллисекундах), в течении которого
      *                                      запрос действителен
      *
      * @return array                         Ассоциативный массив содержащий следующие элементы:
      *                                            integer      id          Идентификатор транзакции.
      */
     static public function SendQuery($coin,
                                      $address,
                                      $amount,
                                      $withdrawOrderId = NULL,
                                      $network = NULL,
                                      $addressTag = NULL,
                                      $transactionFeeFlag = NULL,
                                      $name = NULL,
                                      $walletType = NULL,
                                      $recvWindow = NULL) {
        self::SaveArguments($coin, $address, $amount, $withdrawOrderId, $network, $addressTag, $transactionFeeFlag, $name, $walletType, $recvWindow);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  string   $coin               Символ монеты.
      * @param  string   $address            Адрес в сети, на который выводятся средства.
      * @param  string   $amount             Сумма, которая выводится.
      * @param  string   $withdrawOrderId    Идентификатор клиента для вывода.
      * @param  string   $network            Имя сети, через которую выводятся средства.
      *                                      Если параметр не указывается - средства
      *                                      выводятся в сеть, установленную для этой
      *                                      монеты по умолчанию.
      * @param  string   $addressTag         Второй идентификатор адреса в сети, для монет,
      *                                      подобных XRP, XMR и т.д.
      * @param  bool     $transactionFeeFlag Флаг для внутренних переводов. Возможные значения:
      *                                         TRUE  - комиссия возвращается на счет назначения.
      *                                         FALSE - комиссия возвращается на счет отправителя.
      *                                         По умолчанию: FALSE.
      * @param  string   $name               Описание адреса. Пробел в имени должен быть закодирован в %20.
      * @param  integer  $walletType         Тип кошелька для вывода. Возможные значения:
      *                                         0 - спотовый кошелек.
      *                                         1 - кошелек для финансирования.
      *                                         По умолчанию: текущий «выбранный кошелек» в разделе
      *                                                       wallet->Fiat and Spot/Funding->Deposit.
      * @param  integer  $recvWindow         Период (в миллисекундах), в течении которого
      *                                      запрос действителен
      */
     static protected function SaveArguments($coin,
                                             $address,
                                             $amount,
                                             $withdrawOrderId = NULL,
                                             $network = NULL,
                                             $addressTag = NULL,
                                             $transactionFeeFlag = NULL,
                                             $name = NULL,
                                             $walletType = NULL,
                                             $recvWindow = NULL) {
        if (!is_null($coin)) {
           self::$arguments['coin']               = $coin;
        }
        if (!is_null($address)) {
           self::$arguments['address']            = $address;
        }
        if (!is_null($amount)) {
           self::$arguments['amount']             = $amount;
        }
        if (!is_null($withdrawOrderId)) {
           self::$arguments['withdrawOrderId']    = $withdrawOrderId;
        }
        if (!is_null($network)) {
           self::$arguments['network']            = $network;
        }
        if (!is_null($transactionFeeFlag)) {
           self::$arguments['transactionFeeFlag'] = $transactionFeeFlag;
        }
        if (!is_null($name)) {
           self::$arguments['name']               = $name;
        }
        if (!is_null($walletType)) {
           self::$arguments['walletType']         = $walletType;
        }
        if (!is_null($recvWindow)) {
           self::$arguments['recvWindow']         = $recvWindow;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (count(self::$arguments) < 3 || count(self::$arguments) > 10) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимое количество аргументов, переданных функции SendQuery().');
        }
        if (isset(self::$arguments['coin']) && !is_string(self::$arguments['coin'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента coin, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['address']) && !is_string(self::$arguments['address'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента address, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['amount']) && !is_string(self::$arguments['amount'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента amount, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['withdrawOrderId']) && !is_string(self::$arguments['withdrawOrderId'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента withdrawOrderId, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['network']) && !is_string(self::$arguments['network'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента network, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['transactionFeeFlag']) && !is_string(self::$arguments['transactionFeeFlag'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента transactionFeeFlag, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['name']) && !is_string(self::$arguments['name'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента name, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['walletType']) && !is_string(self::$arguments['walletType'])) {
           throw new BNinterfaceException(get_called_class(),
                                          'Недопустимый тип аргумента walletType, переданного функции SendQuery().');
        }
        if (isset(self::$arguments['recvWindow']) && !is_integer(self::$arguments['recvWindow'])) {
              throw new BNinterfaceException(get_called_class(),
                                             'Недопустимый тип аргумента recvWindow, переданного функции SendQuery().');
        }
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        return 600;
     }
 }
?>