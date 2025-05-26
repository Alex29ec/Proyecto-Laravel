<?php

namespace App\Services;

use Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Carbon\Carbon;
use Log;

class GoogleCalendarService
{
    
    public function crearEvento($user, $reserva)
    {
        try {
            $client = new Google_Client();
            $client->setAuthConfig(storage_path('app/google/credentials.json')); 
            $client->addScope(Calendar::CALENDAR);
            $client->setAccessToken([
                'access_token' => $user->google_token,
                'refresh_token' => $user->google_refresh_token,
                'expires_in' => 3600,
                'created' => time(),
            ]);

            // Si el token expiró, lo actualizamos
            if ($client->isAccessTokenExpired()) {
                $newToken = $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
                $user->google_token = $newToken['access_token'];
                $user->save();
            }

            $service = new Calendar($client);

            $event = new Event([
                'summary' => 'Reserva de tatuaje',
                'description' => 'Reserva con ' . $reserva->tatuador->name,
                'start' => [
                    'dateTime' => Carbon::parse($reserva->fecha . ' ' . $reserva->hora)->toRfc3339String(),
                    'timeZone' => 'Europe/Madrid',
                ],
                'end' => [
                    'dateTime' => Carbon::parse($reserva->fecha . ' ' . $reserva->hora)->addHour()->toRfc3339String(),
                    'timeZone' => 'Europe/Madrid',
                ],
                'attendees' => [
                    ['email' => $user->email],
                    ['email' => $reserva->tatuador->email],
                ],
            ]);

            $service->events->insert('primary', $event);
        } catch (\Exception $e) {
            Log::error('Error al crear evento en Google Calendar: ' . $e->getMessage());
        }
    }
}
