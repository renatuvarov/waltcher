art $(command):
	docker exec -it waltcher-php php artisan $(command)

mf:
	docker exec -it waltcher-php php artisan migrate:fresh
