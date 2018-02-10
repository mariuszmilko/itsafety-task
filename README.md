# itsafety-task
TODO:
1. Algorytm agregująco-filtrujący w oparciu o generatory ()   
TODO: refactor, ddoać  validator track length obsługa błedów krytycznych
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

Wyniki zagregowane, dzienne i z zakresu (dwa raporty): wyniki.raw

Opis uzycia:
Katalog Sheets jest dla uzytkownika (programisty), tutaj definiowane są raporty (Tracks dla typów tracks)
- mapa (typy tras, pola do agregacji)
- parameters - definicje agregatów  i typów tras (runtime)
- reports -  klasa raportu - podłączenie serwisów, parametrów i szablonów

zmienione:
-  service -  podłaczenie danych ( przenisione do domeny)


Opis podstawowych klas domeny:

- track  - trasa agreguje parametry dane z Point
- point -  pomiar, przetwarza dane na podstawie wstrzykniętych parametrów trasy
- trackgenerator  - zarzadza elementami trasy, poczetek, koniec, 
- device - informacje o device, uruchamia proces generowania tras
- mapper - zarzadza elementami konfiguracji - parametry, typy tras, delimetery, wartości

-repozytoria
-servisy

Klasy pomocnicze:
Fabryki - twotzenie nowych instacji, budowanie złoonych obiektów

Interfejsy, abstrakcje - wymiana implementacji bez zmiany kodu, w miejscu zastosowania danej abstrakcji


Czas zakończenia: Wersja DEMO :)
![img](https://github.com/mariuszmilko/itsafety-task/blob/master/itsafety.png)

