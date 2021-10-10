# single-player-tic-tac-toe
Single-player tic-tac-toe game written in PHP, HTML, CSS (Bootstrap), and JavaScript (JQuery).

Deployment Instructions

1. Download the code (and unzip it), or git clone it:

> git clone https://github.com/karimw786/single-player-tic-tac-toe.git

2. Change into the directory:

> cd single-player-tic-tac-toe

3. If deploying on a Docker container, run the following commands:

> docker build -t two-player-tic-tac-toe .
> docker run -d -p 80:80 -p 8080:8080 two-player-tic-tac-toe

Otherwise, simply put the code in your web server's document root.

4. Open your web browser and navigate to: http://127.0.0.1
