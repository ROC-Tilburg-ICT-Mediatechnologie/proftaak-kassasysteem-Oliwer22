# Kassasysteem
Proftaak-project waar je in je eentje aan werkt om je coding skills te oefenen.

>Leerdoelen
* Je maakt gebruik van composer.json
* Je maakt gebruik van een namespace.
* Je maakt gebruik van OOP technieken:
  * classes met properties en methods
  * private properties 
  * private, protected of public methods 
  * maakt objecten van classes
  
## Inhoud project
Je gaat een kassasysteem maken voor een cafe/restaurant.

## Ontwerp
Er zijn twee ontwerpen aangeleverd (zie map projectbestanden):
* ‘databases diagram’ met het ontwerp van de database.
* ‘Activity diagram’ met de acties door de gebruiker en het systeem in de tijd.

## Starten van de basiscode
Er is al basiscode waarin gebruik is gemaakt van het MVC-framework CodeIgniter (versie 4). Starten gaat op de volgende manier:
* Start MAMP
* Maak de database met kassasysteem_v1.sql
* Controleer de databasegegevens in app/Config/Database.php
* Controleer het .env bestand waarin gegevens over mysql staan, pas zo nodig aan.

## Werkwijze
* Bestudeer het database-ontwerp:
  - Welke tabellen zijn er?
  - Wat zijn de relaties tussen de tabellen?
  - Wat is de inhoud van de tabellen?
* Bestudeer het activiteitendiagram:
  * Wat gebeurt wanneer? 
* Bestudeer het class diagram:
  * Wat is de relatie tussen de classes?
  * Wat zou elke method ongeveer doen?
* Bestudeer de code:
  - Welke php-bestand hoort bij welk blokje in het activiteiten diagram?
  - Welke php-bestand hoort bij welke class in het class diagram?
  - Maak het kassasysteem af door de TODO's uit te werken (maak gebruik van de gegeven classes).
  - Breid tenslotte je database uit met een tabel 'taal' met daarin in het Nederlands en in het Engels de gebruikte teksten en knoppen in de app.
  - Maak een class taalModel met een method om de juiste vertaling op te halen bij een 'locale': https://www.php.net/manual/en/locale.acceptfromhttp.php
  - Maak de teksten op keuze.php dynamisch.
* Alles hierboven gedaan?
  * Doe dan iets aan het ontwerp.

## Tijd
Je krijgt tot het einde van de periode een deel van de les de tijd om hier aan te werken.

## Opleveren
Via github op de laatste donderdag VOOR de toetsweek.