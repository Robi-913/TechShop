# E-Commerce Website - PHP & OOP

## Despre
Acest proiect este un website complet de e-commerce dezvoltat integral în PHP, utilizând o arhitectură profesională bazată pe Model-View-Controller (MVC) și concepte de Programare Orientată pe Obiecte (OOP). Website-ul permite utilizatorilor să vizualizeze produse, să consulte detalii individuale, să adauge produse în coșul de cumpărături, să finalizeze comenzi și să vizualizeze rapoarte și istoricul achizițiilor.

Proiectul integrează o bază de date creată în MySQL (via XAMPP), utilizând interacțiuni cu baza de date prin intermediul unui strat de DAO (Data Access Objects), gestionând astfel operațiunile de creare, citire, actualizare și ștergere (CRUD) într-un mod eficient și modular.

## Caracteristici

### 1. Pagina Principală
- **Listă produse:** Afișează o listă de produse disponibile cu imagini, descriere scurtă și preț.
- **Buton Detalii:** Fiecare produs are un buton "Detalii" care duce la pagina cu informații detaliate despre produs.

### 2. Pagina de Detalii Produs
- **Informații complete despre produs:** Utilizatorii pot vedea o descriere detaliată, prețul, disponibilitatea în stoc și alte caracteristici ale produsului.
- **Adăugare în Coș:** Există opțiunea de a adăuga produsul în coș direct din această pagină.

### 3. Coș de Cumpărături
- **Vizualizare și gestionare produse:** Utilizatorii pot vizualiza produsele adăugate în coș, actualiza cantitatea sau elimina articole.
- **Calcul automat al prețului:** Prețul total al coșului este calculat automat pe baza produselor adăugate.
- **Funcționalități complete:** Utilizatorii pot finaliza comanda, reveni la pagina produselor sau modifica articolele din coș.

### 4. Pagina de Checkout
- **Finalizare comenzi:** Această pagină permite utilizatorilor să verifice lista produselor din coș, să confirme totalul și să finalizeze comanda.
- **Procesare comandă:** După plasarea comenzii, detaliile sunt salvate în baza de date și sunt disponibile pentru vizualizare ulterioară în istoricul comenzilor.

### 5. Istoric Comenzi
- **Vizualizare comenzi anterioare:** Utilizatorii pot vedea toate comenzile plasate anterior, împreună cu detaliile fiecărei comenzi.
- **Detalii comandă:** Fiecare comandă din istoric include data achiziției, produsele cumpărate, cantitățile și suma totală.

### 6. Raport Produse Ieftine
- **Produse sub 100 RON:** Această pagină raportează toate produsele care au fost achiziționate și care au un preț mai mic de 100 RON.
- **Cantitate achiziționată:** În raport sunt incluse și cantitățile cumpărate pentru fiecare produs ieftin.

## Structura Proiectului

### 1. **Controllers**
- Fiecare controller gestionează logica specifică unei secțiuni a aplicației. Controllers preiau cererile HTTP, interacționează cu modelele și trimit rezultatele către vizualizări.

### 2. **DAO (Data Access Objects)**
- Acest strat gestionează interacțiunile directe cu baza de date. Fiecare entitate din baza de date (produse, comenzi, etc.) are un DAO asociat care efectuează operațiunile CRUD (Create, Read, Update, Delete).

### 3. **Models**
- Modelele reprezintă structura datelor și logica de afaceri a aplicației. Acestea definesc obiectele și relațiile dintre date, pe care DAO-urile le manipulează.

### 4. **Views (HTML/CSS)**
- Vizualizările reprezintă partea front-end a aplicației. Fiecare pagină afișată utilizatorilor este construită folosind HTML și CSS pentru a oferi o experiență de utilizare intuitivă și responsive.

---

## Autor
- **[Numele tău]**
