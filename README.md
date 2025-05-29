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
4. Beim ersten Start wird die Datenbank automatisch erstellt (`php/setup.php` wird automatisch aufgerufen)

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
