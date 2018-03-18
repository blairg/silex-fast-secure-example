# silex-fast-secure-example

## To run
- Assuming you've cloned the repo and got docker and docker compose installed.
- In a terminal `docker-compose up`.
- In another terminal (install dependencies) `docker exec -it silexfastexample composer install`
- In Postman (or similar), do a POST request to `http://localhost:8080/login`, with form data of `username = blair and password = faaffb29045551ae3d58137308012a`.