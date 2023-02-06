# Api-task-manager
Api-task-manager it's a Rest API to manage tasks, without autentification.

You can create, update, get, delete and list tasks at local JSON file stored at ../storage/tasks.json.

Docker use static IPs 192.168.55.11 and 192.68.55.10, please check are available at your local system.

## Stack
- [Laravel](https://laravel.com/docs/9.x) v9.50.2
- [PHP](https://www.php.net/releases/8.1/en.php) v8.1.15
- [Nginx](https://www.nginx.com/) 
- Docker

## Endpoints

| #   | Endpoint        | Type   | Description       | Example                         |
|-----|-----------------|--------|-------------------|---------------------------------|
| 1   | /tasks          | GET    | List of tasks     | http://192.168.55.11/api/tasks  |
| 2   | /tasks          | POST   | Create a new task |http://192.168.55.11/api/tasks |
| 3   | /tasks/{taskId} | GET    | Get task by Id    | http://192.168.55.11/api/tasks/1|
| 4   | /tasks/{taskId} | PUT    | Update task       |http://192.168.55.11/api/tasks/2 |
| 5   | /tasks/{taskId} | DELETE | Delete task by Id |http://192.168.55.11/api/tasks/3 |

## Project set up

### Install and run the application.
Please, execute these command at your local path to configure the application and set permissions (sorry, I know chmod command it's a little bit weird).



Clone from github and set permissions
```
git clone git@github.com:amancho/api-task-manager.git
sudo chmod 777 -R api-task-manager/
cd api-task-manager
```

Run up docker
```
docker/composer install
docker/up
```

Check at your web browser
```
http://192.168.55.11
```

Check at your terminal
```
curl -X GET http://192.168.55.11/api/tasks -H 'Accept: application/json'
curl -X GET http://192.168.55.11/api/tasks/1 -H 'Accept: application/json'
```

Run tests
```
docker/test
```
