# Redis Messaging System

[![Build Status](https://travis-ci.org/adrianosferreira/microservice-messaging.svg?branch=master)](https://travis-ci.org/adrianosferreira/microservice-messaging)
[![Build Status](https://codecov.io/gh/adrianosferreira/microservice-messaging/branch/master/graph/badge.svg)](https://codecov.io/gh/adrianosferreira/microservice-messaging)


This is a very basic example of how to implement a messaging system for a microservice architecture using Redis, Symfony, and Docker.

![Microservice Message Broker](draw.png "Microservice Message Broker")

The complete system is divided into Customer Service, Order Service, and a Message Broker. Check below more details about each service. 

## Customer Service

It is responsible by managing customer's data. It stores data in a MySQL database table and provides a REST api containing two endpoints, one for creating a customer and one for listing existing customers.

This service is connected into Redis for publishing a message when new customers are added. This message will be used later by the Order Service for adding an order for this customer.

## Order Service

It is responsible by managing order's data. It stores data in a MySQL database table and provides a REST api containing a single endpoint for listing all the existing orders.

This service contains a daemon system, which subscribes into Redis in order to be notified as soon as a new customer is added. Then, it adds the new order on database for the customer.

## Message Broker (Redis)

Redis comes with a powerful pub/sub system, so here it is used in order to publish and subscribe into a particular channel for making the isolated systems talk to each other.