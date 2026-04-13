from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name = "q3_11"
points = 4

@test_case(points=4, hidden=True)
def test_q3_11_pval(p_val):
    """
    p_val must be numeric, in [0, 1], and less than 0.05.
    """
    assert isinstance(p_val, (float, np.floating)), "p_val must be a number."
    assert 0.0 <= p_val <= 1.0, f"p_val should lie between 0 and 1; got {p_val}."
    assert p_val > 0.05, f"p_val should be less than 0.05; got {p_val}."
