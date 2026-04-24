from otter.test_files import test_case
import numpy as np

OK_FORMAT = False
name = "q2_3"
points = 5

@test_case(points=5, hidden=True)
def test_q2_3_value(smallest_num):
    """
    `smallest_num` should be the minimum sample size (decimal allowed) that
    guarantees a 90 % confidence interval no wider than 0.06.
    Acceptable window: 740 ≤ n ≤ 760.
    """    
    lower, upper = 740, 760
    assert lower <= smallest_num <= upper, (
        f"Expected a value between {lower} and {upper}, "
        f"but got {smallest_num}."
    )






