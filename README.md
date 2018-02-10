# itsafety-task

Opis podstawowych klas domeny:

- track  - trasa agreguje parametry wstrzyknięte przez mapper dane, przekazuje do przetworzenia do Point
- point -  pomiar, przetwarza dane na podstawie wstrzykniętych parametrów trasy
- trackgenerator  - zarzadza elementami trasy, poczetek, koniec, pomiar, dane
- device - informacje o device, uruchamia proces generowania tras
- mapper - zarzadza elementami konfiguracji - parametry, typy tras, delimetery, wartości

-repozytoria - warstwa dostepu do dancyh (db+generatory)
-servisy - fasada usługi

Klasy pomocnicze:
Fabryki - twotzenie nowych instacji, budowanie złoonych obiektów

Interfejsy, abstrakcje - wymiana implementacji bez zmiany kodu, w miejscu zastosowania danej abstrakcji


Opis uzycia:
Katalog Sheets jest dla uzytkownika (programisty), tutaj definiowane są raporty (raporty Tracks dla typów tracks)
- mapa (typy tras, pola do agregacji)
- parameters - definicje agregatów  i typów tras (runtime)
- reports -  klasa raportu - podłączenie serwisów, parametrów i szablonów

zmienione:
-  service -  podłaczenie danych ( przenisione do domeny)

środowisko uruchomieniowe - asynchroniczne operacje
- react i promises

Wyniki zagregowane, dzienne i z zakresu (dwa raporty): wyniki.raw  (jeden pod drugim)

Czas pracy:  w sumie ~40h

Czas zakończenia: Wersja DEMO :)

TODO:
1. Algorytm agregująco-filtrujący w oparciu o generatory   
TODO: refactor, dodać  validator track length obsługa błedów krytycznych
2. Konfigurator filtrów i aggregatów   w trakcie:  Chaining   //TODO: Tree struktura dla mapy??
3. Konfiguracja kontenera DI //TODO  next
3a. Model, Repository do pakietu library Domain  zrobione
3b. Chain abstract Parameter, Filters,  TODO  w trakcie
3c. multiprocessing  //Todo:
3d. async multi execution  //zrobione
4. Testy PoC algorytmu    //zrobione
5. Testy PoC środowiska  //zrobione
6. Uzupełnienie i aktualizacja nazw, typowania, php_doc //TODO: w trakcie
7. Aktualizacja dokumentacji (UML)  //zrobione
8. Templates   //zrobione versja raw




![img](https://github.com/mariuszmilko/itsafety-task/blob/master/itsafety.png)

