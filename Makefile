up:
	docker compose up
d:
	docker compose up -d
s:
	docker compose stop
o:
	docker compose run --rm artisan optimize
m:
	docker compose run --rm artisan migrate
fix:
	docker compose run --rm php chmod -R 777 storage
reset:
	docker compose run --rm artisan migrate:refresh --seed