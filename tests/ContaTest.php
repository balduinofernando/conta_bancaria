<?php

use App\Conta;

// Ao abrir uma conta, o saldo deve ser 0kz
test('Ao abrir uma conta, o saldo deve ser 0kz', function () {
    $conta = new Conta;
    $conta->abrirConta();
    $this->assertEquals(0, $conta->consultarSaldo());
});

// Ao depositar o saldo de 500KZ numa conta A, o saldo deverá ser de 500KZ
test('Ao depositar o saldo de 500KZ numa conta A, o saldo deverá ser de 500KZ', function () {
    $conta = new Conta;
    $conta->abrirConta();
    $conta->depositar(500);
    $this->assertEquals(500, $conta->consultarSaldo());
});

// Ao sacar 500KZ numa conta A com saldo de 1000kz, o saldo deverá ser de 500KZ

test('Ao sacar 500KZ numa conta A com saldo de 1000kz, o saldo deverá ser de 500KZ', function () {
    $conta = new Conta;
    $conta->abrirConta();
    $conta->depositar(1000);
    $conta->sacar(500);
    $this->assertEquals(500, $conta->consultarSaldo());
});

// Ao transferir 500KZ de uma conta A para uma conta B, o saldo de A deverá ser de 0KZ e o saldo de B deverá ser de 500KZ
test('Ao transferir 500KZ de uma conta A para uma conta B, o saldo de A deverá ser de 0KZ e o saldo de B deverá ser de 500KZ', function () {
    // Arrange
    $contaA = new Conta;
    $contaB = new Conta;
    $contaA->abrirConta();
    $contaA->depositar(500);

    // Act
    $contaA->transferir($contaB, 500);

    // Assert
    $this->assertEquals(0, $contaA->consultarSaldo());
    $this->assertEquals(500, $contaB->consultarSaldo());
});

// Ao fazer dois depósitos de 500kz na conta A e depois transferir 100kz para a conta B, o saldo de A deverá ser de 900KZ e o saldo de B deverá ser de 100KZ
test('Ao fazer dois depósitos de 500kz na conta A e depois transferir 100kz para a conta B, o saldo de A deverá ser de 900KZ e o saldo de B deverá ser de 100KZ', function () {
    // Arrange
    $contaA = new Conta;
    $contaB = new Conta;
    $contaA->abrirConta();
    $contaA->depositar(500);
    $contaA->depositar(500);

    // Act
    $contaA->transferir($contaB, 100);

    // Assert
    $this->assertEquals(900, $contaA->consultarSaldo());
    $this->assertEquals(100, $contaB->consultarSaldo());
});

// Ao anular uma operação de transferência de 100kz na conta A com saldo de 900, o saldo de A deverá ser de 1000KZ e o saldo de B deverá ser de 0KZ
test('Ao anular uma operação de transferência de 100kz da conta A com saldo de 900, o saldo de A deverá ser de 1000KZ e o saldo de B deverá ser de 0KZ', function () {
    // Arrange
    $contaA = new Conta;
    $contaB = new Conta;
    $contaA->abrirConta();
    $contaA->depositar(1000);
    $contaA->transferir($contaB, 100);

    // Act
    $contaA->anularTransferencia($contaB, 100);

    // Assert
    $this->assertEquals(1000, $contaA->consultarSaldo());
    $this->assertEquals(0, $contaB->consultarSaldo());
});
