<?php
namespace Configurator\Gateway;

use Configurator\Models\Choice;
use Configurator\Models\Option;

class MemoryChoicesGateway implements ChoicesGateway
{
    public function getChoices($choicesId)
    {
        return [
            new Choice("Kies je productiemethode", [
                new Option("Digitaal drukwerk", 2, 1.0, 10),
                new Option("Offset drukwerk", 4, 1.5, 25),
            ], 'production'),
            new Choice("Kies het eindformaat", [
                new Option('A4', 1, 0, 0),
                new Option('A5', 1, 0, 0),
                new Option('A6', 1, 0, 0),
                new Option('Lang A5', 1, 0, 0),
                new Option('Vierkant (210mm x 210mm)', 1, 0, 0),
                new Option('Vierkant (135mm x 135mm)', 1, 0, 0),
            ], 'size'),
            new Choice('Kies de vouwrichting', [
                new Option('Staand', 0, 0, 0),
                new Option('Liggend', 0, 0, 0),
            ], 'fold_direction'),
            new Choice('Aantal pagina\'s inclusief omslag', [
                new Option('8 Pagina\'s', 0, 0.3, 0),
                new Option('12 Pagina\'s', 0, 0.6, 0),
                new Option('16 Pagina\'s', 0, 0.9, 0),
                new Option('20 Pagina\'s', 0, 0.12, 0),
                new Option('24 Pagina\'s', 0, 0.15, 0),
                new Option('28 Pagina\'s', 0, 0.18, 0),
            ], 'page_count'),
            new Choice('Kies de oplage', [
                new Option('100', 0, 0, 0),
                new Option('250', 0, 0, 0),
                new Option('500', 0, 0, 0),
                new Option('1000', 0, 0, 0),
                new Option('2000', 0, 0, 0),
                new Option('4000', 0, 0, 0),
            ], 'count'),
        ];
    }

}
