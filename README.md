<h1 align="center">Simple LEMP-project with docker</h1> 

<h2> Тechnologies</h2>
<p align="center">🐘 PHP | 🎨 Nginx | 🐬 MySQL | 🐳 Docker</p>

<h2> Functions</h2>
<p>- 📝 Guest Book</p>
<p>- 🗄️ MySQL database  </p>
<p>- 🐳 Docker containerization</p>

<h2> Description</h2>

This is a simple application in which you **enter your name and message**, and the data is saved in the database. You can **see the history** of past recordings, who recorded when and what.

<img width="968" height="718" alt="Image" src="https://github.com/user-attachments/assets/977cb631-6bfe-46b5-81dd-ee7076eab2ce" />

Docker aggregates **three services** (nginx, php and mysql) into one network. 

A **php application** is being built inside docker compose, which is not very good for real work, but in order to simplify the work in the example, this step was left as it is.

```
php:
      build: ./php
      restart: unless-stopped
      environment:
       MYSQL_HOST: ${MYSQL_HOST}
       MYSQL_DATABASE: ${MYSQL_DATABASE}
       MYSQL_USER: ${MYSQL_USER}
       MYSQL_PASSWORD: ${MYSQL_PASSWORD}
```

In general, **nginx** receives the request from the client, processes it, sends it to the backend server, where my **php application** works with the data from the request, saves the data to the **mysql database**, after which the response goes back to nginx, and then to the client.

**СI tests** for push and pull requests have also been added: checking for container building, running, php syntax, and website loading.


<h2> Installing</h2>

It's simple - download, and then write command:

```
docker compose up --build -d
```
And run to check http://localhost!   😊

## Other

It is important to note that the size of the entire image turned out to be only 125 MB!
<p></p>
<img width="858" height="108" alt="Image" src="https://github.com/user-attachments/assets/55abf662-bd32-4fc9-990c-c750404918cb" />
<p></p>

Аnd for correct operation, variables were added so that no one else could access them.

<img width="774" height="370" alt="Image" src="https://github.com/user-attachments/assets/20784621-5e6f-4a56-9f31-697bad60a721" />

<h2>Author</h2>

<p>Veronika Stanchyk 💕</p>
<p>My contacts:</p>
<p>📩E-mail: stanchyk.vv@gmail.com</p>
<p>💬Telegram: @kirin_20_1</p>

<img width="1024" height="88" alt="Image" src="https://github.com/user-attachments/assets/76fe6b6f-ef6e-4e8d-8517-f3bed1707ba1" />

This is my first project, I hope you like it.🥰
<p></p>
<p>P.S. Click here! ⬇️</p>

<img src="https://readme-jokes.vercel.app/api" alt="Jokes Card" />
