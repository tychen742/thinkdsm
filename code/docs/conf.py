project = 'python'
copyright = '2024, tychen'
author = 'tychen'
release = '.01'

# -- General configuration ---------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#general-configuration

extensions = [
    'sphinx.ext.duration',
    'sphinx.ext.doctest',
    'sphinx.ext.autodoc',
    'sphinx.ext.autosummary',

]

templates_path = ['_templates']
exclude_patterns = []


# -- Options for HTML output -------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#options-for-html-output

html_theme = 'alabaster'
# html_theme = 'furo'
# html_static_path = ['_static']

<<<<<<< HEAD
html_sidebars = { '**': ['globaltoc.html', 'relations.html', 'sourcelink.html', 'searchbox.html'] }
=======
html_sidebars = { '**': ['globaltoc.html', 'sourcelink.html', 'searchbox.html'] }

>>>>>>> e171ce2 (committed @ 2024-0729-135657)
