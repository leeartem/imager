docker compose up -d \
&& docker compose run --rm composer i \
&& docker compose run --rm artisan migrate:refresh \
&& docker compose run --rm npm i \
&& docker compose run --rm --service-ports npm run dev