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

# Shortcuts
Due to circumstance, time, and cost constraints, the following shortcuts were taken and how in actual production I would have done differently:

- I would done 3 or more git branches in an actual git for proper deployment cycle
  - release/prod
  - release/uat
  - release/dev
- I would have done feature branching that corresponds to JIRA or Trello tickets and do _Pull Request_ for code reviews, like:
  - feature/ABC-1
  - hotfix/XYZ-2
- There is only 1 environment in AWS. Ideally, there should be 3, corresponding to the 3 release branches in git. I didn't do it for cost-savings since the 3 environments are identical.
- There should be an independent terraform git repo and its own pipeline in AWS to ensure a more secure AWS account. It will also allow multiple DevOps to modify the terraform git repo and deploy with S3 state storage and DynamoDB for state-locking. See: [https://learn.hashicorp.com/tutorials/terraform/aws-remote?in=terraform/aws-get-started](https://learn.hashicorp.com/tutorials/terraform/aws-remote?in=terraform/aws-get-started)
- The password for database should not have been stored in terraform script or in the codes. It should have been stored in [AWS Secrets Manager](https://aws.amazon.com/secrets-manager/) or [AWS Parameter Store instead](https://docs.aws.amazon.com/systems-manager/latest/userguide/systems-manager-parameter-store.html).
- The ECS cluster should have auto-scaling feature so that it can scale the app with varying traffic loads.
- The RDS database should have been [Aurora Serverless v1](https://docs.aws.amazon.com/systems-manager/latest/userguide/systems-manager-parameter-store.html) and have CloudWatch schedule a regular ping of about 5 minutes. This way, the database can scale with the ECS cluster without Aurora going through cold start.
- The CICD deployment should be Blue/Green instead.
- No VPN and VPN gateway was created. I would have either used [OpenVPN](https://shurn.me/blog/2016-12-19/creating-a-hybrid-data-centre-with-openvpn) or [WireGuard](https://www.wireguard.com/) so that the private subnet is accessible from corporate network. That also means the RDS is not accessible unless there is a VPN setup or there is an EC2 instance in Public Subnet to SSH/RDP into.
- No redis cache was created to store PHP sessions. I would have created a [ElastiCache Redis Cluster](https://aws.amazon.com/elasticache/redis/) to store sessions, so that the PHP app is stateless.