import numpy as np

from IPython.display import HTML


def display_side_by_side(*args, names=None):
    """Display DataFrames side by side using HTML formatting.
    Handles both calling patterns:
    1. display_side_by_side(df1, df2, names=["Name1", "Name2"])
    2. display_side_by_side(df1, df2, "Name1", "Name2")
    """
    import pandas as pd

    # Separate DataFrames from potential string names
    dfs = []
    string_names = []

    for arg in args:
        if isinstance(arg, (pd.DataFrame, pd.Series)):
            dfs.append(arg)
        elif isinstance(arg, str):
            string_names.append(arg)

    # Use provided names or string arguments or generate defaults
    if names is not None:
        final_names = names
    elif string_names:
        final_names = string_names
    else:
        final_names = [f'DataFrame {i+1}' for i in range(len(dfs))]

    # Ensure we have enough names
    while len(final_names) < len(dfs):
        final_names.append(f'DataFrame {len(final_names)+1}')
            
    html_str = '<div style="display: flex; gap: 20px;">'
    for df, name in zip(dfs, final_names):
        html_str += f'''
        <div>
            <h4> {name} </h4>
            {df.to_html()}
        </div>
        '''
    html_str += '</div>'
    return HTML(html_str)
