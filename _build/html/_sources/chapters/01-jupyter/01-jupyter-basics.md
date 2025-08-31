---
jupytext:
  cell_metadata_filter: -all
  text_representation:
    extension: .md
    format_name: myst
    format_version: 0.13
    jupytext_version: 1.17.2
  formats: md:myst
kernelspec:
  name: python3
  language: python
  display_name: Python 3 (ipykernel)
---

# Jupyter Notebook: The IDE

We are going to use Jupyter Notebooks intensively in this course. Jupyter Notebook is an important part of the Python ecosystem and is widely used by the data science and machine learning community for its capability of combining code and notes together. As an alternative, you can use Google Colab, which is actually also Jupyter Notebook. This chapter provides a comprehensive overview of the Jupyter Notebook system, including how to install it, how to use it effectively, and how to navigate its environment.

````{note}
Some prefer to use Anaconda to manage Jupyter Notebook. We use the Python package installer ```pip``` for simplicity and better project control. The popular IDE VS Code can also run Jupyter Notebook, but the user experience is different and we will use Jupyter Notebook in this course.
````

The best way to install and configure Jupyter Notebook is to create a Python virtual environment. To do that, we need to use the Command Line Interface (CLI) in the computer. To install and start using Jupyter Notebook, follow the four steps below: 

1. Install Python
2. Create Project directory
3. Create and enable a Python virtual environment (.venv)
4. Start Jupyter Notebook

## 1. Python installation

In this course, we will use Python 3.12.2 because we want to use an autograder in Jupyter Notebook to give you instant feedback on your answer to the questions to help you with your learning. It is not uncommon for an OS to have multiple Python installations so you may install different versions of Python and the OS should handle that automatically. One thing we want to ensure happening is that we want the path of our target Python version to be added to the OS's environment variable ($PATH), which sometimes will require some attention.

### 1.1. Python for macOS
If you are using macOS, you already have a version of Python shipped with the OS. You may issue the following commands in the command line (Terminal.app) to see the version of the current system default Python version.  

```bash
$ python --version
$ python3 --version
```

If you don't have Python 3.12.2, go to python.org and download the installer of the specific version and install it. After installation, check to see if the intended version is installed:
```bash
$ python3.12
Python 3.12.10 (main, May 22 2025, 21:57:53) [Clang 14.0.0 (clang-1400.0.29.202)] on darwin
Type "help", "copyright", "credits" or "license" for more information.
>>>
```

### 1.2. Python for Windows
For Windows OS users, Windows not ship with a Python by default. Since Python is widely used, your computer may have various versions of Python installed. To check if Python is installed and what versions, use the Windows py launcher (```py.exe```) or ```where python``` in Command Prompt (cmd.exe) and you may see:

```bash
C:\Users\[user]> py -0      ### this should list all the installations known by the py launcher
 -V:3.12 *        Python 3.12 (64-bit)
```

```bash
C:\Users\[user]> where python
C:\Users\[user]\AppData\Local\Programs\Python\Python312\python.exe    ### python.org installer installation
C:\Users\[user]\AppData\Local\Microsoft\WindowsApps\python.exe        ### Windows Store installation
```
When checking the Python version of the second Python above (Windows Store version), we see that in this case it is a current version: 3.13.7. 
```bash
C:\Users\[user]\AppData\Local\Microsoft\WindowsApps>python.exe
Python 3.13.7 (tags/v3.13.7:bcee1c3, Aug 14 2025, 14:15:11) [MSC v.1944 64 bit (AMD64)] on win32
Type "help", "copyright", "credits" or "license" for more information.
>>> 
```

Windows by default will bring you to Windows Store for the installation of the current version of Python. However, the path of the Python installed will not be added to the PATH environment variable. It is therefore recommended to download the Python 3.12.2 installer from python.org for installation. 

When installing Python by downloading the Python installer from python.org, make sure that you check the options:
  - Use admin privileges when installing py.exe
  - Add python.exe to the PATH environment variable

```{figure} ../../images/python_windows_install.png
---
width: 400px
name: python_windows_install
---
Python Installation Options in Windows
```

