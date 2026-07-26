# Mini Onlinehandel & Steuer-Tool

Ein kleines PHP-Projekt, das die Umsatzsteuer-Berechnung und Datenanbindung fuer einen Online-Shop simuliert - weil ich etwas fuer echte Nutzer bauen wollte, nicht nur fuer Noten.

## Problemstellung
Online-Shops muessen fuer jede Bestellposition die korrekte Umsatzsteuer berechnen (19% / 7%), unterschiedliche Faelle wie Reverse-Charge im B2B-Bereich abbilden und dabei mit externen Datenquellen (z. B. Wechselkurse) synchron bleiben.

## Tech-Stack
PHP 8.2, MySQL, PHPUnit, Composer, oeffentliche Wechselkurs-API

## Architektur
Controller -> Service (TaxCalculator, CurrencyConverter) -> Repository -> DB. Die externe API-Anbindung ist ueber ein Interface (ExchangeRateProvider) entkoppelt, sodass die Datenquelle austauschbar ist, ohne die Geschaeftslogik anzufassen.

## Was ich gelernt habe
Rundungsregeln bei gemischten Steuersaetzen im selben Warenkorb. Fehlerbehandlung bei nicht erreichbaren externen Schnittstellen. Testabdeckung fuer steuerrelevante Randfaelle (Reverse-Charge, gemischte Saetze).

## Naechste Schritte fuer den Produktiveinsatz
EU-OSS-Verfahren (One-Stop-Shop) fuer grenzueberschreitenden B2C-Handel innerhalb der EU. Revisionssichere Protokollierung aller steuerrelevanten Berechnungen (GoBD-Konformitaet). Fehlerbehandlung und Retry-Logik fuer die externe Wechselkurs-Schnittstelle. Unterstuetzung fuer unterschiedliche Steuersaetze je EU-Land bei Auslandslieferungen.

## Setup
composer install; cp .env.example .env; php -S localhost:8000 -t public

## Tests
vendor/bin/phpunit
