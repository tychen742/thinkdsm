# Installation

(02-15-2026)
Used this requirements.txt on thinkpy and got jupyter-book==2.1.2 and sphinx==8.1.3. This is totally wrong.

(02-15-2026)

This is what I did to get sphinx7.1.2 and 
```bash
387   398  pip install -r requirements.txt
388   399  deploy
389   400  jupyter-bbok --version
390   401  jupyter-book --version
391   402  deactivate
392   403  trash .venv/
393   404  python -m venv .venv
394   405  venv
395   406  pip install "jupyter-book<2"
396   407  pip install "sphinx<7.2" "sphinx-new-tab-link<0.5" "docutils<0.21" "sphinx-external-toc~=1.0.1" jupyter-book==1.0.4.post1 sphinx==7.1.2 sphinx-new-tab-link==0.4.0 docutils==0.20.1 sphinx-external-toc==1.0.1
397   408  deploy
398   409  pip install sphinxcontrib-mermaid
```

(02-15-2026)

I did this requirements.txt install (becase 385  sudo mv dsm workspace/) and then it didn't give me the good versions. This requirements.txt was recommended by AI for workingwith mybinder.org
```bash
jupyter-book>=1.0        ==> 1.0.4
sphinx-thebe>=0.3        ==> 0.3.1
sphinx-book-theme>=1.0   ==> 1.1.4
jupyter>=1.0 ==> WARNING: Package(s) not found: jupyter
pandas>=2.0              ==> 1.1.4
numpy>=2.0                ==> 2.2.6
matplotlib>=3.5
seaborn>=0.12
scipy>=1.10
scikit-learn>=1.3
plotly>=5.0
folium>=0.14
datascience>=0.17
otter-grader>=6.0
jupytext>=1.16 ==> WARNING: Package(s) not found: jupytext
```
The installation was successful and jb is working now. But looking at the bolded entries. This installation shouldn't have worked. Sphinx is **7.1.2**, which may have come from... book-theme? t

Let's see. Am testing jupyter-book==1.0.4.post1 on thinkpy.

```python
pip install "jupyter-book==1.0.4.post1"
pip install sphinx_new_tab_link
```

- pip install "jupyter-book==1.0.4.post1", then
  - "sphinx<7.2"
  - "sphinx-new-tab-link<0.5"
  - "docutils<0.21"
  - docutils==0.20.1
  - "sphinx-external-toc~=1.0.1"
  - sphinx==7.1.2
  - sphinx-new-tab-link==0.4.0
- 
  - pip install sphinxcontrib-mermaid
  - pip install openpyxl
  - pip install lxml

# Thebe / Binder
1. Binder needs requirements.txt in the repo root

2. Remove input:
```
{
    "trusted": true,
    "editable": true,
    "slideshow": {
        "slide_type": ""
    },
    "tags": [
        "remove-input"
    ]
}
```

3. Thebe interactive:
```
   <pre data-executable="true" data-language="python">print("Hello!")</pre>
```

4. Thebe interactive:
```
{
    "editable": true,
    "slideshow": {
        "slide_type": ""
    },
    "tags": [
        "thebe-interactive"
    ],
    "trusted": false
}
```