After completing the installation with the Python installer, let's check the installations:
```bash
PS C:\Users\[user]> py -0
 -V:3.13 *        Python 3.13 (64-bit)
 -V:3.13-arm64    Python 3.13 (Store)
 -V:3.12          Python 3.12 (64-bit)
PS C:\Users\[user]>
```
In Command Prompt, we see:
```bash
C:\Users\[user]>where python
C:\Users\[user]\AppData\Local\Programs\Python\Python313\python.exe
C:\Users\[user]\AppData\Local\Programs\Python\Python312\python.exe
C:\Users\[user]\AppData\Local\Microsoft\WindowsApps\python.exe
```

After the last installing Python3.12.2, we see that the Python launcher `py` shows that our default Python is 3.12.2.  

```{figure} ../../images/python_windows_py.png
---
width: 450px
label: python_windows_py
name: python_windows_py
---
Check Python Installation in Windows
```

### 1.3. Default Python Version
In some cases we need to control the version of Python that we use instead of just using the system default version. In Windows, you may use the Python launcher to decide which Python version to use. For example:
```bash
C:\Users\[user]>py -3.12
Python 3.12.2 (tags/v3.12.2:6abddd9, Feb  6 2024, 21:26:36) 
[MSC v.1937 64 bit (AMD64)] on win32
Type "help", "copyright", "credits" or "license" for more information.
>>>
```

We can also change the system default Python version by moving the path of the desired version of Python to the top of the path list:
```{figure} ../../images/python_EV_order.png
---
width: 450px
label: python_EV-order
name: python_EV-order
---
The top Python path is the default Python
```

This will point ```python``` to our desired version:

```bash
PS C:\Users\[user]> python
Python 3.12.2 (tags/v3.12.2:6abddd9, Feb  6 2024, 21:26:36) 
[MSC v.1937 64 bit (AMD64)] on win32
Type "help", "copyright", "credits" or "license" for more information.
>>>
```

In macOS, similarly, the last installed Python version (using python.org installer) will be the system default version, which we would like it to be 3.12.2. 

```bash
$ python
Python 3.12.2 (v3.12.2:6abddd9f6a, Feb  6 2024, 17:02:06) 
[Clang 13.0.0 (clang-1300.0.29.30)] on darwin
Type "help", "copyright", "credits" or "license" for more information.
>>> 
```
Or, we may add the desired version number after `python`:
```bash
$ python3.12
Python 3.12.2 (v3.12.2:6abddd9f6a, Feb  6 2024, 17:02:06) 
[Clang 13.0.0 (clang-1300.0.29.30)] on darwin
Type "help", "copyright", "credits" or "license" for more information.
>>> 
```

## 2. Creating Project Directory
In general, when we create a project, it means we are creating a folder/directory. To use a project directory, we use the CLI of your OS. Since they are CLI rather than GUI, we need to use commands to achieve this. Although this can be done with a file manager (GUI), learning how to use the CLI helps in the long run. The three shell commands that we use here are: `ls` ("list storage"), `cd` ("change directory"), and `mkdir` ("make directory"). 

For the purpose of this course, we want to create a `workspace` directory inside your user home directory, and a `dsm` directory inside the `workspace` directory. 

Note that macOS and Linux use forward slash for directory separator, while Windows use backward slash as separator but can also interpret forward slashes.  

```bash
PS C:\Users\[user]> mkdir workspace
    Directory: C:\Users\[user]
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----         8/31/2025   3:14 AM                workspace

PS C:\Users\[user]> cd workspace
PS C:\Users\[user]\workspace> mkdir dsm
    Directory: C:\Users\[user]\workspace
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----         8/31/2025   3:14 AM                dsm

PS C:\Users\[user]\workspace> cd dsm
PS C:\Users\[user]\workspace\dsm>
```

After issuing the above commands, you will have a project directory (`dsm`) inside the workspace directory and your current location is inside the project directory. 

