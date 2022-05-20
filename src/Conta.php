<?php
namespace App;

class Conta
{
    private float $saldo = 0;

    public function abrirConta(float $valor = 0)
    {
        $this->saldo = $valor;
    }

    public function depositar(float $valor)
    {
        $this->saldo += $valor;
    }

    public function consultarSaldo(): float
    {
        return $this->saldo;
    }

    public function sacar(float $valor)
    {
        $this->saldo -= $valor;
    }

    public function transferir(Conta $conta, float $valor)
    {
        $this->sacar($valor);
        $conta->depositar($valor);
    }

    public function anularTransferencia(Conta $conta, $valor)
    {
        $conta->saldo -= $valor;
        $this->saldo += $valor;
    }
}
