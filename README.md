# Siyavula
Our mission is to create and enable engaging, integrated, high-quality learning experiences in Mathematics and the Sciences; to have a long-lasting, enriching impact on learners and teachers in South Africa and globally; to constantly seek out and build the most relevant, effective technology whilst remaining rooted in the science of learning and instruction; and to engage and motivate young minds, helping them to master and develop the skills our future needs.

Learn more: https://www.siyavulaeducation.com/

## Siyavula Practice
Siyavula Practice is an online Maths and Physical Sciences practice service for high school learners. The program provides learners with virtually unlimited questions that become progressively more difficult as correct answers are given. Because Siyavula’s practice adapts to the needs of the person practising by changing the difficulty and sequencing of questions, learners can progress at their own pace. They receive immediate feedback on the questions they do, with step-by-step solutions, and errors and misconceptions are corrected in real time.  Siyavula Practice can be used by anyone with a computer, tablet or mobile phone (both smart and feature phones are supported) and an internet connection.

Learn more: https://www.siyavula.com/

# Siyavula Practice API
The Siyavula Practice API provides an easy way to integrate Siyavula Practice into any application via a RESTful API.

[Documentation](https://docs.google.com/document/d/1Xo3uW-p0YdPo7m9LN7_W_QgHTo9PFtwxU2MTUNVaBZo/edit?usp=sharing)

## Siyavula Practice API PHP Demo
This repo serves as a demo application written in [PHP](https://www.php.net/) to integrate with Siyavula's Practice API.  To authenticate with the API you will need API credentials.  If you do not yet have credentials, please contact sales@siyavula.com.

**Please note**: this is only a demo application, the code was written to be as easy to understand as possible and as such might lack features you would expect in production level code.

## Requirements
* PHP >= 7.4.3
* php-curl
* Linux

## Installation
#### Clone the repo
    git clone git@github.com:Siyavula/practice-api-php.git
#### Go to the `practice-api-python` directory
    cd practice-api-php
#### Make a personal `.env` copy
    cp .env my.env
#### Set your username and password in `my.env`
#### Start the app
    ./start.sh
#### Go to http://localhost:8001/responsive.php or http://localhost:8001/basic.php