## 3. Python Project venv
While you are in the project directory, we will create a Python virtual environment for the project. This means that we are going to place all packages (dependencies) we use in the virtual environment instead installing the dependencies in the system Python, which is prone to conflicts. To install the packages in the project virtual environment also means that we are making this environment portable, meaning we can replicate the dependencies in another project or device. In addition to the installed project, the virtual environment also contains a link to the desired Python. 

To create the virtual environment for the project, we issue the command as `python -m venv .venv`, in which python is the desired version of Python, `-m` means module, `venv` is the module that creates virtual environment, and `.venv`, as a convention, is the name of the project virtual environment.  

```bash
PS C:\Users\[user]\workspace\dsm> python -m venv .venv
PS C:\Users\[user]\workspace\dsm> ls
    Directory: C:\Users\[user]\workspace\dsm
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----         8/31/2025   3:36 AM                .venv

PS C:\Users\[user]\workspace\dsm>
```

Using the command `ls` we see that the virtual environment `.venv` is created. 
```bash
PS C:\Users\[user]\workspace\dsm> ls
    Directory: C:\Users\[user]\workspace\dsm
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----         8/31/2025   3:36 AM                .venv
```

In macOS, you will not see the **.venv** folder because directories begin with a dot are hidden directories. To see the .venv virtual environment in macOS, use the `-a` option:

```bash
$ ls -a
.     ..    .venv
```

In case the default Python is different from the desired version, you may use the version suffixes to designate the desired Python version. For Windows, use the Python launcher:
```bash
PS C:\Users\[user]\workspace\dsm> py -3.12 -m venv .venv
```
For macOS, place the version number after `python`:
```bash
$ python3.12 -m venv .venv
```

Inside the .venv virtual environment directory, there is a lib/Lib directory containing a folder called **site-packages**, which is where all the project installation would go into. In Windows, it looks like this:

```bash
PS C:\Users\[user]\workspace\dsm\.venv> ls .\Lib\site-packages\
    Directory: C:\Users\[user]\workspace\dsm\.venv\Lib\site-packages
Mode                 LastWriteTime         Length Name
----                 -------------         ------ ----
d-----         8/31/2025   3:36 AM                pip
d-----         8/31/2025   3:36 AM                pip-24.0.dist-info
```

In macOS, it looks like this:
```bash
[user]@[host]ː~/workspace/dsm/.venv$ ls lib/python3.12/site-packages/
pip                pip-24.0.dist-info
```

## 4. Activating venv

To activate your virtual environment, in the CLI, make sure you are in the project directory and type the following command to activate the project virtual environment. After the virtual environment is activated, a prefix ("(.venv)") will be present in front of the CLI prompt. 

```bash   ### macOS
[user]@[host]ː~/workspace/dsm$ source .venv/bin/activate
(.venv) [user]@[host]ː~/workspace/dsm$   
```
```bash
PS C:\Users\[user]\workspace\dsm> .\.venv\Scripts\activate
(.venv) PS C:\Users\[user]\workspace\dsm>   ### Windows
```

When the virtual environment is successfully activated, you will see `(.venv) ` appears before the shell prompt line, which tells us the virtual environment is activated and all the packages installation will go into the `site-packages` directory. 

Obviously, there will be times that you work on different projects and need to deactivate the virtual environment. To do that, use `deactivate` (you can deactivate a virtual environment anaywhere; it does not have to be in the project folder):
```bash
(.venv) PS C:\Users\tychen\workspace\dsm> deactivate
PS C:\Users\tychen\workspace\dsm>
```

## 5. Installing Jupyter Notebook

Once you have a virtual environment, you can start installing the Python packages in it. For package installation, Python has a package manager `pip` (Pip Installs Packages). pip installs Python packages from the package repository Python Package Index (**PyPI**), where Python developers consume and distribute packages. To install a Python package using `pip`, the syntax is `pip install [package]'. To install Jupyter Notebook, you issue the command below with virtual environment **enabled**: 

````{tab-set}
```{tab-item} Windows
:language: python
(.venv) PS C:\Users\[user]\workspace\dsm> pip install notebook  
Collecting notebook  
  Using cached notebook-7.4.5-py3-none-any.whl.metadata (10 kB)  
