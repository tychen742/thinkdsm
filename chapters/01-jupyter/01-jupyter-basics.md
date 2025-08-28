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

# Jupyter Notebook

We are going to use Jupyter Notebooks intensively in this course. Jupyter Notebook is an important part of the Python ecosystem and is widely used by the data science and machine learning community for its capability of combining code and notes together. As an alternative, you can use Google Colab, which is actually also Jupyter Notebook. This chapter provides a comprehensive overview of the Jupyter Notebook system, including how to install it, how to use it effectively, and how to navigate its environment.

````{note}
Some prefer to use Anaconda to manage Jupyter Notebook. We use the Python package installer ```pip``` for simplicity and better project control. The popular IDE VS Code can also run Jupyter Notebook, but the user experience is different.
````

## 1. Installing Jupyter Notebook

To install and start using Jupyter Notebook, follow the four steps below.

1. Check Python installation
2. Create Project directory
3. Create Python virtual environment (venv)
4. Start Jupyter Notebook

### 1.1. Check Python installation

If you are a macOS or Linux user, your OS has a version of Python installed already. You may issue `python` or `python3` to see the version of the system default Python version. The Windows OS, however, does not ship with a Python installed. There are two ways to install Python in Windows: through Windows Store or by downloading an installer from python.org.

- If you have installed Python through the Windows Store:
  - PATH environment variable: Your PATH environment variable will be set to this installation automatically.
  - The "py launcher": However, the py.exe launcher, which provides a convenient way to manage and select different Python versions, will not be included when the Python installation.
- If you chose to install Python by downloading a Python installer from python.org, you will have the opportunity to:
  - Use admin privileges when installing py.exe, and
  - Add python.exe to the PATH environment variable.

```{figure} ../../images/python_windows_install.png
---
width: 500px
name: python_windows_install
---
Python Installation Options in Windows
```
When running into problem while activating the .venv script, from time to time, you might want to check the Python versions you have in your Windows system. It's then advised to click and choose both options:

- To see if Python is installed, you may type `py` at the CLI (PowerShell)

```{figure} ../../images/python_windows_py.png
---
width: 450px
label: python_windows_py
name: python_windows_py
---
Check Python Installation in Windows
```

### 1.2. Create Project Directory

### 1.3. Create Python virtual environment (venv)

### 1.4. Activate the venv

To activate your virtual environment, in the CLI, type:

- `$ source .venv/bin/activate` # (mac), or
- `$ .\.venv\Script\activate` # (Windows)

When the virtual envrionment is successfully activated, you will see `(.venv) ` appears before the shell prompt line.

### 1.5. Launch Jupyter Notebook

To open a Jupyter Notebook, open the PowerShell (Windows) or Terminal (macOS) CLI, and type the following command and press Enter (**with the venv activated**):

```
$ jupyter notebook
```

This command will start a Jupyter Notebook from the present working directory in your default browser.

## 2. Using Jupyter Notebook Interface

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
