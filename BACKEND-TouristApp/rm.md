for migrations locations:
php artisan migrate --path="database/migrations/2023_02_16_091951_create_locations_table.php"

for seeding locations:
php artisan db:seed --class=LocationSeeder

migration places:
php artisan migrate --path="database/migrations/2023_02_16_111221_create_places.php"

seeding places:
php artisan db:seed --class=PlaceSeeder
