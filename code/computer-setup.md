---
layout: page
title: Computer Setup
---

***You are encouraged to set up your computer before the end of the first week of the class.***

### Terminal/CLI



### Python

Download and install [Python](https://www.python.org/downloads/){:target="_blank"} (choose one minor version[^1] behind the current version; e.g., if the current version is 3.13, download 3.12 instead). 

### venv and pip

A Python virtual environment keeps specific Python version and required software dependencies of a project separate from the system-installed Python and packages. Inside your project folder, create a virtual environment by issuing`python3.12 -m venv .venv`[^2] in the command line. To activate the venv, issue`source .venv/bin/activate`and your will see`(.venv)`in the front of the shell prompt denoting the venv activated. 

With`venv`activated, use`pip`, the package managemnet software for Python, to install packages and the packages will be installed in`.venv/lib/python<i>VERSION</i>/site-packages`. 

### VS Code
Download and install the most recent stable build of [Visual Studio Code](https://code.visualstudio.com/){:target="_blank"} (VSCode/VS Code), an extension-based code editor. Learn how to set up VSCode by watchign a video such as [Setup Visual Studio Code](https://code.visualstudio.com/learn/get-started/basics). 

### Jupyter Notebook
With venv enabled, install jupyter Notebook with`pip install notebook`. Toe run the notebook, go to the command line, change into your Jupyter Notebook project directory, and run`jupyter notebook`. You should see the project directory open in browser. Click on`New`-->`Python3(ipykernel)`to create a new notebook. 

### Git and GitHub

1. Create an account on [GitHub](https://github.com).
2. Send your Github username to your instructor.
3. Once your instructor adds you to the course GitHub organization, you will receive an email asking you to join the organization. Accept the invitation.
4. Go to github.com and click on the drop down with your name in the upper left corner. You should see the name of the course GitHub organization.


Issue`git --version`at terminal to check if git is installed. If not, 
1. go to [git-scm.com](https://git-scm.org), download and install git; or 
2. Depends on your operating system:
   1. Linux:`sudo apt install git`for Debian/Ubuntu and`sudo yum install git`for Fedora.
   2. macOS:`brew install git`(install [Homebrew](https://brew.sh) first). 
   3. Windows: use [Git for Windows](https://gitforwindows.org/). 


### SQL

Download and install [DB Browser for SQLite](http://sqlitebrowser.org/){:target="_blank"}


***

#### Notes:

[^1]: Semenatic Versioning suggests version numbers in the format of MAJOR.MINOR.PATCH and each segment increments in specific conditions. See [semver.org](https://semver.org/){:target="_blank"} for more information about versioning. 
[^2]:`.venv`is a convention and you can name the virtual environment folder anything you want. Note that`python3.12 -m venv .venv`will create the venv with Python version 3.12 whereas`python -m venv .venv`will create the venv with the version of your system default Python. Here`-m`means "module" so you know that here python is running the`venv`module to create a virtual environment.  