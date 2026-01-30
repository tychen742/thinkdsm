# Installation
- pip install "jupyter-book<2"
- pip install sphinx-new-tab-link

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
