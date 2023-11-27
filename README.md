# First thing First

1. Laravel 9
2. Dockerize
   - php8.1-fpm-buster
   - docker build -t name:tags_version .
   - edit docker-config/docker-compose.yaml for using it
3. Update env 
4. Bind Mount DB File to ../storage/app/...
5. Generate base64 key for env be
   - openssl rand --base64 32
  
6. Run DB Migration (Exec to Container)
   - php artisan migrate

# Support

[Buy me a Coffee](https://trakteer.id/captainAldi/link)