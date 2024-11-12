<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Money;
use App\Models\Participant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'JOURNÉE DES RETROUVAILLES 2025',
                'short_description' => 'JUBILÉ D’OR 1975-2025',
                'long_description' => '<p>Cette rencontre est exceptionnelle et spéciale à plus d’un titre :<br>• Elle correspond aux 50 ans de notre Association. Ce sont les Noces d’or<br>• Elle sera l’occasion de rendre hommage à nos Pères Fondateurs <strong>Mgr Anaclet FRINDETHIE </strong>et <strong>Mgr Jean-Baptiste Tanon Danho AKWADAN </strong>qui par la grâce de Dieu sont encore à nos côtés.<br>• Elle verra la participation d’éminentes personnalités de l’Église :<br>• <strong>Son Éminence Robert Cardinal SARAH,</strong><br><strong>Ancien Archevêque Métropolitain de CONAKRY en Guinée, Ancien Préfet de la Congrégation du Culte Divin et de la Discipline des Sacrements au Vatican/Rome.</strong><br>• Son Excellence <strong>Mgr Jean Sylvain Emien MAMBE</strong><br>Premier Nonce Apostolique Ivoirien<br>Nonce Apostolique au MALI et en GUINÉE CONAKRY</p>',
                'date' => '2025-03-02 00:00:00',
                'participation_amount' => new Money('XOF', 10000.0),
            ],
        ];

        Event::factory()
            ->createMany($events);
    }
}
