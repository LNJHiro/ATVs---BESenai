<!-- EXERCÍCIO 04 -->

<?php

// Classe Email
class Email {
    public function enviar() {
        return "Enviando email...";
    }
}

// Classe Sms
class Sms {
    public function enviar() {
        return "Enviando SMS...";
    }
}

// Função que aceita qualquer objeto que tenha o método enviar()
function notificar($meio) {
    echo $meio->enviar() . "\n";
}

// ===== Testando =====
$email = new Email();
$sms = new Sms();

notificar($email); // Saída: Enviando email...
notificar($sms);   // Saída: Enviando SMS...

?>