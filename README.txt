Architected so that it uses:

1) Model, View, Controller
2) A Front Controller which implements a finite state machine.
	All requests go through index.php

This combination allows

a) Separation of concerns (M/V/C)
b) The application can move from any page to any other page
c) Easy to extend and expand code
e) Self documenting code. Nothing is hidden more than a file away.

A CSC309 Project created by Daniel Razavi and Shuprio Shourovs.
Mainly used PHP and HTML and forbidden to use Javascript.

A online social media website where users can play 4 simple games, discuss and set records amongst site users. The users also have the ability to delete their own accounts off of our PSQL based database. Implemented and tested on UTM (University of Toronto Mississauga) Web Servers. 
