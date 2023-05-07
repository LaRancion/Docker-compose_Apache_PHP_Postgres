# Create a Docker Container with apache,php and a postgresDB managed by pgadmin


- the database is managed trough pgadmin 
- add an env folder with the enviroment variables
- set the volumes correctly
- create a user on the db and a table called users with an username and a password
- modify the parameters to connect to the db on the authenticator.php file (u can create a new user to connect also)
- form vuln have not been tested

#### TO RUN
```shell
sudo docker-compose up --build
```

the docker file helps import the php modules to connect to the db and the php to apache