Collecting jupyter-server<3,>=2.4.0 (from notebook)  
...
```
```{tab-item} macOS
:language: python  
(.venv) [user]@[host]ː~/workspaces/dsm$ pip install notebook  
Collecting notebook  
  Downloading notebook-7.2.2-py3-none-any.whl (10.5 MB)  
Collecting jupyterlab-server!=2.10.0,>=2.3.0  
  Downloading jupyterlab_server-2.25.1-py3-none-any.whl (58 kB)
...
```
````

## 2. Using Jupyter Notebook
To open a Jupyter Notebook, open the PowerShell (Windows) or Terminal (macOS) CLI, and type the following command and press Enter (**with the venv activated**):

```
$ jupyter notebook
```
This command will start a Jupyter Notebook from the present working directory in your default browser.

When you launch Jupyter Notebook, it opens in your browser. Navigate the Jupyter Notebook Homepage and you will see the files and folders in the directory where you start Jupyter Notebook (`$ jupyter notebook`).

### 2.1. Creating and Renaming Notebooks

To create a new notebook, click the 'New' button and select the desired Python environment (_Python3 (ipykernel)_). The new notebook will have a title called "Untitled." To rename a notebook, click on the title (i.e., 'Untitled') and enter a new name.

### 2.2. "hello world"

Jupyter Notebooks use code cells to execute Python code. For example, to print a message:

```{code-cell}
print("hello world")
```

You can run a cell by clicking on the 'Run' icon or by using the keyboard shortcut Shift+Enter. The output appears below the cell. For expressions like 1 + 1, the result is displayed automatically unless you use the print function.

```{code-cell}
1 + 1
```

### Keyboard Shortcuts

- Shift+Enter: Runs the current cell and moves to the next.
- a: add a new cell above
- b: add a new cell below
- dd: delete the highlighted cell.

These shortcuts help streamline your workflow.

### Saving and Exporting Notebooks

- You can save your notebook by clicking the save icon or pressing Ctrl+S. Jupyter Notebooks have an autosave feature that saves every two minutes.
- To export your notebook, go to File > Download As and select your preferred format, such as .py for Python scripts or .html for web viewing.

### Restarting and Interrupting the Kernel

If you encounter an infinite loop or need to restart your Python environment, go to the 'Kernel' menu and select 'Restart'. This will reset the notebook's kernel, stopping any running code. You can also use 'Interrupt' to stop a specific cell, though it may not always work with problematic loops.

### Accessing Help and Shortcuts

The 'Help' menu provides documentation for libraries and the notebook itself. You can also find a list of keyboard shortcuts under Help > Keyboard Shortcuts.

### Code and Markdown Cells

To create a markdown cell, change the cell type from 'Code' to 'Markdown'. Markdown cells are useful for taking notes and support formatting such as headings, bold, italics, bullet points, and even LaTeX for equations.

If your code is not running, ensure the cell is set to 'Code' and not 'Markdown'. To switch, select the cell and change its type accordingly.

## Conclusion

The Jupyter Notebook system is a powerful tool for interactive coding and note-taking. Instead of using proprietary tools such as Tableau or PowerBI, it is now common for data scientists to use Python and Jupyter Notebook Remember that the notebook will start in your current directory, so use the cd command to navigate as needed.

Key Takeaways

- Jupyter Notebooks allow for interactive Python coding and note-taking in one environment.
- Use PowerShell or Terminal to launch Jupyter Notebooks and navigate directories as needed.
- Code cells execute Python code, while markdown cells are for formatted notes and documentation.
- Keyboard shortcuts like Shift+Enter and A, B, DD to streamline workflow in notebooks.
- Notebooks can be saved, exported, and kernels restarted or interrupted for troubleshooting.

## Resources

- [How to Install Python on Your System: A Guide](https://realpython.com/installing-python/#windows-how-to-check-or-get-python) from realpython.com
- [How to Install Python on Windows 10](https://www.digitalocean.com/community/tutorials/install-python-windows-10)
