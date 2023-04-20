FROM ubuntu:20.04
RUN apt-get update -y && apt-get install supervisor openjdk-8-jdk-headless -y

RUN useradd mineme && mkdir /app

COPY ./app /app
COPY ./supervisor.conf /etc/supervisor.conf
COPY ./flag.txt /flag
RUN chown root:root /app
RUN chmod -R o-w /app/
RUN chmod 1777 /app
RUN touch /var/log/supervisor/mineme.log && chmod o-r /var/log/supervisor/mineme.log

EXPOSE 25565

CMD ["supervisord", "-c", "/etc/supervisor.conf"]
