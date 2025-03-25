start:
	concurrently "php artisan serve" "npm run dev" "docker-compose up -d"

stop:
	-concurrently --kill-others "npm stop" "pkill -f 'npm run dev'" "pkill -f 'php artisan serve'"
	docker-compose down
