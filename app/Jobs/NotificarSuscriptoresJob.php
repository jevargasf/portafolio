<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Entrada;
use App\Models\Suscriptor;
use Illuminate\Mail\Mailable;

class NotificarSuscriptoresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public readonly int $entradaId;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->entradaId = $id;
        $entrada = Entrada::where('id', $this->entradaId)->first();

        $suscriptores = Suscriptor::where('estado', 1)->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
