<?php

namespace App\Jobs;
use App\Mail\EnviarMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Exception;
class SendMailJob implements ShouldQueue
{
    use Queueable;

    protected $email;
    protected $bl;

    public function __construct($email, $bl)
    {
        $this->email = $email;
        $this->bl = $bl;
    }


    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new EnviarMail($this->bl));
            // Si el correo se envía correctamente, puedes establecer un mensaje de éxito
            $mensaje = 'El correo se ha enviado correctamente.';
        } catch (Exception $e) {
            // Si ocurre un error, puedes capturarlo y establecer un mensaje de error
            $mensaje = 'Error al enviar el correo: ' . $e->getMessage();
        }
        

/*try {
    $email = Mail::to('miguelnavas1991@gmail.com');
    
    // Forzar envío inmediato (si usas queues)
    $email->send(new EnviarMail($this->bl));
    
    // Verificar fallos explícitamente
    if (Mail::failures()) {
        $mensaje = 'Error al enviar a: ' . implode(', ', Mail::failures());
    } else {
        $mensaje = 'Correo enviado correctamente. Revisa bandeja de entrada/spam.';
        
    }
    
} catch (TransportExceptionInterface $e) {
    $mensaje = 'Error SMTP: ' . $e->getMessage();
    
    // Registrar error técnico
    \Log::error('Error enviando correo: ' . $e->getMessage());
    
} catch (Exception $e) {
    $mensaje = 'Error general: ' . $e->getMessage();
    \Log::error($e);
}*/
        
        
    }
}
