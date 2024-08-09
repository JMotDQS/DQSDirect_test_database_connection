#bashCopy code#!/bin/bashssh -f -i ssh_key_pair_token.pem -N -L
bashCopy code#!/bin/bashssh -f -i dqs.ppk -N -L
22:localhost:3306
ec2-user@ec2-3-14-37-218.us-east-2.compute.amazonaws.com

#bashCopy code#!/bin/bashssh -f -N -L
#local_port:remote_db_host:remote_db_port
#user@remote_host

#local_port:		22
#remote_db_host:	localhost
#remote_db_port:	3306
#user:				root
#remote_host:		ec2-3-14-37-218.us-east-2.compute.amazonaws.com
#key file:          ssh_key_pair_token.pem