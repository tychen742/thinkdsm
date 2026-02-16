# Installation
- pip install "jupyter-book<2"
- pip install "sphinx<7.2" "sphinx-new-tab-link<0.5" "docutils<0.21" "sphinx-external-toc~=1.0.1"
jupyter-book==1.0.4.post1
sphinx==7.1.2
sphinx-new-tab-link==0.4.0
docutils==0.20.1
sphinx-external-toc==1.0.1

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
