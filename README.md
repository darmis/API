
Užduotis daryta su Laravel frameworku tas susitvarkius su failais reikėtų paleisti:
php artisan migrate
php artisan db:seed

taip pat yra testas skirtas užsakymo kūrimui testuoti:
php artisan test

Naudojimas:
POST /api/create_order turi paduoti:
{
    "name" : "Uzsakymo pavadinimas", // pavadinimas iki 30 simboliu ilgio
    "country_code" : "lt", // lt/de/us
    "proxies_ordered" : 15 // max 100
}

GET /api/orders nereikia nieko paduoti, išveda pilną užsakymų sąrašą

GET /api/order reikia paduoti:
{
    "order_id" : 2 // jei yra toks uzsakymas, tada grazins informacija apie ji, jei ne - grazins pranesima
}