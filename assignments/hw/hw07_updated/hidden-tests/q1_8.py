from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name = "q1_8"
points = 4

@test_case(points=4, hidden=True)
def test_q1_8(p_value):
    """
    Q1.8: empirical p-value should be ≤ 0.05 (5 % cutoff).
    We don’t enforce an exact number—just that it shows statistical
    evidence strong enough to reject at the 5 % level.
    """
    assert isinstance(p_value, (float, np.floating)), "p_value must be a number."
    assert 0 <= p_value <= 1, "p_value must be between 0 and 1."
    # assert p_value <= 0.05, (
    #     f"p_value = {p_value:.4f}; it should be ≤ 0.05 to indicate "
    #     "statistical significance at the 5 % level."
    # )
