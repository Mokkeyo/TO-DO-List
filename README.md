# Drag & Drop Todo-Liste (PHP + MySQL)

Dies ist eine ToDo-Listen-Webanwendung mit Drag & Drop, Farbauswahl und Datenpersistenz in einer MySQL-Datenbank.

## 🔧 Voraussetzungen

- XAMPP oder vergleichbare lokale Serverumgebung
- PHP ≥ 7.4
- MySQL/MariaDB

## 📦 Installation

1. XAMPP installieren und starten (Apache + MySQL aktivieren)  
2. Projektordner in `C:\xampp\htdocs\dragdrop-todo\` kopieren  
3. Im Browser aufrufen: `http://localhost/dragdrop-todo/`  
4. Beim ersten Start wird automatisch das Setup-Script `php/setup.php` ausgeführt, welches:  
    - Die Datenbank `todo` erstellt (falls noch nicht vorhanden)  
    - Eine Tabelle `tasks` mit Spalten für Aufgabenname, Status und Farbe anlegt  
    - Einen MySQL-Benutzer `user` mit Passwort `t0{d0-l1]5t` anlegt und diesem die notwendigen CRUD-Rechte auf die Datenbank `todo` erteilt  
5. Danach ist die Anwendung einsatzbereit und speichert alle Aufgaben direkt in der Datenbank  

Eine Tabelle tasks mit Spalten für Aufgabenname, Status und Farbe anlegt

Einen MySQL-Benutzer user mit Passwort t0{d0-l1]5t anlegt und diesem die notwendigen CRUD-Rechte auf die Datenbank todo erteilt

## 📁 Projektstruktur

- `index.html` – Hauptseite mit JavaScript-Logik
- `php/` – Backend-Logik in PHP (`createTask.php`, `deleteTask.php` etc.)
- `style.css` – Styling
- `README.md` – Diese Anleitung

## 🧠 Features

- Aufgaben erstellen, farblich markieren, verschieben
- Aufgaben in MySQL speichern
- Aufgaben löschen und bearbeiten
- Drag & Drop mit Statuswechsel
