# MySQL Lab

1. Install MySQL Workbench
2. Copy Private Key to the .ssh Folder
2. Setup Connection to MySQL server
3. Issue Queries

## Install MySQL WorkBench

### Client-Server Architecture
Note that we will be managing databases remotely in a Database Management System (DBMS) on a virtual machine (VM) as the server. Workbench is the local client, and MySQL is the DB server. 

The installation process is similar, if not identical, with both current Windows and macOS versions. 

### Download Workbench 

MySQL Workbench is MySQL's visual tool product for data modeling, SQL development, and comprehensive administration for server configuration, user administration, backup, and much more.

To download the installer, visit MySQL Workbench website [https://mysql.com/products/workbench/](https://mysql.com/products/workbench/) and click on the **Download Now >>** button to go to the downloads page. 
   

```{figure} ../../images/mysql-workbench-download.jpg
:width: 500px
:name: mysql-workbench-download
:alt: mysql workbench download
:align: center

Download MySQL Workbench 
```

A the [MySQL Community Downloads](https://dev.mysql.com/downloads/workbench/) page, choose your OS architecture and OS version (e.g., for macOS, ARM or x86 64-bit) and click on the blue **Download** button to start downloading the installer. When asked to login, just click on **No thanks, just start my download.** below the login buttons. 

Alternatively, you can use the direct links to the download:

1. For Windows:
   1. Click on [Windows MSI installer](https://dev.mysql.com/get/Downloads/MySQLGUITools/mysql-workbench-community-8.0.43-winx64.msi) 
   2. Arriving at the Downloads page. 
   3. Click on **No thanks, just start my download.** to download.
2. For macOS: 
   1. Choose between [Arm](https://dev.mysql.com/downloads/file/?id=544377) or [x86 64-bit](https://dev.mysql.com/downloads/file/?id=544378):
   2. Arriving at the Downloads page. 
   3. Click on **No thanks, just start my download.** to download.


### Installation

1. Find your downloaded installer and double-click on it to start installation.


```{figure} ../../images/mysql-workbench-install.png
:width: 450px
:name: mysql-workbench-install
:alt: mysql workbench install
:align: center

Install MySQL Workbench 
```

2. MySQL Workbench will launch by default at the end of the installation:

```{figure} ../../images/mysql-workbench-launch.png
:width: 450px
:name: mysql-workbench-launch
:alt: mysql workbench launch
:align: center

Launch MySQL Workbench 
```

```{note}

Note that for the following are [required](https://dev.mysql.com/doc/workbench/en/wb-installing-windows.html) for the Windows version illustrated here:

- Microsoft .NET Framework 4.5.2
- Microsoft Visual C++ 2015-2022 Redistributable
- Microsoft Windows 11 or Windows Server 2022

If your computer is not too outdated, you should have met all the requirements. For the Visual C++ Redistributable requirement, the error message often specifies which version of the Visual C++ Redistributable is missing. Downloading the 2015-2022 version [Redistributable](https://nam02.safelinks.protection.outlook.com/?url=https%3A%2F%2Faka.ms%2Fvs%2F17%2Frelease%2Fvc_redist.x64.exe&data=05%7C02%7Ctchen%40mst.edu%7Cc855e7ca55ab45cb959f08ddf13d470a%7Ce3fefdbef7e9401ba51a355e01b05a89%7C0%7C0%7C638931967660714626%7CUnknown%7CTWFpbGZsb3d8eyJFbXB0eU1hcGkiOnRydWUsIlYiOiIwLjAuMDAwMCIsIlAiOiJXaW4zMiIsIkFOIjoiTWFpbCIsIldUIjoyfQ%3D%3D%7C0%7C%7C%7C&sdata=r5ixj9h5QQtSIEqODHEDWLwThdkjt4MKRSrX%2F4EUqmI%3D&reserved=0) usually helps; or just follow the instruction at the warning.

```

```{figure} ../../images/mysql-workbench-vc-redistributable-error.png
:width: 400px
:name: mysql-workbench-vc-redistributable-error
:alt: mysql-workbench-vc-redistributable-error
:align: center

MySQL Workbench Installation Requires Visual C++ Redistributable
```

## Setup MySQL Connection

### SSH Tunnel Explained
In order to connect to a MySQL DBMS remotely, we need a MySQL user account and we usually connect through default port number 3306. It is nowadays a common practice that, for security reasons, to establish an SSH (the Secure Shell protocol) tunnel through port 22 to connect to the database server with traffic encrypted.

To establish an SSH connection, we use OpenSSH, which is a free and open-source software implementing the SSH protocol and is shipped with all major modern operating systems, including Windows. To create the connection, we generate (`ssh-keygen`) a pair of keys (pubic and private) and place the `public key` in the remote host's `~/.ssh` folder and place the `private key` in the `~/.ssh` folder of the local client computer. We then log into the remote host (the SSH server) using the syntax: `ssh [user]@[IP-or-domain-name]`.

When connecting, the remote host will ask for an authentication password and, when entered correctly, the client computer logs into the remote host just like using the local computer in command line. This way, we have an encrypted channel to protect data and communication when working on the remote host over unsecured networks such as the internet.

### Copy the SSH Keys

As a security good practice, we should generate the SSH keys per client computer so we use different keys to access the remote host. In this activity, a private key is provided to you, and the public key has been placed in the `~/.ssh` directory of the remote host. Your task here, therefore, is to copy the private key into your `~/.ssh` folder. The private key looks like this:

```bash
-----BEGIN OPENSSH PRIVATE KEY-----
b3BlbnNzaC1rZXktdjEAAAAABG5vbmUAAAAEbm9uZQAAAAAAAAABAAAAMwAAAAtzc2gtZW
QyNTUxOQAAACDj9jDGmA5ioHQCZnbFC+ABPaLYk3uyfb1G8GdFlOAHeQAAAJCJyWkYiclp
GAAAAAtzc2gtZWQyNTUxOQAAACDj9jDGmA5ioHQCZnbFC+ABPaLYk3uyfb1G8GdFlOAHeQ
AAAEC8Hc8nG+3wpqrONmvPKoptjss3VOeJYifQslhJuFSWS+P2MMaYDmKgdAJmdsUL4AE9
otiTe7J9vUbwZ0WU4Ad5AAAADHR5Y2hlbkBXaW4xMQE=
-----END OPENSSH PRIVATE KEY-----
```

Follow the following steps to place the private key in your `~/.ssh` folder if you need to:

1. For Windows users, open `Notepad` or `VS Code` to create a blank text file. (For macOS users, use `TextEdit` or `VS Code` -> New Document -> paste key -> Format menu -> Make Plain Text -> File menu -> Move To... Desktop -> remove extension name .txt.)  

```{figure} ../../images/notepad-blank.png
:width: 350px
:name: notepad-blank
:alt: notepad-blank
:align: center

A Blank Notepad File
```

2. Copy and paste the private key to the file. 

```{figure} ../../images/notepad-private-key-pasted.png
:width: 350px
:name: notepad-private-key-pasted
:alt: notepad-private-key-pasted
:align: center

Paste the Key Value to Text File
```

3. *Save* the file into a location such as the Desktop using **Save as** from the File menu. Make the *File name* **dsm** (*not dsm.**txt***. In Notepad, make sure you select **Save as type** -> **All files**. Save the file. 

```{figure} ../../images/notepad-private-key-save-as-0.png
:width: 400px
:name: notepad-private-key-save-as-0
:alt: notepad-private-key-save-as-0
:align: center

Notepad **Save As**
```

```{figure} ../../images/notepad-private-key-save-as.png
:width: 400px
:name: notepad-private-key-save-as
:alt: notepad-private-key-save-as
:align: center

Save the File as **dsm** on Desktop
```


4. In File Explorer, copy the file *dsm* and paste it to your `~/.ssh` folder under your username. If the *.ssh* folder does not exist under your username folder, create it.


```{figure} ../../images/ssh-key-paste-to-ssh.png
:width: 400px
:name: ssh-key-paste-to-ssh
:alt: ssh-key-paste-to-ssh
:align: center

Copy and Paste the Key File *dsm* to Your [user-name]\\\\.ssh Folder
```


### Configure the Parameters

On the **Welcome to MySQL Workbench** home screen, click on the cross by **MySQL Connections** to set up a new connection to the remote DBMS server. You will see the *Setup New Connection* popup window.

In the *Setup New Connection* window, enter the following parameters information; note that we have two accounts here (dsm and dsm-mysql):

1. Connection Name: &nbsp;&nbsp;&nbsp;&nbsp; (enter, e.g., dsm-MySQL)
2. Connection Method: &nbsp;&nbsp;(Choose **Standard TCP/IP over SSH**)   
3. SSH Hostname: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**tychen.org:22** (or just tychen.org)
4. SSH Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;**dsm** (the account has been created)
5. SSH Key File: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(leave blank)
6. SSH Key File: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(leave blank)
7. MySQL Hostname: &nbsp;&nbsp;&nbsp;&nbsp; **127.0.0.1**
8. MySQL Server Port: &nbsp;&nbsp;&nbsp;**3306**  (the default port for MySQL)
9. Username: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; **dsm-mysql**      (the MySQL account has been created)
   
```{figure} ../../images/mysql-workbench-connect.png
:width: 575px
:name: mysql-workbench-connect
:alt: mysql workbench connect
:align: center

Connection to MySQL Workbench
```

Now go through the following steps to enter passwords and accept key signature (feel free to save the passwords in the vault):

1. Click on **Test Connection** when you have filled out all the information correctly. You should see an *Open SSH Connection* popup window asking for the **Password** of User **dsm**. Enter the password provided and click **OK**.

```{figure} ../../images/mysql-workbench-connect-linux-user-passwd.png
:width: 525px
:name: mysql-workbench-connect-linux-user-passwd
:alt: mysql workbench connect linux user password
:align: center

Connection to MySQL Server: Enter the Linux User Password
```

2. When you connect to a remote host for the first time, the two computers need to exchange key signatures. Click OK to continue.
   
```{figure} ../../images/mysql-workbench-connect-ssh-continue.png
:width: 525px
:name: mysql-workbench-connect-ssh-continue
:alt: mysql-workbench-connect-ssh-continue
:align: center

Accept Key Fingerprints to Establish First-Time Connection to Server
```

3. You will be asked for the password of the *MySQL database user* (**dsm-mysql**). Enter the password provided and click **OK**.

```{figure} ../../images/mysql-workbench-connect-mysql-user-passwd.png
:width: 525px
:name: mysql-workbench-connect-mysql-user-passwd
:alt: mysql workbench connect mysql user password
:align: center

Connection to MySQL Server: Enter the MySQL User Password
```

4. You should see the popup window saying "Successfully made the MySQL connection". Click **OK** to exit.
   
```{figure} ../../images/mysql-workbench-connect-success.png
:width: 525px
:name: mysql-workbench-connect-success
:alt: mysql workbench connection success
:align: center

Connection to MySQL Successful
```

<!-- #### Configure the SSL
In the SSL tab, enter the following information:

1. Click on the **SSL** tab
2. Choose **No** for *Use SSL*
3. Choose your SSL Key File: **C:Users\[user]\.ssh\dsm
4. Click on the OK button to finish configuring the connection.
   
If you click on the *Test Connection* button at the bottom of the SSL tab, you will be prompted twice for password: Once for the Linux server user account (dsm), and the second time for the MySQL user account (also *dsm*). Click on the OK button to finish configuring the connection.

```{figure} ../../images/mysql-workbench-ssl.png
:width: 525px
:name: mysql-workbench-ssl
:alt: mysql workbench connect ssl
:align: center
Connect to MySQL Workbench: SSL Configuration
```

You will be prompted to enter the *dsm* user password:

```{figure} ../../images/mysql-workbench-connect-ssh-password.png
:width: 375px
:name: mysql-workbench-connect-ssh-password
:alt: mysql workbench connect ssh password
:align: center
MySQL Workbench SSH Connection Password
```

Enter the password for the user *dsm* account on the VM server. You may check *Save password in vault so that you don't have to enter it every time you try to access the DBMS on the VM.  -->

<!-- Everything goes well, you will see the success popup, click Ok to exit it:

```{figure} ../../images/mysql-workbench-connect-success.png
:width: 350px
:name: mysql-workbench-connect-ssh-success
:alt: mysql workbench connect ssh success
:align: center
MySQL Workbench SSH Connection Success
``` -->

5. Click **OK** to exit out of the *Setup New Connection* window. Now your have successfully created a connection to the remote DBMS host. The connection is called dsm-MySQL or whatever you named it and it is a grey box.


## Connect to MySQL Server

1. Double-click on dsm-mysql connection to start using MySQL Workbench. You may be asked to provide passwords for the dsm Linux user account and the dsm-mysql MySQL user account if you have not saved them in the vault. 


```{figure} ../../images/mysql-workbench-start-connection.png
:width: 200px
:name: mysql-workbench-start-connection
:alt: mysql-workbench-start-connection
:align: center
Double-Click on a Connection to Connect to MySQL DBMS
```


2. For first time login, the Workbench interface may show you the *MANAGEMENT* features under the **Navigator** pane because the *Administration* tab is selected. 

```{figure} ../../images/mysql-workbench.png
:width: 550px
:name: mysql-workbench
:alt: mysql-workbench
:align: center

MySQL Workbench Interface
```

3. Find and click on the **Schemas** tab at the bottom of the Navigator pane.  

```{figure} ../../images/mysql-workbench-schema-tab.png
:width: 550px
:name: mysql-workbench-schema-tab
:alt: mysql-workbench-schema-tab
:align: center

Find and Click the Schema Tab to Show Schemas (Databases)
```

 4. After clicking on the *Schemas*, the *Navigator* pane shows **SCHEMAS** (databases). In our case here, we have the **employees** database

```{figure} ../../images/mysql-workbench-schema.png
:width: 550px
:name: mysql-workbench-schema
:alt: mysql-workbench-schema
:align: center

Choose the Schema Tab to Show Schemas
```


5. Now that we see the database server *employee*, let's right click and choose it to **Set as Default Schema** so we can start using this employees database.


```{figure} ../../images/workbench-set-default-schema.png
:width: 375px
:name: workbench-set-default-schema
:alt: workbench-set-default-schema
:align: center

Set Default Schema
```


## First Query

In the query editor, type your SQL query and use the **flash** icon to execute/run the query. The query results will show in the *Result Grid*. You may choose the **Beautify broom** to beautify your code. 


```{figure} ../../images/query-departments.png
:width: 450px
:name: query-departments
:alt: query-departments
:align: center

A Simple Query
```