# Testaufgabe

Benutzer die aktuellste Laravel-Version.

Erstelle einen DB-Import der Daten, welche sich in der Datei „germany.json“ befinden.

## Frontend:
1.	Erstelle ein Input-Feld, welches über AJAX die Daten in der Datenbank suchen kann(über das Feld: Name)
2.	Zeige die 10 besten Ergebnisse in eine Art Vorschlag(wie bei Google).



# How To:

## Run application

* Clone the repo
* Run command `./vendor/bin/sail up -d`  (assuming you have docker installed)
* Run command `./vendor/bin/sail migrate`


## Accessing the API

* Open in API browser (such as *Postman* etc.)
  * `POST http://localhost/api/location`
    * Params: `file` => germany.json
  * `GET http://localhost/api/location`
    * Get all locations (no pagination)
    * Filter via `name` attr 
      * min:2 | max:255 characters
  * `GET http://localhost/api/location/{uuid}`
    * Get location via ID

