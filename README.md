# Tribe Car exercise

This repository is done for Tribe Car's coding interview. There are 2 methods to install: Cloud Installation and Localhost Installation

# Scenario

To develop a simple visitor log system for a condominium manager.

In this system, the manager will be able to manage basic information of tenants/occupants staying in the condominium and track visitors who visit the condominium.

Information of each unit consists of block & unit number, occupant name, contact number. The manager will be able to create units in the condominium, viewing a list of all the units, viewing details of a single unit, updating detail or delete the unit.

The manager will need information of each visitor's name, contact number, unit visiting, last 3 digits of NRIC, and datetime of entry & exit. The manager will be able to view the visitors log for the past 3 months, and edit the exit datetime if necessary, the manager requires to search by the unit number as well in the visitors log.

Visitors will be required to fill in the visit form at the security booth. Visitors will need to fill in the block & unit number which they are visiting, or might just go to the function room for an event. Due to covid-19 measures, the system must be able to prompt the guard to deny entry to visitor(s) if the unit has a maximum up to 5 visitors.

System will be able to determine if it is the same visitor by their unique contact number & last 3 digits of NRIC, the manager can view this visitor when and which units he/she visited.

# Cloud installation

## Pre-requisites to Cloud installation

- You must have an AWS User Account with Access Key and Secret
- Have AWS CLI installed on your machine
- Have AWS configure done with your ACCESS KEY and SECRET on your machine
- Have Terraform installed

## Installation

Navigate to the ./build/terraform folder and run the following command to set up your AWS infrastructure and CICD pipeline

```bash
terraform apply
```

Go to your AWS console and navigate to your developer tools to setup your _code star connection_. You need connect your Github Account to your code star in order to run this repository.

Then go to your _CodePipeline_ and do a "__release change__" on "__tribecarexercise-codepipeline__" pipeline.

## AWS Infrastructure

- 2 public subnets in 2 Availability Zones for High Availability deployment
- 2 private subnets in 2 Availability Zones for High Availability deployment
- RDS is deployed in private subnet for security
- CakePHP is deployed in Fargate in public subnet, behind a [load balancer](http://tribecarexercise.shurn.me/)
- CICD pipeline is automatically triggered upon git push

# Localhost Installation

## Pre-requisites to Localhost installation

- You must install [Lando](https://docs.lando.dev/).

## Installation

At the application root folder, run the following command:

```bash
lando start
```

## Running Unit Test

At the application root folder, run the following command:

```bash
lando phpunit
```

## Running Database migrations

At the application root folder, run the following command:

```bash
lando cake migrations migrate
```