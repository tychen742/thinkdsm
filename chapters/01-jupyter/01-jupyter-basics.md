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


# Jupyter Notebooks Overview

We are going to use Jupyter Notebooks intensively in this course. 
This chapter provides a comprehensive overview of the Jupyter Notebook system, including how to install it, how to use it effectively, and how to navigate its environment.


## Installing Jupyter Notebook

```{note} 
Some prefer to use Anaconda to manage Jupyter Notebook. We use the Python package installer ```pip``` for simplicity and better project control.  
```
1. Install Python 
Opening Jupyter Notebooks
To open a Jupyter Notebook, use the command prompt (Windows) or terminal (Mac OS). Type the following command and press Enter:

none Code Sample
jupyter notebook
This command will start a Jupyter Notebook in the current directory. To change directories, use the cd command followed by the folder name. For example, to navigate to the Downloads folder:

none Code Sample
cd Downloads
On Windows, use dir to list directory contents. On Mac, use ls. To clear the terminal, use cls on Windows or clear on Mac.

Navigating the Jupyter Notebook Interface
When you launch Jupyter Notebook, it opens in your browser. Navigate to the folder where you unzipped the course files. Each section of the course has its own folder, and within those, you will find the relevant notebook files.

Creating and Renaming Notebooks
To create a new notebook, click 'New' and select the desired Python environment. To rename a notebook, click on the title (e.g., 'Untitled') and enter a new name.

Using Code Cells
Jupyter Notebooks use code cells to execute Python code. For example, to print a message:

python Code Sample
print("Hello")
You can run a cell by clicking 'Run' or by using the keyboard shortcut Shift+Enter. The output appears below the cell. For expressions like 1 + 1, the result is displayed automatically unless you use the print function.

python Code Sample
1 + 1
Keyboard Shortcuts
Shift+Enter: Runs the current cell and moves to the next.
Alt+Enter: Runs the current cell and inserts a new cell below.
These shortcuts help streamline your workflow.

Saving and Exporting Notebooks
You can save your notebook by clicking the save icon or pressing Ctrl+S. Jupyter Notebooks have an autosave feature that saves every two minutes. To export your notebook, go to File > Download As and select your preferred format, such as .py for Python scripts or .html for web viewing.

Restarting and Interrupting the Kernel
If you encounter an infinite loop or need to restart your Python environment, go to the 'Kernel' menu and select 'Restart'. This will reset the notebook's kernel, stopping any running code. You can also use 'Interrupt' to stop a specific cell, though it may not always work with problematic loops.

Accessing Help and Shortcuts
The 'Help' menu provides documentation for libraries and the notebook itself. You can also find a list of keyboard shortcuts under Help > Keyboard Shortcuts.

Exercises and Markdown Cells
Each exercise in the course has an associated solutions file. Work on the exercise file first before checking the solutions. Exercise files contain questions and cells for your answers. Some cells are markdown cells, which display formatted text instead of code.

To create a markdown cell, change the cell type from 'Code' to 'Markdown'. Markdown cells are useful for taking notes and support formatting such as headings, bold, italics, bullet points, and even LaTeX for equations.

Switching Between Code and Markdown Cells
If your code is not running, ensure the cell is set to 'Code' and not 'Markdown'. To switch, select the cell and change its type accordingly.

Practical Tips for Exercises
When working on exercises, use Alt+Enter to insert new cells for your answers without overwriting existing outputs. Shift+Enter runs the cell. This approach helps keep your work organized and prevents accidental overwriting.

Conclusion
The Jupyter Notebook system is a powerful tool for interactive coding and note-taking. If you have questions, use the QA forums for assistance. Remember that the notebook will start in your current directory, so use the cd command to navigate as needed.

Key Takeaways
Jupyter Notebooks allow for interactive Python coding and note-taking in one environment.
Use the command prompt or terminal to launch Jupyter Notebooks and navigate directories as needed.
Code cells execute Python code, while markdown cells are for formatted notes and documentation.
Keyboard shortcuts like Shift+Enter and Alt+Enter streamline workflow in notebooks.
Notebooks can be saved, exported, and kernels restarted or interrupted for troubleshooting.