<?php
namespace App\Services;

use App\Models\Reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaCreadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    /**
     * Crear una nueva instancia del mensaje.
     */
    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva;
    }

    /**
     * Construir el mensaje.
     */
   public function build()
{
    return $this->subject('Confirmación de tu reserva')
                ->view('reservas.create')
                ->with([
                    'desdeCorreo' => true
                ]);
}

}
