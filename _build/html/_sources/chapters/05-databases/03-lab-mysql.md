# MySQL Labs

1. Install MySQL Workbench
2. Connect to MySQL server
3. Issue Queries

## Install MySQL WorkBench

### Client-Server Architecture
Note that we will be managing databases remotely in a Database Management System (DBMS) on a virtual machine (VM) as the server. Workbench is the local client, and MySQL is the DB server.

### Download Workbench 

MySQL Workbench is MySQL's visual tool for data modeling, SQL development, and comprehensive administration for server configuration, user administration, backup, and much more.

1. Download: Visit MySQL website [Visit https://mysql.com/products/workbench/](https://mysql.com/products/workbench/) and download MySQL Workbench. 
   

```{figure} ../../images/mysql-workbench-download.jpg
:width: 650px
:name: mysql-workbench-download
:alt: mysql workbench download
:align: center

Download MySQL Workbench 
```

The webpage will select the right OS version for you and, when asked to login, just click on **No thanks, just start my download.** For Windows, there is only one installer. For macOS, choose your correct architecture (Arm or x86 64-bit). 

Or, you can use the direct links to the download:
1. For [Windows MSI installer](https://dev.mysql.com/get/Downloads/MySQLGUITools/mysql-workbench-community-8.0.43-winx64.msi)
2. For macOS, you need to choose from [Arm](https://dev.mysql.com/downloads/file/?id=544377) or [x86 64-bit](https://dev.mysql.com/downloads/file/?id=544378).  


### Install Workbench

1. Find your downloaded installer and double-click on it to start installation.


```{figure} ../../images/mysql-workbench-install.png
:width: 550px
:name: mysql-workbench-install
:alt: mysql workbench install
:align: center

Install MySQL Workbench 
```

2. MySQL Workbench will launch by default like below:

```{figure} ../../images/mysql-workbench-launch.png
:width: 500px
:name: mysql-workbench-launch
:alt: mysql workbench launch
:align: center

Launch MySQL Workbench 
```

### Setup a Connection

From the MySQL Workbench home screen, click on the cross by **MySQL Connections** to set up a new connection to your remote DBMS server. You will see the popup window like:

```{figure} ../../images/mysql-workbench-connect01.png
:width: 450px
:name: mysql-workbench-connect01
:alt: mysql workbench connect 01
:align: center

Connect to MySQL Workbench 01
```


