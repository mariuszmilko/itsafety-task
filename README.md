P.S.

@HUBERT   "Having" not "Haeving"... taka drobna różnica w wymowie... i zamiast warunku dla grupy mamy super plugin, który potrafi żonglować terabajtami danych w ms..  ;)

..do tego zadania rekrutacyjnego z przed roku, dorzuciłem docblock, typy zwracane, extra jeszcze jeden wzorzec Value Object do parametrów...

# itsafety-task

Opis podstawowych klas domeny:

- track  - trasa agreguje parametry wstrzyknięte przez mapper dane, przekazuje do przetworzenia do Point
- point -  pomiar, przetwarza dane na podstawie wstrzykniętych parametrów trasy
- trackgenerator  - zarzadza elementami trasy, poczetek, koniec, pomiar, dane, agregacje
- device - informacje o device, uruchamia proces generowania tras
- mapper - zarzadza elementami konfiguracji - parametry, typy tras, delimetery, wartości
- parameteraggregator - agreguje dane ze wszystkich aktywnych parametrow tras, z całego przetwaranego zakresu

-repozytoria - warstwa dostepu do dancyh (db+generatory)
-servisy - fasada usługi

Klasy pomocnicze:
Fabryki - twotzenie nowych instacji, budowanie złoonych obiektów

Interfejsy, abstrakcje - wymiana implementacji bez zmiany kodu, w miejscu zastosowania danej abstrakcji


Opis uzycia:
Katalog Sheets jest dla uzytkownika (programisty), tutaj definiowane są raporty (raporty Tracks dla typów tracks)
- mapa (typy tras, pola do agregacji)
- parameters - definicje agregatów danych  i typów tras (runtime)
- aggregates - definicja agragecji dla agregatów parametrów
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



Wymgania od klienta:

. W załączniku znajduje się struktura bazy oraz przykładowe dane z 
kilku dni dla kilku obiektów

device_id określa obiekt, dla którego są dane

record_timestamp - czas otrzymania sygnału

record_rpm - obroty silnika

record_gps_speed - prędkość

record_device_state - wartość >= 2 pojazd ma uruchomiony silnik 
[zakładamy że jedzie], <2 pojazd stoi

Paliwo:

record_analog_fuel_recalc / record_can_fuel_recalc - dane dotyczące 
paliwa, zużycie paliwa liczymy na podstawie różnicy między wartością na 
końcu, a wartością początkową

Przejechany dystans:

W przypadku gdy kolumna record_calc_odo jest równa NULL przejechany 
dystans liczymy na podstawie sumy wartości z kolumny record_calc_distance

Gdy record_calc_odo nie jest równe null to przejechany dystans liczymy 
na podstawie różnicy między wartością record_calc_odo na końcu, a 
wartością początkową.


Zadanie polega na przygotowaniu implementacji, której wynikiem dla 
zadanego device_id oraz zakresu czasu record_timestamp

będzie tablica lub obiekt która będzie zawierała listę tras wraz z 
odpowiednimi wartościami:

Każda trasa ma mieć :
- określony typ, [track, stop] (track gdy pojazd jechał, stop gdy pojazd 
stał]
- czas początku
- czas końca
- przejechany dystans  [dla typu track]
- zużyte paliwo [dla typu track, jeśli posiadamy informacje o paliwie]
- wartość początkową paliwa
- wartość końcową paliwa
- prędkość maksymalną [dla typu track]
- prędkość minimalną [dla typu track]
- prędkość średnią [dla typu track]

Na podstawie tych danych ma być możliwość zwrócenia podsumowania 
wartości zagregowanych w ramach danego całego dnia, lub całego zadanego 
zakresu


Dodatkowe założenia:
- Większość wartości nie jest obligatoryjna, tj możemy nie znać obrotów, 
prędkości, wartości paliwa, co za tym idzie, nie możemy w takim 
przypadku zwrócić podsumowania dla takiego typu danych.
- Trasa musi mieć przynajmniej dwa recordy
- Mogą zostać później stworzone inne typy tras, które będą określane np. 
na podstawie wartości obrotów silnika
- Istnieją inne parametry, jak np. temperatura dla których też trzeba 
wykonywać operacje [wybierać wartość średnią, minimalną, maksymalną, 
różnicę między początkiem a końcem, sumę]
- Musisz założyć, że ilości wierszy przekraczają 40000 / miesiąc, co za 
tym idzie, nie powinieneś iterować kilka razy całego zakresu danych





![img](https://github.com/mariuszmilko/itsafety-task/blob/master/itsafety.png)

